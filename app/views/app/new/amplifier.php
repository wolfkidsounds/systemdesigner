<link rel="stylesheet" href="/includes/assets/css/amplifier.css">
<link rel="stylesheet" href="/includes/assets/css/new_item.css">

<?php //new/amplifer.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $brand_name = $_POST['brand_name'];
    $amp_model = $_POST['amp_model'];
    $amp_height = $_POST['amp_height'];
    $amp_channels = $_POST['amp_channels'];
    $amp_power_16 = $_POST['amp_power_16'];
    $amp_vpeak_16 = $_POST['amp_vpeak_16'];
    $amp_vgain_16 = $_POST['amp_vgain_16'];
    $amp_power_8 = $_POST['amp_power_8'];
    $amp_vpeak_8 = $_POST['amp_vpeak_8'];
    $amp_vgain_8 = $_POST['amp_vgain_8'];
    $amp_power_4 = $_POST['amp_power_4'];
    $amp_vpeak_4 = $_POST['amp_vpeak_4'];
    $amp_vgain_4 = $_POST['amp_vgain_4'];
    $amp_power_2 = $_POST['amp_power_2'];
    $amp_vpeak_2 = $_POST['amp_vpeak_2'];
    $amp_vgain_2 = $_POST['amp_vgain_2'];
    $amp_power_bridge_8 = $_POST['amp_power_bridge_8'];
    $amp_vpeak_bridge_8 = $_POST['amp_vpeak_bridge_8'];
    $amp_vgain_bridge_8 = $_POST['amp_vgain_bridge_8'];
    $amp_power_bridge_4 = $_POST['amp_power_bridge_4'];
    $amp_vpeak_bridge_4 = $_POST['amp_vpeak_bridge_4'];
    $amp_vgain_bridge_4 = $_POST['amp_vgain_bridge_4'];

    if (empty($brand_name) || empty($amp_model) || empty($amp_height) || empty($amp_channels) || empty($amp_power_16) || empty($amp_power_8) || empty($amp_power_4) || empty($amp_power_2) || empty($amp_power_bridge_8) || empty($amp_power_bridge_4)) {
        ?> 
        <div class="toast toast-error">
            <p>The Fields can not be empty.</p>
        </div>
        <?php
    }

    if (Functions::checkEmptyFields($brand_name)) {
        Functions::registerAmplifier($brand_name);
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
                    
                            $brands = Functions::getAllBrands();

                            foreach ($brands as $brand) { ?>
                                <option><?php out($brand["brand_name"]); ?></option>
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
                        <input class="form-input" type="number" id="amp_power_8" name="amp_power_8" placeholder="Power (W)...">
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
                        <input class="form-input" type="number" id="amp_power_4" name="amp_power_4" placeholder="Power (W)...">
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
                        <input class="form-input" type="number" id="amp_power_2" name="amp_power_2" placeholder="Power (W)...">
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
                        <input class="form-input" type="number" id="amp_power_bridge_8" name="amp_power_bridge_8" placeholder="Power Bridged (W)...">
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
                        <input class="form-input" type="number" id="amp_power_bridge_4" name="amp_power_bridge_4" placeholder="Power Bridged (W)...">
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