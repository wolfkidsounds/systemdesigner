<link rel="stylesheet" href="includes/assets/css/dsp.css">
<?php //dsp.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);
?>

<h3><?php Translator::translate("processors.processors"); ?></h3>

<div class="toolbar">
    <ul>
        <li><a href="/app/new/processor"><?php Translator::translate("processors.new"); ?></a></li>
    </ul>
</div>

<div class="toolbar-search">
    <ul>
        <li><input class="form-input table-custom-search" type="search" id="search" placeholder="<?php Translator::translate("processors.search"); ?>..."></li>
    </ul>
</div>

<div class="table-custom">
    <table class="table">
    <thead>
        <tr>
            <th><?php Translator::translate("processors.brand"); ?></th>
            <th><?php Translator::translate("processors.model"); ?></th>
            <th><?php Translator::translate("processors.inputs"); ?></th>
            <th><?php Translator::translate("processors.outputs"); ?></th>
            <th><?php Translator::translate("processors.offset"); ?></th>
            <th><?php Translator::translate("processors.contributors"); ?></th>
            <th><?php Translator::translate("processors.actions"); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $processors = Functions::Processors()->getAllProcessors();
            foreach ($processors as $processor) { ?>
                <tr>
                    <td>
                        <?php
                            $brand_id = $processor["proc_brand_id"];
                            $brand = Functions::Brands()->getBrand($brand_id);
                            $brand_name = $brand["brand_name"];
                            out($brand_name); 
                        ?>
                    </td>
                    <td><?php out($processor["proc_model_name"]); ?></td>
                    <td><?php out($processor["proc_inputs"]); ?></td>
                    <td><?php out($processor["proc_outputs"]); ?></td>
                    <td><?php out($processor["proc_offset"]); ?></td>
                    <td>
                        <?php
                            $user_id = $processor["proc_user_id"];
                            $user = Functions::Users()->getUser($user_id);
                            $user_name = $user["user_name"];
                            out($user_name); 
                        ?>
                    </td>
                    <td>
                        <a class="edit" href="/app/edit/processor/<?php out($processor["id"]); ?>"><i class="fa-solid fa-pen"></i></a>
                        <a class="del" href="/app/del/processor/<?php out($processor["id"]); ?>"><i class="fas fa-trash"></i></a>
                        <a class="download" href="/app/download/processor/<?php out($processor["id"]); ?>"><i class="fas fa-file-download"></i></a>
                    </td>
                </tr>

        <?php } ?>
    </tbody>
    </table>
</div>

<script src="/node_modules\jquery\dist\jquery.min.js"></script>
<script>
$(document).ready(function() {
    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>

<?php Partials::Close(); ?>