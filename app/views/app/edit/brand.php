<link rel="stylesheet" href="/includes/assets/css/brands.css">
<link rel="stylesheet" href="/includes/assets/css/new_item.css">

<?php //new/brand.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $brand_name = $_POST['brand_name'];

    if (empty($brand_name)) {
        ?> 
        <div class="toast toast-error">
            <p>Brand name can not be emtpy.</p>
        </div>
        <?php
    }

    Functions::Brands()->update($brand_id, $brand_name);

    header("Location: /app/brands");

} else {

    $brand = Functions::Brands()->get($brand_id);
    $brand_name = $brand["name"];

    ?>
    <h3>Edit Brand</h3>
    <form name="edit_brand" method="post" action="/app/edit/brand/<?php out($brand_id); ?>">
    <div class="form-group">
        <div class="edit_brand_form">
            <input class="form-input" type="text" id="brand_name" name="brand_name" value="<?php out($brand_name); ?>" placeholder="Brand Name...">
            <button class="btn btn-primary input-group-btn">Update</button>
        </div>
    </div>
    </form>

    <?php
} ?>

<?php Partials::Close(); ?>