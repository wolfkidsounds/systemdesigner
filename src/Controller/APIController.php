<?php

namespace App\Controller;

use App\Entity\Speaker;
use App\Entity\Amplifier;
use App\Entity\Processor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Translation\TranslatableMessage;
use Novaway\Bundle\FeatureFlagBundle\Annotation\Feature;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Feature(name: "api")]
#[IsGranted('ROLE_USER')]
class APIController extends AbstractController
{
    #[Route('/api/get/processor/{id}', name: 'api_get_processor')]
    public function getProcessor(int $id, EntityManagerInterface $entityManager,): Response
    {
        $processor = $entityManager->getRepository(Processor::class)->find($id);

        if (!$processor) {
            // Handle the case when the entity is not found
            return $this->json(['error' => 'Processor not found'], 404);
        };

        $data = [
            'id' => $processor->getId(),
            'manufacturer' => $processor->getManufacturer()->getName(),
            'name' => $processor->getName(),
            'inputs' => $processor->getChannelsInput(),
            'outputs' => $processor->getChannelsOutput(),
            'offset' => $processor->getOutputOffset(),
        ];

        return $this->json($data);
    }

    #[Route('/api/get/amplifier/{id}', name: 'api_get_amplifier')]
    public function getAmplifier(int $id, EntityManagerInterface $entityManager,): Response
    {
        $amplifier = $entityManager->getRepository(Amplifier::class)->find($id);

        if (!$amplifier) {
            // Handle the case when the entity is not found
            return $this->json(['error' => 'Amplifier not found'], 404);
        };

        $data = [
            'id' => $amplifier->getId(),
            'manufacturer' => $amplifier->getManufacturer()->getName(),
            'name' => $amplifier->getName(),
            'power_8' => $amplifier->getPower8(),
            'power_4' => $amplifier->getPower4(),
            'power_2' => $amplifier->getPower2(),
            'power_bridge_8' => $amplifier->getPowerBridge8(),
            'power_bridge_4' => $amplifier->getPowerBridge4(),
        ];

        return $this->json($data);
    }

    #[Route('/api/get/speaker/{id}', name: 'api_get_speaker')]
    public function getSpeaker(int $id, EntityManagerInterface $entityManager,): Response
    {
        $speaker = $entityManager->getRepository(Speaker::class)->find($id);

        if (!$speaker) {
            // Handle the case when the entity is not found
            return $this->json(['error' => 'Speaker not found'], 404);
        };

        $data = [
            'id' => $speaker->getId(),
            'manufacturer' => $speaker->getManufacturer()->getName(),
            'name' => $speaker->getName(),
            'power_rms' => $speaker->getPowerRMS(),
            'power_peak' => $speaker->getPowerPeak(),
            'impedance' => $speaker->getImpedance(),
            'spl' => $speaker->getSPL(),
            'bandwidth' => $speaker->getBandwidth(),
        ];

        return $this->json($data);
    }

    #[Route('/api/get/limiter/calculation', name: 'api_get_limiter_calculation')]
    public function getLimiterCalculation(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);
        $message = '';

        //dump($requestData);

        // Ensure that the properties you are trying to access are present in the $requestData array
        $speakerId = intval($requestData['speaker_id']);
        $amplifierId = intval($requestData['amplifier_id']);
        $processorId = intval($requestData['processor_id']);
        $speakerCount = intval($requestData['speakers_in_parallel']);
        $inputSensitiviy = floatval(str_replace(',', '.', $requestData['input_sensitivity']));
        $scaling = floatval($requestData['scaling'] / 100);
        $bridge_mode_enabled = boolval($requestData['bridge_mode_enabled']);

        $speaker = $entityManager->getRepository(Speaker::class)->find($speakerId);
        $amplifier = $entityManager->getRepository(Amplifier::class)->find($amplifierId);
        $processor = $entityManager->getRepository(Processor::class)->find($processorId);

        $impedance_request = $speaker->getImpedance() / $speakerCount;
        $matching_impedance = $this->matchImpedance($impedance_request);

        $rms_scaling = $this->getRMSScaling($speaker->getBandwidth());
        $peak_scaling = $this->getPeakScaling($speaker->getBandwidth());

        if ($bridge_mode_enabled) {
            $amplifier_power = $amplifier->getBridgePower($matching_impedance);
        } else {
            $amplifier_power = $amplifier->getPower($matching_impedance);
        }

        $rms_power_request = $speaker->getPowerRMS() * $speakerCount;

        if ($amplifier_power >= $rms_power_request) {
            //speaker needs to be protected
            $vrms = sqrt($rms_power_request * $impedance_request) * ($rms_scaling) * ($scaling);

        } else if ($amplifier_power < $rms_power_request) {
            //amplifer needs to be protected
            $vrms = sqrt($amplifier_power * $matching_impedance) * ($rms_scaling) * ($scaling);
        }

        $peak_power_request = $speaker->getPowerPeak() * $speakerCount;

        if ($amplifier_power >= $peak_power_request) {
            //speaker needs to be protected
            $vpeak = sqrt($peak_power_request * $impedance_request) * ($peak_scaling) * ($scaling);

        } else if ($amplifier_power < $peak_power_request) {
            //amplifer needs to be protected
            $vpeak = sqrt($amplifier_power * $matching_impedance) * ($peak_scaling) * ($scaling);
        }

        $vgain = (20 * LOG10( SQRT( $amplifier_power * $matching_impedance ) / 0.775 )) - (20 * LOG10( $inputSensitiviy / 0.775 ));

        $vrms_dBu = (( 20 * LOG10( $vrms / 0.775 )) - $vgain ) - $processor->getOutputOffset();
        $vpeak_dBu = (( 20 * LOG10( $vpeak / 0.775 )) - $vgain ) - $processor->getOutputOffset();

