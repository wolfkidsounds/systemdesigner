<link rel="stylesheet" href="/includes/assets/css/speaker.css">
<link rel="stylesheet" href="/includes/assets/css/new_item.css">

<?php //new/amplifer.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $brand_id = $_POST['brand_id'];
    $name = $_POST['name'];
    $bandwidth = $_POST['bandwidth'];
    $power_rms = $_POST['power_rms'];
    $power_program = $_POST['power_program'];
    $power_peak = $_POST['power_peak'];
    $impedance = $_POST['impedance'];
    $vpeak = $_POST['vpeak'];
    $vrms = $_POST['vrms'];
    $sens_spl = $_POST['sens_spl'];
    $max_spl = $_POST['max_spl'];

    $brand = Functions::Brands()->get($brand_id);
    $brand_name = $brand["name"];

    $user_id = Functions::Users()->getUserID();
    $id = $speaker_id;
    Functions::Speakers()->setBrand($id, $brand_id);
    Functions::Speakers()->setName($id, $name);
    Functions::Speakers()->setBandwidth($id, $type);
    Functions::Speakers()->setPower_RMS($id, $power_rms);
    Functions::Speakers()->setPower_Program($id, $power_program);
    Functions::Speakers()->setPower_Peak($id, $power_peak);
    Functions::Speakers()->setImpedance($id, $impedance);
    Functions::Speakers()->setVpeak($id, $vpeak);
    Functions::Speakers()->setVrms($id, $vrms);
    Functions::Speakers()->setSens($id, $sens_spl);
    Functions::Speakers()->setSPL($id, $max_spl);

    header("Location: /app/edit/speaker/" . $speaker_id);

} else {

    $speaker = Functions::Speakers()->get($speaker_id);

    $brand_id = $speaker["brand_id"];
    $brand = Functions::Brands()->get($brand_id);
    $brand_name = $brand["name"];

    $name = $speaker['name'];
    $bandwidth = $speaker['bandwidth'];
    $power_rms = $speaker['power_rms'];
    $power_program = $speaker['power_program'];
    $power_peak = $speaker['power_peak'];
    $impedance = $speaker['impedance'];
    $vpeak = $speaker['vpeak'];
    $vrms = $speaker['vrms'];
    $sens_spl = $speaker['sensitivity'];
    $max_spl = $speaker['max_spl'];

    ?>

    <h3>Edit <?php out($brand_name . " - " . $name); ?></h3>
    <form name="edit_speaker" method="post" action="/app/edit/speaker/<?php out($speaker_id); ?>" enctype="multipart/form-data">
    <div class="form-group">
        <div class="new_speaker_form">
            <h3>General</h3>
            <div class="form-divider">
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Select the Brand or Manufacture">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <select class="form-select select2js" id="brand_id" name="brand_id">
                        <option value="<?php out($brand_id); ?>"><?php out($brand_name); ?></option>
                        <?php 
                    
                            $brands = Functions::Brands()->getAll();

                            foreach ($brands as $brand) { ?>
                                <option value="<?php out($brand["id"]); ?>"><?php out($brand["name"]); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Model Name">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <input class="form-input" type="text" id="name" name="name" value="<?php out($name); ?>" placeholder="Model Name...">
                </div>
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-left" data-tooltip="Select Bandwidth">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <select class="form-select" id="bandwidth" name="bandwidth">
                            <option value="<?php out($bandwidth); ?>"><?php out($bandwidth); ?></option>
                            <option value="SUB">Subwoofer (20 - 150 Hz)</option>
                            <option value="LF">Low Frequency (100 - 300 Hz)</option>
                            <option value="MF">Mid Frequency (200 - 2000 Hz)</option>
                            <option value="HF">High Frequency (1000 Hz - 20kHz)</option>
                            <option value="FR">Full Range (40 Hz - 20kHz)</option>
                        </select>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-left" data-tooltip="Select Speaker Nominal Impedance">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <select class="form-select" id="impedance" name="impedance" oninput="calculateVoltage();">
                            <option value="<?php out($impedance); ?>"><?php out($impedance); ?></option>
                            <option value="16">16</option>
                            <option value="8">8</option>
                            <option value="4">4</option>
                            <option value="2">2</option>
                        </select>
                        <span class="input-group-addon addon-sm">Ω</span>
                    </div>
                </div>
            </div>

            <h3>Electrical Specification</h3>          
            <div class="form-divider">
                <div style="grid-column:1/2;" class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Enter RMS/AES Power (W)">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <input class="form-input" type="number" id="power_rms" name="power_rms" value="<?php out($power_rms); ?>" oninput="calculatePower(); calculateVoltage();" placeholder="RMS/AES Power (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
                <div style="grid-column:1/2;" class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Program Power (W)">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <input class="form-input" type="number" id="power_program" step="0" name="power_program" value="<?php out($power_program); ?>" placeholder="Program Power (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
                <div style="grid-column:2/3;" class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Peak Power (W)">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <input class="form-input" type="number" id="power_peak" step="0" name="power_peak" value="<?php out($power_peak); ?>" placeholder="Peak Power (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
                <div style="grid-column:3/4;" class="form-element-tooltip">
                    <div class="tooltip tooltip-left" data-tooltip="Vpeak (V)">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <input class="form-input" type="number" id="vpeak" step="0.01" name="vpeak" value="<?php out($vpeak); ?>" placeholder="Vpeak (V)...">
                        <span class="input-group-addon addon-sm">V</span>
                    </div>
                </div>
                <div style="grid-column:4/5;" class="form-element-tooltip">
                    <div class="tooltip tooltip-left" data-tooltip="Vrms (V)">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <input class="form-input" type="number" id="vrms" step="0.01" name="vrms" value="<?php out($vrms); ?>" placeholder="Vrms (V)...">
                        <span class="input-group-addon addon-sm">V</span>
                    </div>
                </div>
            </div>

            <h3>Acoustical Specification</h3>          
            <div class="form-divider">
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Sensitivity (dB)">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <input class="form-input" type="number" id="sens_spl" name="sens_spl" value="<?php out($sens_spl); ?>" oninput="calculateMaxSPL('sens_spl', 'power_rms', 'max_spl')" placeholder="Sensitivity (dB)...">
                        <span class="input-group-addon addon-sm">dB</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Max SPL (dB)">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <input class="form-input" type="number" id="max_spl" step="0.01" name="max_spl" value="<?php out($max_spl); ?>" placeholder="Maximum SPL (dB)...">
                        <span class="input-group-addon addon-sm">dB</span>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary input-group-btn">Update</button>
        </div>
    </div>
    </form>

    <script src="/node_modules\jquery\dist\jquery.min.js"></script>
    <script src="/node_modules\select2\dist\js\select2.min.js"></script>
    <script src="/includes\assets\js\select2.js"></script>

    <script>
    function calculatePower() {
        // Get input values
        const powerRMS = parseFloat(document.getElementById('power_rms').value);
        const impedance = parseFloat(document.getElementById('impedance').value);

        // Calculate power_program and power_peak
        const powerProgram = powerRMS * 2;
        const powerPeak = powerRMS * 4;

        // Update the input fields
        document.getElementById('power_program').value = powerProgram;
        document.getElementById('power_peak').value = powerPeak;
    }

    function calculateVoltage() {
        // Get input values
        const powerRMS = parseFloat(document.getElementById('power_rms').value);
        const impedance = parseFloat(document.getElementById('impedance').value);

        // Calculate Vpeak and Vrms
        const vpeak = Math.sqrt(2) * Math.sqrt(powerRMS * impedance);
        const vrms = Math.sqrt(powerRMS * impedance);

        // Update the input fields
        document.getElementById('vpeak').value = vpeak.toFixed(2);
        document.getElementById('vrms').value = vrms.toFixed(2);
    }

    function calculateMaxSPL() {
        // Get input values
        const powerRMS = parseFloat(document.getElementById('power_rms').value);
        const sensitivity = parseFloat(document.getElementById('sens_spl').value);

        // Calculate max SPL
        const maxSPL = 10 * Math.log10(powerRMS / 1) + sensitivity;

        // Update the input field for max SPL
        document.getElementById('max_spl').value = maxSPL.toFixed(2);
    }

</script>

    <?php 
} 

Partials::Close();
?>