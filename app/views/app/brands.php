<link rel="stylesheet" href="/includes/assets/css/brands.css">
<?php //amplifier.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);
?>

<h3><?php Translator::translate("brands.brands"); ?></h3>

<div class="toolbar">
    <ul>
        <li><a href="/app/new/brand"><?php Translator::translate("brands.new_brand"); ?></a></li>
    </ul>
</div>

<div class="toolbar-search">
    <ul>
        <li><input class="form-input table-custom-search" type="search" id="search_brand" placeholder="<?php Translator::translate("brands.search"); ?>..."></li>
    </ul>
</div>

<div class="table-custom">
    <table class="table">
    <thead>
        <tr>
            <th><?php Translator::translate("brands.brand"); ?></th>
            <th><?php Translator::translate("brands.contributor"); ?></th>
            <th><?php Translator::translate("brands.actions"); ?></th>
        </tr>
    </thead>
    <tbody>
            <?php 
            
            $brands = Functions::Brands()->getAllBrands();

            foreach ($brands as $brand) { ?>
                <tr>
                    <td><?php out($brand["brand_name"]); ?></td>
                    <td>
                        <?php
                            $user_id = $brand["user_id"];
                            $user = Functions::Users()->getUser($user_id);
                            $user_name = $user["user_name"];
                            out($user_name); 
                        ?>
                    </td>
                    <td>
                        <a class="edit" href="/app/edit/brand/<?php out($brand["id"]); ?>"><i class="fas fa-pen"></i></a>
                        <a class="del" href="/app/del/brand/<?php out($brand["id"]); ?>"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>

            <?php } ?>
    </tbody>
    </table>
</div>

<script src="/node_modules\jquery\dist\jquery.min.js"></script>
<script>
    $('table').scrollTableBody();

    $(document).ready(function() {
        $("#search_brand").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<?php Partials::Close(); ?>