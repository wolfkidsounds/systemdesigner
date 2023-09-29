<link rel="stylesheet" href="/includes/assets/css/brands.css">
<link rel="stylesheet" href="/includes/assets/css/new_item.css">

<?php //new/brand.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

$brand_types = array (
    "1" => "Amplifier Manufacturer",
    "2" => "Loudspeaker Manufacturer",
    "3" => "Processor Manfuacturer",
);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $name = $_POST['name'];
    $type = $_POST['type'];

    $exists = Functions::Brands()->check($name);
    if ($exists) {
        header("Location: /app/brands");
        exit();
    }

    if (Functions::Forms()->checkEmptyFields($name)) {
        Functions::Brands()->set($name, $type);
    }

    header("Location: /app/brands");

} else {

    ?>
    <h3>New Brand</h3>
    <form name="new_brand" method="post" action="/app/new/brand">
        <div class="form-group">
            <div class="new_brand_form">
                <div class="form-divider">
                    <div style="grid-column:1/2;" class="brand form-element-tooltip">
                        <input class="form-input" type="text" id="name" name="name" placeholder="Brand Name...">
                        <button class="btn btn-primary input-group-btn">Register</button>
                    </div>
                    <div style="grid-column:2/3;" class="brand form-element-tooltip">
                        <div class="input-group">
                        <select class="form-select" id="type" name="type">
                            <option>Select Type...</option>
                            <?php 
                                foreach ($brand_types as $key => $value) { ?>
                                    <option value="<?php out($key); ?>"><?php out($value); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
} ?>

<?php Partials::Close(); ?>