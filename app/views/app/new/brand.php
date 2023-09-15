<link rel="stylesheet" href="/includes/assets/css/brands.css">
<?php //amplifier.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $name = $_POST['brand_name'];

    if (empty($name)) {
        ?> 
        <div class="toast toast-error">
            <p>The Fields can not be empty.</p>
        </div>
        <?php
    }

    if (Functions::checkEmptyFields($name)) {
        Functions::registerBrand($brand_name);
    }

    header("Location: /app/brands");

} else {

    ?>
    <h3>New Brand</h3>
    <form name="new_brand" method="post" action="/app/new/brand">
    <div class="form-group">
        <div class="new_brand_form">
            <input class="form-input" type="text" id="brand_name" name="brand_name" placeholder="Brand Name...">
            <button class="btn btn-primary input-group-btn">Register</button>
        </div>
    </div>
    </form>

    <?php
} ?>

<?php Partials::Close(); ?>