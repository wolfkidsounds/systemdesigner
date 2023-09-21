<link rel="stylesheet" href="/includes/assets/css/brands.css">
<link rel="stylesheet" href="/includes/assets/css/new_item.css">

<?php //new/brand.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $name = $_POST['name'];

    $exists = Functions::Brands()->check($name);
    if ($exists) {
        header("Location: /app/brands");
        exit();
    }

    if (Functions::Forms()->checkEmptyFields($name)) {
        Functions::Brands()->set($name);
    }

} else {

    ?>
    <h3>New Brand</h3>
    <form name="new_brand" method="post" action="/app/new/brand">
    <div class="form-group">
        <div class="new_brand_form">
            <input class="form-input" type="text" id="name" name="name" placeholder="Brand Name...">
            <button class="btn btn-primary input-group-btn">Register</button>
        </div>
    </div>
    </form>

    <?php
} ?>

<?php Partials::Close(); ?>