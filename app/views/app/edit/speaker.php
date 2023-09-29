<link rel="stylesheet" href="/includes/assets/css/speaker.css">
<link rel="stylesheet" href="/includes/assets/css/new_item.css">

<?php //edit/speaker.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $brand_id = $_POST['brand_id'];
    $name = $_POST['name'];
    $bandwidth = $_POST['bandwidth'];
    $power_rms = $_POST['power_rms'];
    $impedance = $_POST['impedance'];
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
    Functions::Speakers()->setImpedance($id, $impedance);
    Functions::Speakers()->setSPL($id, $sens_spl);
    Functions::Speakers()->setMaxSPL($id, $max_spl);

    header("Location: /app/edit/speaker/" . $speaker_id);

} else {

    $speaker = Functions::Speakers()->get($speaker_id);

    $brand_id = $speaker["brand_id"];
    $brand = Functions::Brands()->get($brand_id);
    $brand_name = $brand["name"];

    $name = $speaker['name'];
    $bandwidth = $speaker['bandwidth'];
    $power_rms = $speaker['power_rms'];
    $impedance = $speaker['impedance'];
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
                    <div class="input-group">
                        <input class="form-input" type="number" id="power_rms" name="power_rms" value="<?php out($power_rms); ?>" oninput="calculateMaxSPL('sens_spl', 'power_rms', 'max_spl')" placeholder="RMS/AES Power (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
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