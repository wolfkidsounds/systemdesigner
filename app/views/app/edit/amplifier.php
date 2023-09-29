<link rel="stylesheet" href="/includes/assets/css/amplifier.css">
<link rel="stylesheet" href="/includes/assets/css/new_item.css">

<?php //edit/amplifer.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $name = $_POST['name'];
    $height = $_POST['height'];
    $outputs = $_POST['channels'];
    $brand_id = $_POST['brand_id'];
    $brand = Functions::Brands()->get($brand_id);
    $brand_name = $brand["name"];
    $user_id = Functions::Users()->getUserID();
    $id = $amplifier_id;
    Functions::Amplifiers()->setBrand($id, $brand_id);
    Functions::Amplifiers()->setName($id, $name);
    Functions::Amplifiers()->setHeight($id, $height);
    Functions::Amplifiers()->setOutputs($id, $outputs);

    $upload_directory = "/uploads/";
    $filename = $brand_name . "_-_" . $name . ".pdf";
    $destination = $_SERVER['DOCUMENT_ROOT'] . $upload_directory . $filename;

    if (file_exists($destination)) {
        unlink($destination);
    }
    if (move_uploaded_file($_FILES['manual']['tmp_name'], $destination)) {
        Functions::Amplifiers()->setFile($id, $filename);
    }

    $power_specifications = [
        16, 8, 4, 2
    ];

    $bridge_power_specifications = [
        8, 4
    ];

    foreach ($power_specifications as $ohm) {
        $amp_power = $_POST["amp_power_{$ohm}"];

        // Set default values if empty
        if (empty($amp_power)) {
            $amp_power = 0;
        }

        // Register the amplifier power for the current specification
        Functions::Amplifiers()->setPower($id, $amp_power, $ohm, false);
    }

    foreach ($bridge_power_specifications as $ohm) {
        // Handle bridge variant
        $amp_power_bridge = $_POST["amp_power_bridge_{$ohm}"];

        // Set default values if empty
        if (empty($amp_power_bridge)) {
            $amp_power_bridge = 0;
        }

        // Register the amplifier power for the current specification (bridge)
        Functions::Amplifiers()->setPower($id, $amp_power_bridge, $ohm, true);
    }

    header("Location: /app/edit/amplifier/" . $id);

} else {

    $amplifier = Functions::Amplifiers()->get($amplifier_id);

    $amplifier_brand_id = $amplifier["brand_id"];
    $amplifier_brand = Functions::Brands()->get($amplifier_brand_id);
    $amplifier_brand_name = $amplifier_brand["name"];

    $amplifier_model_name = $amplifier["name"];
    $amplifier_height = $amplifier["rack_units"];
    $amplifier_channels = $amplifier["ch_outputs"];

    $amplifier_power_16 = $amplifier["amp_power_16"];
    $amplifier_power_8 = $amplifier["amp_power_8"];
    $amplifier_power_4 = $amplifier["amp_power_4"];
    $amplifier_power_2 = $amplifier["amp_power_2"];

    $amplifier_power_bridge_8 = $amplifier["amp_power_bridge_8"];
    $amplifier_power_bridge_4 = $amplifier["amp_power_bridge_4"];

    $manual = $amplifier['file_attachment'];
    ?>

    <h3>Edit <?php out($brand_name . " - " . $name); ?></h3>
    <form name="edit_amplifier" method="post" action="/app/edit/amplifier/<?php out($amplifier_id); ?>" enctype="multipart/form-data">
    <div class="form-group">
        <div class="edit_amplifier_form">
            <h3>General</h3>
            <div class="form-divider">
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Select the Brand that Manufacture">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <select class="form-select select2js" id="brand_id" name="brand_id">
                        <option value="<?php out($amplifier_brand_id); ?>" selected><?php out($amplifier_brand_name); ?></option>
                        <?php 
                    
                            $brands = Functions::Brands()->getAll();

                            foreach ($brands as $brand) { ?>
                                <option value="<?php out($brand["id"]); ?>"><?php out($brand["name"]); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Enter the Model Name">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <input class="form-input" type="text" id="name" name="name" value="<?php out($amplifier_model_name); ?>" placeholder="Model Name...">
                </div>
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Select the height in Rack Units (RU)">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <select class="form-select" id="height" name="height">
                            <option value="<?php out($amplifier_height); ?>" selected><?php out($amplifier_height); ?></option>
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
                        <select class="form-select" id="channels" name="channels">
                            <option value="<?php out($amplifier_channels); ?>" selected><?php out($amplifier_channels); ?></option>
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
                        
            <div class="form-divider">
                <div style="grid-column:1/3;" class="form-element-tooltip">
                    <h6>@ 16 Ω</h6>
                    <div class="input-group">
                        <input class="form-input" type="number" id="amp_power_16" name="amp_power_16" value="<?php out($amplifier_power_16); ?>" placeholder="Power (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
                <div style="grid-column:1/3;" class="form-element-tooltip">
                    <h6>@ 8 Ω</h6>
                    <div class="input-group">
                        <input class="form-input" type="number" id="amp_power_8" name="amp_power_8" value="<?php out($amplifier_power_8); ?>" placeholder="Power (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
                <div style="grid-column:1/3;" class="form-element-tooltip">
                    <h6>@ 4 Ω</h6>
                    <div class="input-group">
                        <input class="form-input" type="number" id="amp_power_4" name="amp_power_4" value="<?php out($amplifier_power_4); ?>" placeholder="Power (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
                <div style="grid-column:1/3;" class="form-element-tooltip">
                    <h6>@ 2 Ω</h6> 
                    <div class="input-group">
                        <input class="form-input" type="number" id="amp_power_2" name="amp_power_2" value="<?php out($amplifier_power_2); ?>" placeholder="Power (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
            </div>

                        
            <div class="form-divider">
                <div style="grid-column:1/3;" class="form-element-tooltip">
                    <h6>Bridged @ 8 Ω</h6>
                    <div class="input-group">
                        <input class="form-input" type="number" id="amp_power_bridge_8" name="amp_power_bridge_8" value="<?php out($amplifier_power_bridge_8); ?>" placeholder="Power Brdiged (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
                <div style="grid-column:1/3;" class="form-element-tooltip">
                    <h6>Bridged @ 4 Ω</h6>
                    <div class="input-group">
                        <input class="form-input" type="number" id="amp_power_bridge_4" name="amp_power_bridge_4" value="<?php out($amplifier_power_bridge_4); ?>" placeholder="Power Bridged (W)...">
                        <span class="input-group-addon addon-sm">Watt</span>
                    </div>
                </div>
                
            </div>

            <h6>Documents/Manual</h6>
            <div class="form-divider">
                <?php if ($manual) { ?>
                    <a class="btn" href="/uploads/<?php echo $manual; ?>" download>Download Manual</a>
                <?php } ?> 
                <div class="form-element-tooltip">
                    <input class="form-input" type="file" id="manual" name="manual" accept=".pdf">
                </div>
            </div>
            <button class="btn btn-primary input-group-btn">Update</button>
        </div>
    </div>
    </form>

    <script src="/node_modules\jquery\dist\jquery.min.js"></script>
    <script src="/node_modules\select2\dist\js\select2.min.js"></script>
    <script src="/includes\assets\js\select2.js"></script>

    <?php 
} 

Partials::Close();
?>