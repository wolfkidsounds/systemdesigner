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
    $manual = $_FILES['manual']['tmp_name'];
    $brand = Functions::Brands()->get($brand_id);
    $brand_name = $brand["name"];

    $exists = Functions::Processors()->check($brand_id, $name);
    
    if ($exists) {
        header("Location: /app/processors");
        exit();
    }


    $upload_directory = "/uploads/";
    $user_id = Functions::Users()->getUserID();
    $id = Functions::Processors()->set($user_id);
    Functions::Processors()->setBrand($id, $brand_id);
    Functions::Processors()->setName($id, $name);
    Functions::Processors()->setInputs($id, $inputs);
    Functions::Processors()->setOutputs($id, $outputs);
    Functions::Processors()->setOffset($id, $offset);
    $filename = $brand_name . "_-_" . $name . ".pdf";
    $destination = $_SERVER['DOCUMENT_ROOT'] . $upload_directory . $filename;

    if (file_exists($destination)) {
        echo "File already exists.";
    } else if (move_uploaded_file($_FILES['manual']['tmp_name'], $destination)) {
        Functions::Processors()->setFile($id, $filename);
    }

    header("Location: /app/processors");

} else {

    ?>
    <h3>New Processor</h3>
    <form name="new_processor" method="post" action="/app/new/processor" enctype="multipart/form-data">
    <div class="form-group">
        <div class="new_processor_form">
            <h3>General</h3>
            <div class="form-divider">
                <div class="form-element-tooltip">
                    <div class="tooltip tooltip-right" data-tooltip="Select the Brand that Manufacture">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <select class="form-select select2js" id="brand_id" name="brand_id">
                        <option>Select Brand...</option>
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
                    <input class="form-input" type="text" id="name" name="name" placeholder="Model Name...">
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
                            <option>Select Inputs...</option>
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
                            <option>Select Outputs...</option>
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
                        <input class="form-input" type="number" id="offset" name="offset" placeholder="Offset (dB)...">
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
                    <input class="form-input" type="file" id="manual" name="manual" accept=".pdf">
                </div>
            </div>
            <button class="btn btn-primary input-group-btn">Register</button>
        </div>
    </div>
    </form>

    <script src="/node_modules\jquery\dist\jquery.min.js"></script>
    <script src="/node_modules\select2\dist\js\select2.min.js"></script>
    <script src="/includes\assets\js\select2.js"></script>

    <?php
} ?>

<?php Partials::Close(); ?>