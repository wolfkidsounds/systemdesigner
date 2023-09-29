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
            $processors = Functions::Processors()->getAll();

            if (!$processors) {
                out("No Processors were found.");
            }

            foreach ($processors as $processor) { ?>
                <tr data-id="<?php out($processor["id"]); ?>">
                    <td>
                        <?php
                            $brand_id = $processor["brand_id"];
                            $brand = Functions::Brands()->get($brand_id);
                            if ($brand) {
                                $brand_name = $brand["name"];
                                out($brand_name);
                            } else {
                                out(Translator::translate("brands.not_found"));
                            }
                             
                        ?>
                    </td>
                    <td><?php out($processor["name"]); ?></td>
                    <td><?php out($processor["ch_inputs"]); ?></td>
                    <td><?php out($processor["ch_outputs"]); ?></td>
                    <td><?php out($processor["proc_offset"]); ?></td>
                    <td>
                        <?php
                            $user_id = $processor["user_id"];
                            $user = Functions::Users()->getUser($user_id);
                            $user_name = $user["user_name"];
                            out($user_name); 
                        ?>
                    </td>
                    <td>
                        <?php if (Functions::Users()->getUserID() == $user_id = $processor["user_id"]) { ?>
                            <a class="edit action-button tooltip" data-tooltip="<?php Translator::translate("processors.edit"); ?>" href="/app/edit/processor/<?php out($processor["id"]); ?>"><i class="fa-solid fa-pen"></i></a>
                            <a class="del action-button tooltip" data-id="<?php out($processor["id"]); ?>" data-tooltip="<?php Translator::translate("processors.delete"); ?>" href="javascript:void(0);" onclick="deleteItem('processor', <?php out($processor['id']); ?>);"><i class="fas fa-trash"></i></a>
                        <?php } ?>
                        <?php if ($processor["file_attachment"]) { ?> <a download class="download action-button tooltip" data-tooltip="<?php Translator::translate("processors.download_manual"); ?>" href="/uploads/<?php echo $processor["file_attachment"]; ?>"><i class="fas fa-file-download"></i></a><?php } ?>
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