<link rel="stylesheet" href="/includes/assets/css/amplifier.css">
<link rel="stylesheet" href="/includes/assets/css/new_item.css">

<?php //new/amplifer.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $brand_name = $_POST['brand_name'];
    $amp_model = $_POST['model_name'];
    $amp_height = $_POST['amp_height'];
    $amp_channels = $_POST['amp_channels'];

    if (empty($brand_name) || empty($amp_model) || empty($amp_height) || empty($amp_channels)) {
        ?> 
        <div class="toast toast-error">
            <p>Brand Name, Amp Model, Amp Height and Amp Channels can not be empty.</p>
        </div>
        <?php
    }

    $amplifier_id = Functions::Amplifiers()->registerAmplifierModel($brand_name, $amp_model, $amp_height, $amp_channels);

    // Define an array of power specifications to loop through
    $power_specifications = [
        16, 8, 4, 2
    ];

    $bridge_power_specifications = [
        8, 4
    ];

    // Process each power specification
    foreach ($power_specifications as $ohm) {
        $amp_power = $_POST["amp_power_{$ohm}"];
        $amp_vpeak = $_POST["amp_vpeak_{$ohm}"];
        $amp_vgain = $_POST["amp_vgain_{$ohm}"];

        // Set default values if empty
        if (empty($amp_power) || empty($amp_vpeak) || empty($amp_vgain)) {
            $amp_power = 0;
            $amp_vpeak = 0;
            $amp_vgain = 0;
        }

        // Register the amplifier power for the current specification
        Functions::Amplifiers()->registerAmplifierPower($amplifier_id, $amp_power, $amp_vpeak, $amp_vgain, $ohm, false);
    }

    foreach ($bridge_power_specifications as $ohm) {
        // Handle bridge variant
        $amp_power_bridge = $_POST["amp_power_bridge_{$ohm}"];
        $amp_vpeak_bridge = $_POST["amp_vpeak_bridge_{$ohm}"];
        $amp_vgain_bridge = $_POST["amp_vgain_bridge_{$ohm}"];

        // Set default values if empty
        if (empty($amp_power_bridge) || empty($amp_vpeak_bridge) || empty($amp_vgain_bridge)) {
            $amp_power_bridge = 0;
            $amp_vpeak_bridge = 0;
            $amp_vgain_bridge = 0;
        }

        // Register the amplifier power for the current specification (bridge)
        Functions::Amplifiers()->registerAmplifierPower($amplifier_id, $amp_power_bridge, $amp_vpeak_bridge, $amp_vgain_bridge, $ohm, true);
    }

    if ($_FILES['amp_manual']['error'] === UPLOAD_ERR_OK) {

        // Upload File
        $upload_dir = ABSPATH . 'uploads/';
        $filename = $_FILES['amp_manual']['name'];
        $new_filename = $brand_name . " - " . $amp_model . '.pdf';
        $upload_file = $upload_dir . $new_filename;

        if (move_uploaded_file($_FILES['amp_manual']['tmp_name'], $upload_file)) {

            // Register File
            $filename = $new_filename;
            $db = new Database();
            $query = "UPDATE amplifier SET manual_file_name = ? WHERE id = ?";
            $result = $db->query($query, $filename, $amplifier_id);
            $db->close();
        }
    }

    header("Location: /app/amplifiers");

} else {

    ?>

    <h3>New Amplifier</h3>
    <form name="new_amplifier" method="post" action="/app/new/amplifier">
    <div class="form-group">
        <div class="new_amplifier_form">
            <h3>General</h3>
            <div class="form-divider">
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Select the Brand that Manufacture">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <select class="form-select" id="brand_name" name="brand_name">
                        <option>Select Brand...</option>
                        <?php 
                    
                            $brands = Functions::Brands()->getAllBrands();

                            foreach ($brands as $brand) { ?>
                                <option value="<?php out($brand["id"]); ?>"><?php out($brand["brand_name"]); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Enter the Model Name">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <input class="form-input" type="text" id="model_name" name="model_name" placeholder="Model Name...">
                </div>
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Select the height in Rack Units (RU)">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <select class="form-select" id="amp_height" name="amp_height">
                            <option>Select Height...</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                        <span class="input-group-addon addon-sm">Rack Units</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-left" data-tooltip="Select the amount of channels the amplifier has">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <select class="form-select" id="amp_channels" name="amp_channels">
                            <option>Select Channels...</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                        <span class="input-group-addon addon-sm">Channels</span>
                    </div>
                </div>
            </div>

            <h3>Amplifier Power</h3>
            <h6>@ 16 Ω</h6>            
            <div class="form-divider">
                <div style="grid-column:1/3;" class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Enter the Power the amplifier supplies">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <input class="form-input" type="number" id="amp_power_16" name="amp_power_16" oninput="calculateVpeakAndVgain('amp_power_16', 'amp_vpeak_16', 'amp_vgain_16', 16)" placeholder="Power (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Vpeak (V)">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <input class="form-input" type="number" step="0.01" id="amp_vpeak_16" name="amp_vpeak_16" placeholder="Vpeak (V)">
                        <span class="input-group-addon addon-sm">Volt</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-left" data-tooltip="Vgain (dB)">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <input class="form-input" type="number" step="0.01" id="amp_vgain_16" name="amp_vgain_16" placeholder="Vgain (dB)">
                        <span class="input-group-addon addon-sm">dB</span>
                    </div>
                </div>
            </div>
            <h6>@ 8 Ω</h6>            
            <div class="form-divider">
                <div style="grid-column:1/3;" class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" id="amp_power_8" name="amp_power_8" oninput="calculateVpeakAndVgain('amp_power_8', 'amp_vpeak_8', 'amp_vgain_8', 8)" placeholder="Power (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" step="0.01" id="amp_vpeak_8" name="amp_vpeak_8" placeholder="Vpeak (V)...">
                        <span class="input-group-addon addon-sm">Volt</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" step="0.01" id="amp_vgain_8" name="amp_vgain_8" placeholder="Vgain (dB)...">
                        <span class="input-group-addon addon-sm">dB</span>
                    </div>
                </div>
            </div>
            <h6>@ 4 Ω</h6>            
            <div class="form-divider">
                <div style="grid-column:1/3;" class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" id="amp_power_4" name="amp_power_4" oninput="calculateVpeakAndVgain('amp_power_4', 'amp_vpeak_4', 'amp_vgain_4', 4)" placeholder="Power (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" step="0.01" id="amp_vpeak_4" name="amp_vpeak_4" placeholder="Vpeak (V)...">
                        <span class="input-group-addon addon-sm">Volt</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" step="0.01" id="amp_vgain_4" name="amp_vgain_4" placeholder="Vgain (dB)...">
                        <span class="input-group-addon addon-sm">dB</span>
                    </div>
                </div>
            </div>
            <h6>@ 2 Ω</h6>            
            <div class="form-divider">
                <div style="grid-column:1/3;" class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" id="amp_power_2" name="amp_power_2" oninput="calculateVpeakAndVgain('amp_power_2', 'amp_vpeak_2', 'amp_vgain_2', 2)" placeholder="Power (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" step="0.01" id="amp_vpeak_2" name="amp_vpeak_2" placeholder="Vpeak (V)...">
                        <span class="input-group-addon addon-sm">Volt</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" step="0.01" id="amp_vgain_2" name="amp_vgain_2" placeholder="Vgain (dB)...">
                        <span class="input-group-addon addon-sm">dB</span>
                    </div>
                </div>
            </div>
            <h6>Bridged @ 8 Ω</h6>            
            <div class="form-divider">
                <div style="grid-column:1/3;" class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" id="amp_power_bridge_8" name="amp_power_bridge_8" oninput="calculateVpeakAndVgain('amp_power_bridge_8', 'amp_vpeak_bridge_8', 'amp_vgain_bridge_8', 8)" placeholder="Power Brdiged (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" step="0.01" id="amp_vpeak_bridge_8" name="amp_vpeak_bridge_8" placeholder="Vpeak (V)...">
                        <span class="input-group-addon addon-sm">Volt</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" step="0.01" id="amp_vgain_bridge_8" name="amp_vgain_bridge_8" placeholder="Vgain (dB)...">
                        <span class="input-group-addon addon-sm">dB</span>
                    </div>
                </div>
            </div>
            <h6>Bridged @ 4 Ω</h6>            
            <div class="form-divider">
                <div style="grid-column:1/3;" class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" id="amp_power_bridge_4" name="amp_power_bridge_4" oninput="calculateVpeakAndVgain('amp_power_bridge_4', 'amp_vpeak_bridge_4', 'amp_vgain_bridge_4', 4)" placeholder="Power Bridged (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" step="0.01" id="amp_vpeak_bridge_4" name="amp_vpeak_bridge_4" placeholder="Vpeak (V)...">
                        <span class="input-group-addon addon-sm">Volt</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="input-group">
                        <input class="form-input" type="number" step="0.01" id="amp_vgain_bridge_4" name="amp_vgain_bridge_4" placeholder="Vgain (dB)...">
                        <span class="input-group-addon addon-sm">dB</span>
                    </div>
                </div>
            </div>
            <h6>Documents/Manual</h6>
            <div class="form-divider">
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Upload the PDF manual of the amplifier">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <input class="form-input" type="file" id="amp_manual" name="amp_manual" accept=".pdf">
                </div>
            </div>
            <button class="btn btn-primary input-group-btn">Register</button>
        </div>
    </div>
    </form>

    <script>
        function calculateVpeakAndVgain(powerInputId, vpeakInputId, vgainInputId, ohms) {
            const powerInput = document.getElementById(powerInputId);
            const vpeakInput = document.getElementById(vpeakInputId);
            const vgainInput = document.getElementById(vgainInputId);

            // Get the entered power value
            const power = parseFloat(powerInput.value);

            // Calculate Vpeak and Vgain
            const vpeak = Math.sqrt(power * ohms);
            const vgain = 20 * Math.log10(vpeak);

            // Update the Vpeak and Vgain fields
            vpeakInput.value = vpeak.toFixed(2);
            vgainInput.value = vgain.toFixed(2);
        }
    </script>

    <?php 
} 

Partials::Close();
?>