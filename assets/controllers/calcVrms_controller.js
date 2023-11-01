import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    initialize() {
        console.log('Controller Connected');

        const elementsToWatch = [
            '#limiter_BridgeModeEnabled',
            '#limiter_InputSensitivity',
            '#limiter_SpeakersInParallel',
            '#limiter_Scaling'
        ];

        // Attach event listeners to the specified elements
        elementsToWatch.forEach((elementSelector) => {
            const $element = $(elementSelector);
            $element.off("change").on("change", () => {
                this.calc();
            });
        });

        // Attach the event listener to a common ancestor element
        $('#limiter_Amplifier').off("select2:select").on("select2:select", (e) => {
            const $amplifier = $('#limiter_Amplifier');
            const $processor = $('#limiter_Processor');
            const $speaker = $('#limiter_Speaker');
        
            if ($amplifier.val() && $processor.val() && $speaker.val()) {
                console.log("Amplifier, Processor, and Speaker selected.");
                this.calc();
            } else {
                console.log("Not all options are selected.");
            }
        });
        
        $('#limiter_Processor').off("select2:select").on("select2:select", (e) => {
            const $amplifier = $('#limiter_Amplifier');
            const $processor = $('#limiter_Processor');
            const $speaker = $('#limiter_Speaker');
        
            if ($amplifier.val() && $processor.val() && $speaker.val()) {
                console.log("Amplifier, Processor, and Speaker selected.");
                this.calc();
            } else {
                console.log("Not all options are selected.");
            }
        });
        
        $('#limiter_Speaker').off("select2:select").on("select2:select", (e) => {
            const $amplifier = $('#limiter_Amplifier');
            const $processor = $('#limiter_Processor');
            const $speaker = $('#limiter_Speaker');
        
            if ($amplifier.val() && $processor.val() && $speaker.val()) {
                console.log("Amplifier, Processor, and Speaker selected.");
                this.calc();
            } else {
                console.log("Not all options are selected.");
            }
        });
    }

    async calc() {

        const $loader = $('.custom-loader');
        const $loaderItem = $('.custom-loader-item');
        const $loaderContainer = $('.loader-container');
        
        $loaderContainer.css('display', 'flex');
        $loader.addClass('loading');
        $loaderItem.addClass('loading');

        const processorId = document.querySelector('#limiter_Processor').value;
        console.log('Processor: ' + processorId);

        const amplifierId = document.querySelector('#limiter_Amplifier').value;
        console.log('Amplifier: ' + amplifierId);

        const speakerId = document.querySelector('#limiter_Speaker').value;
        console.log('Speaker: ' + speakerId);
        
        const bridgeModeEnabled = document.querySelector('#limiter_BridgeModeEnabled').value;
        console.log('Bridge Mode Enabled: ' + bridgeModeEnabled);

        const inputSensitivity = document.querySelector('#limiter_InputSensitivity').value;
        console.log('Input Sensitivity: ' + inputSensitivity);

        const speakersInParallel = document.querySelector('#limiter_SpeakersInParallel').value;
        console.log('Speakers In Parallel: ' + speakersInParallel);

        const Scaling = document.querySelector('#limiter_Scaling').value;
        console.log('Scaling: ' + Scaling);

        if (speakerId && amplifierId && processorId) {
            var data = {
                processor_id: processorId,   // Use the correct property names for processorId, amplifierId, and speakerId.
                amplifier_id: amplifierId,
                speaker_id: speakerId,
                bridge_mode_enabled: bridgeModeEnabled,
                input_sensitivity: inputSensitivity,
                speakers_in_parallel: speakersInParallel,
                scaling: Scaling,
            };
        
            var jsonRequest = JSON.stringify(data);
        
            try {
                const response = await this.fetchData(jsonRequest);
                console.log(response);
        
                // Uncomment and adapt these lines if you want to use the response data
                const vrms = document.querySelector('#limiter_Vrms');
                vrms.setAttribute('value', response.vrms);

                const vrms_value = document.querySelector('#limiter_VrmsValue');
                vrms_value.setAttribute('value', response.vrms_value);

                const vrms_attack = document.querySelector('#limiter_VrmsAttack');
                vrms_attack.setAttribute('value', response.vrms_attack);

                const vrms_release = document.querySelector('#limiter_VrmsRelease');
                vrms_release.setAttribute('value', response.vrms_release);

                const vpeak = document.querySelector('#limiter_Vpeak');
                vpeak.setAttribute('value', response.vpeak);
                
                const vpeak_value = document.querySelector('#limiter_VpeakValue');
                vpeak_value.setAttribute('value', response.vpeak_value);
                
                const vpeak_attack = document.querySelector('#limiter_VpeakAttack');
                vpeak_attack.setAttribute('value', response.vpeak_attack);
                
                const vpeak_release = document.querySelector('#limiter_VpeakRelease');
                vpeak_release.setAttribute('value', response.vpeak_release);

                const vgain = document.querySelector('#details_Vgain');
                vgain.setAttribute('value', response.vgain);

                const prequest = document.querySelector('#details_PRequest');
                prequest.setAttribute('value', response.peak_power_request);

                const rmsrequest = document.querySelector('#details_RMSRequest');
                rmsrequest.setAttribute('value', response.rms_power_request);

                const psupply = document.querySelector('#details_PSupply');
                psupply.setAttribute('value', response.peak_power_supplied);

                const rmssupply = document.querySelector('#details_RMSSupply');
                rmssupply.setAttribute('value', response.rms_power_supplied);

                const respMessage = document.querySelector('#limiter_Message');
                respMessage.value = response.message.replace(/\\n/g, '\n');

                $loader.removeClass('loading');
                $loaderItem.removeClass('loading');
                $loaderContainer.css('display', 'none');
            } catch (error) {
                console.error(error);
            }
        }
        
    }
    
    async fetchData(jsonRequest) {
        try {
            const response = await fetch('/api/get/limiter/calculation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: jsonRequest, // Use 'body' instead of 'data'
            });
    
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
    
            return await response.json();
        } catch (error) {
            throw error;
        }
    }    
}