        // Messages

        if ($amplifier_power < $rms_power_request) {
            $message .= new TranslatableMessage('! Amplifier: RMS Power is low') . '\n';
        }

        if ($amplifier_power > ($peak_power_request * 2)) {
            $message .= new TranslatableMessage('! Amplifier: Peak Power is very high') . '\n';
            $message .= new TranslatableMessage('! Speaker: Speaker may get damaged')  . '\n';
        }

        if ($vpeak_dBu > ($vrms_dBu + 9)) {
            $message .= new TranslatableMessage('! Voltage Mismatch: Please consider decreasing the load (High Vpeak)')  . '\n';
        }

        if ($vrms_dBu >= ($vpeak_dBu)) {
            $message .= new TranslatableMessage('! Voltage Mismatch: Please consider decreasing the load (High Vrms)')  . '\n';
        }

        if (!$bridge_mode_enabled && ($amplifier_power < $rms_power_request) && ($impedance_request > 4)) {
            $message .= new TranslatableMessage('? Amplifier: Consider enabling "Bridge Mode" for your Amplifier')  . '\n';
        }

        if (number_format($vpeak, 2) === number_format($vrms, 2)) {
            $message .= new TranslatableMessage('# Amplifier: Power Mismatch (Vrms and Vpeak are Equal)')  . '\n';
        }

        if ($amplifier_power < $peak_power_request) {
            $message .= new TranslatableMessage('# Amplifier: Peak Power is low') . '\n';
        }

        // Specials
        if ($matching_impedance == 0) {
            $message = new TranslatableMessage('! Impedance Mismatch: Impedance could not be matched the the Amplifier') . '\n';
        }

        if (is_nan($vrms_dBu) || is_nan($vpeak_dBu)) {
            $message = new TranslatableMessage('! Impedance Mismatch: Impedance seems to be unsupported by Amplifier') . '\n';
        }

        $data = [
            'impedance_request' => $impedance_request,
            'matching_impedance' => $matching_impedance,

            'rms_power_supplied' => $amplifier_power,
            'rms_power_request' => $rms_power_request,

            'peak_power_supplied' => $amplifier_power,
            'peak_power_request' => $peak_power_request,

            'input_sensitvity' => $inputSensitiviy,

            'vgain' => number_format($vgain, 2),

            'vrms' => number_format($vrms, 2),
            'vpeak' => number_format($vpeak, 2),

            'vrms_value' => number_format($vrms_dBu, 2),
            'vpeak_value' => number_format($vpeak_dBu, 2),

            'vrms_attack' => $this->getVrmsAttack($speaker->getBandwidth()),
            'vrms_release' => $this->getVrmsRelease($speaker->getBandwidth()),
            'vpeak_attack' => $this->getVpeakAttack($speaker->getBandwidth()),
            'vpeak_release' => $this->getVpeakRelease($speaker->getBandwidth()),

            'message' => $message,
        ];

        return $this->json($data);
    }

    function matchImpedance($impedance) {
        if (is_numeric($impedance)) {
            $matchingValue = 0;
    
            if ($impedance < 1.7) {
                $matchingValue = 0;
            } elseif ($impedance >= 1.8 && $impedance < 3) {
                $matchingValue = 2;
            } elseif ($impedance >= 4 && $impedance < 6) {
                $matchingValue = 4;
            } elseif ($impedance >= 7 && $impedance < 12) {
                $matchingValue = 8;
            } elseif ($impedance >= 12 && $impedance < 18) {
                $matchingValue = 16;
            } else {
                $matchingValue = 0;
            }
    
            return $matchingValue;
        }
    }

    function getVpeakAttack($bandwidth) {
        switch ($bandwidth) {
            case 'SUB':
                return '16 - 32';
            case 'LF':
                return '8 - 16';
            case 'MF':
                return '2 - 8';
            case 'HF':
                return '0.5 - 2';
            case 'FR':
                return '2 - 8';
            default:
                return 0;
        }
    }

    function getVpeakRelease($bandwidth) {
        switch ($bandwidth) {
            case 'SUB':
                return '128 - 365';
            case 'LF':
                return '64 - 265';
            case 'MF':
                return '16 - 64';
            case 'HF':
                return '8 - 32';
            case 'FR':
                return '16 - 64';
            default:
                return 0;
        }
    }

    function getVrmsAttack($bandwidth) {
        switch ($bandwidth) {
            case 'SUB':
                return '2000 - 4000';
            case 'LF':
                return '1000 - 2000';
            case 'MF':
                return '300 - 800';
            case 'HF':
                return '150 - 300';
            case 'FR':
                return '300 - 800';
            default:
                return 0;
        }
    }

    function getVrmsRelease($bandwidth) {
        switch ($bandwidth) {
            case 'SUB':
                return '4000 - 8000';
            case 'LF':
                return '2000 - 4000';
            case 'MF':
                return '500 - 2000';
            case 'HF':
                return '300 - 800';
            case 'FR':
                return '500 - 2000';
            default:
                return 0;
        }
    }

    function getPeakScaling($bandwidth) {
        switch ($bandwidth) {
            case 'SUB':
                return '0.8';
            case 'LF':
                return '0.8';
            case 'MF':
                return '0.8';
            case 'HF':
                return '0.8';
            case 'FR':
                return '0.8';
            default:
                return 0;
        }
    }

    function getRMSScaling($bandwidth) {
        switch ($bandwidth) {
            case 'SUB':
                return '0.7';
            case 'LF':
                return '0.65';
            case 'MF':
                return '0.6';
            case 'HF':
                return '0.55';
            case 'FR':
                return '0.6';
            default:
                return 0;
        }
    }
    
}
