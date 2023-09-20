<link rel="stylesheet" href="/includes/assets/css/amplifiers.css">
<?php //amplifier.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);
?>

<h3><?php Translator::translate("amplifiers.amplifiers"); ?></h3>

<div class="toolbar">
    <ul>
        <li><a href="/app/new/amplifier"><?php Translator::translate("amplifiers.new_amplifier"); ?></a></li>
        <li><input class="form-input table-custom-search" type="search" id="search" placeholder="<?php Translator::translate("amplifiers.search"); ?>..."></li>
    </ul>
</div>

<div class="table-custom">
    <table class="table">
    <thead>
        <tr>
            <th><?php Translator::translate("amplifiers.brand"); ?></th>
            <th><?php Translator::translate("amplifiers.model"); ?></th>
            <th><?php Translator::translate("amplifiers.channels"); ?></th>
            <th><?php Translator::translate("amplifiers.power"); ?> @ 8Ω</th>
            <th><?php Translator::translate("amplifiers.power"); ?> @ 4Ω</th>
            <th><?php Translator::translate("amplifiers.power"); ?> @ 2Ω</th>
            <th><?php Translator::translate("amplifiers.power_bridge"); ?> @ 8Ω</th>
            <th><?php Translator::translate("amplifiers.power_bridge"); ?> @ 4Ω</th>
            <th><?php Translator::translate("amplifiers.contributor"); ?></th>
            <th><?php Translator::translate("amplifiers.actions"); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            
            $amplifiers = Functions::Amplifiers()->getAllAmplifiers();

            foreach ($amplifiers as $amplifier) { ?>
                <tr>
                    <td>
                        <?php
                            $brand_id = $amplifier["amp_brand"];
                            $brand = Functions::Brands()->getBrand($brand_id);
                            $brand_name = $brand["brand_name"];
                            out($brand_name); 
                        ?>
                    </td>
                    <td><?php out($amplifier["amp_model"]); ?></td>
                    <td><?php out($amplifier["amp_ch"]); ?></td>
                    <td><?php out($amplifier["amp_power_8"]); ?></td>
                    <td><?php out($amplifier["amp_power_4"]); ?></td>
                    <td><?php out($amplifier["amp_power_2"]); ?></td>
                    <td><?php out($amplifier["amp_power_bridge_8"]); ?></td>
                    <td><?php out($amplifier["amp_power_bridge_4"]); ?></td>
                    <td>
                        <?php
                            $user_id = $amplifier["user_id"];
                            $user = Functions::Users()->getUser($user_id);
                            $user_name = $user["user_name"];
                            out($user_name); 
                        ?>
                    </td>
                    <td>
                        <a class="edit action-button tooltip" data-tooltip="<?php Translator::translate("amplifiers.edit"); ?>" href="/app/edit/amplifier/<?php out($amplifier["id"]); ?>"><i class="fa-solid fa-pen"></i></a>
                        <a class="del action-button tooltip" data-tooltip="<?php Translator::translate("amplifiers.delete"); ?>" href="/app/del/amplifier/<?php out($amplifier["id"]); ?>"><i class="fas fa-trash"></i></a>
                        <a class="download action-button tooltip" data-tooltip="<?php Translator::translate("amplifiers.download_manual"); ?>" href="/app/download/amplifier/<?php out($amplifier["id"]); ?>"><i class="fas fa-file-download"></i></a>
                    </td>
                </tr>

        <?php } ?>
    </tbody>
    </table>
</div>

<script src="/node_modules\jquery\dist\jquery.min.js"></script>
<script src="/includes\assets\js\search.js"></script>

<?php Partials::Close(); ?>