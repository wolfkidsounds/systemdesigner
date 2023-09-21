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
        <input class="form-input table-custom-search" type="search" id="search" placeholder="<?php Translator::translate("brands.search"); ?>..."></li>
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
            
            $brands = Functions::Brands()->getAll();

            foreach ($brands as $brand) { ?>
                <tr data-id="<?php out($brand["id"]); ?>">
                    <td><?php out($brand["name"]); ?></td>
                    <td>
                        <?php
                            $user_id = $brand["user_id"];
                            $user = Functions::Users()->getUser($user_id);
                            $user_name = $user["user_name"];
                            out($user_name); 
                        ?>
                    </td>
                    <td>
                        <a class="edit action-button tooltip" data-id="<?php out($brand["id"]); ?>" data-tooltip="<?php Translator::translate("brands.edit"); ?>" href="/app/edit/brand/<?php out($brand["id"]); ?>"><i class="fa-solid fa-pen"></i></a>
                        <a class="del action-button tooltip" data-id="<?php out($brand["id"]); ?>" data-tooltip="<?php Translator::translate("brands.delete"); ?>" href="javascript:void(0);" onclick="deleteItem(<?php out($brand['id']); ?>);"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>

            <?php } ?>
    </tbody>
    </table>
</div>

<script src="/node_modules\jquery\dist\jquery.min.js"></script>
<script src="/includes\assets\js\overviews\search.js"></script>
<script src="/includes\assets\js\overviews\delete_item.js"></script>
<?php Partials::Close(); ?>