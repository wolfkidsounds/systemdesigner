<?php //speakers.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);
?>

<h3><?php Translator::translate("speakers.speakers"); ?></h3>

<div class="toolbar">
    <ul>
        <li><a href="/app/new/speaker"><?php Translator::translate("speakers.new_speaker"); ?></a></li>
        <li><input class="form-input table-custom-search" type="search" id="search" placeholder="<?php Translator::translate("speakers.search"); ?>..."></li>
    </ul>
</div>


<div class="table-custom">
    <table class="table">
    <thead>
        <tr>
            <th><?php Translator::translate("speakers.brand"); ?></th>
            <th><?php Translator::translate("speakers.model"); ?></th>
            <th><?php Translator::translate("speakers.type"); ?></th>
            <th>AES/RMS <?php Translator::translate("speakers.power"); ?> (W)</th>
            <th>Z nom. (Ω)</th>
            <th>Vrms (V)</th>
            <th>1W @ 1m (dB SPL)</th>
            <th><?php Translator::translate("speakers.contributors"); ?></th>
            <th><?php Translator::translate("speakers.actions"); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            
            $speakers = Functions::Speakers()->getAll();

            foreach ($speakers as $speaker) { ?>
                <tr data-id="<?php out($speaker["id"]); ?>">
                    <td>
                        <?php
                            $brand_id = $speaker["brand_id"];
                            $brand = Functions::Brands()->get($brand_id);
                            if ($brand) {
                                $brand_name = $brand["name"];
                                out($brand_name);
                            } else {
                                out(Translator::translate("brands.not_found"));
                            }
                             
                        ?>
                    </td>
                    <td><?php out($speaker["name"]); ?></td>
                    <td><?php out(Translator::translateReturn("speakers.type_" . $speaker["sp_type"])); ?></td>
                    <td><?php out($speaker["power_rms"]); ?></td>
                    <td><?php out($speaker["impedance"]); ?></td>
                    <td><?php out($speaker["vrms"]); ?></td>
                    <td><?php out($speaker["sensitivity"]); ?></td>
                    <td>
                        <?php
                            $user_id = $speaker["user_id"];
                            $user = Functions::Users()->getUser($user_id);
                            $user_name = $user["user_name"];
                            out($user_name); 
                        ?>
                    </td>
                    <td>
                        <?php if (Functions::Users()->getUserID() == $user_id = $speaker["user_id"]) { ?>
                            <a class="edit action-button tooltip" data-tooltip="<?php Translator::translate("speakers.edit"); ?>" href="/app/edit/speaker/<?php out($speaker["id"]); ?>"><i class="fa-solid fa-pen"></i></a>
                            <a class="del action-button tooltip" data-id="<?php out($speaker["id"]); ?>" data-tooltip="<?php Translator::translate("speakers.delete"); ?>" href="javascript:void(0);" onclick="deleteItem('speaker', <?php out($speaker['id']); ?>);"><i class="fas fa-trash"></i></a>
                        <?php } ?>
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