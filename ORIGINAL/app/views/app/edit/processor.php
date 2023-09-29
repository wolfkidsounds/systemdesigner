<link rel="stylesheet" href="/includes/assets/css/processors.css">
<link rel="stylesheet" href="/includes/assets/css/new_item.css">

<?php //new/brand.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $brand_id = $_POST['brand_id'];
    $name = $_POST['name'];
    $inputs = $_POST['inputs'];
    $outputs = $_POST['outputs'];
    $offset = $_POST['offset'];
    $brand = Functions::Brands()->get($brand_id);
    $brand_name = $brand["name"];
    $id = $processor_id;
    Functions::Processors()->setBrand($id, $brand_id);
    Functions::Processors()->setName($id, $name);
    Functions::Processors()->setInputs($id, $inputs);
    Functions::Processors()->setOutputs($id, $outputs);
    Functions::Processors()->setOffset($id, $offset);
    $upload_directory = "/uploads/";
    $filename = $brand_name . "_-_" . $name . ".pdf";
    $destination = $_SERVER['DOCUMENT_ROOT'] . $upload_directory . $filename;

    if (file_exists($destination)) {
        unlink($destination);
    }
    if (move_uploaded_file($_FILES['manual']['tmp_name'], $destination)) {
        Functions::Processors()->setFile($id, $filename);
    }

    header("Location: /app/edit/processor/" . $id);

} else {

    $processor = Functions::Processors()->get($processor_id);
    $brand_id = $processor["brand_id"];
    $brand = Functions::Brands()->get($brand_id);
    $brand_name = $brand["name"];
    $name = $processor["name"];
    $inputs = $processor["ch_inputs"];
    $outputs = $processor["ch_outputs"];
    $offset = $processor["proc_offset"];
    $manual = $processor["file_attachment"];

    ?>
    <h3>Edit <?php out($brand_name . " - " . $name); ?></h3>
    <form name="edit_processor" method="post" action="/app/edit/processor/<?php out($processor_id); ?>" enctype="multipart/form-data">
    <div class="form-group">
        <div class="edit_processor_form">
            <h3>General</h3>
            <div class="form-divider">
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Select the Brand that Manufacture">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <select class="form-select" id="brand_id" name="brand_id">
                        <option value="<?php out($brand_id); ?>"><?php out($brand_name); ?></option>
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
                    <input class="form-input" type="text" id="name" name="name" value="<?php out($name); ?>" placeholder="Model Name...">
                </div>
            </div>

            <h3>In/Out</h3>
            <div class="form-divider">
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-left" data-tooltip="Select the amount of inputs">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <select class="form-select" id="inputs" name="inputs">
                            <option value="<?php out($inputs); ?>"><?php out($inputs); ?></option>
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
                        <span class="input-group-addon addon-sm">ch</span>
                    </div>
                </div>
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-left" data-tooltip="Select the amount of outputs">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <select class="form-select" id="outputs" name="outputs">
                            <option value="<?php out($outputs); ?>"><?php out($outputs); ?></option>
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
                        <span class="input-group-addon addon-sm">ch</span>
                    </div>
                </div>
            </div>

            <h3>Offset</h3>
            <div class="form-divider">
                <div style="grid-column:1/3;" class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Processor Offset">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <div class="input-group">
                        <input class="form-input" type="number" id="offset" name="offset" value="<?php out($offset); ?>" placeholder="Offset (dB)...">
                        <span class="input-group-addon addon-sm">dB</span>
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

    <?php
} ?>

<?php Partials::Close(); ?>