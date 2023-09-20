<link rel="stylesheet" href="includes/assets/css/speaker.css">
<?php //speaker.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);
?>

<h3><?php Translator::translate("speakers.speakers"); ?></h3>

<div class="toolbar">
    <ul>
        <li><a href="/app/new/speaker"><?php Translator::translate("speakers.new_speaker"); ?></a></li>
    </ul>
</div>

<div class="toolbar-search">
    <ul>
        <li><input class="form-input table-custom-search" type="search" id="search" placeholder="<?php Translator::translate("speakers.search"); ?>..."></li>
    </ul>
</div>

<div class="table-custom">
    <table class="table">
    <thead>
        <tr>
            <th><?php Translator::translate("speakers.brand"); ?></th>
            <th><?php Translator::translate("speakers.model"); ?></th>
            <th>AES/RMS <?php Translator::translate("speakers.power"); ?> (W)</th>
            <th>Z nom. (Ω)</th>
            <th>Vrms (V)</th>
            <th><?php Translator::translate("speakers.sensitivity"); ?> 1W @ 1m (dB SPL)</th>
            <th><?php Translator::translate("speakers.contributors"); ?></th>
            <th><?php Translator::translate("speakers.actions"); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            
            $speakers = Functions::Speakers()->getAllSpeakers();

            foreach ($speakers as $speaker) { ?>
                <tr>
                    <td>
                        <?php
                            $brand_id = $speaker["speaker_brand"];
                            $brand = Functions::Brands()->getBrand($brand_id);
                            $brand_name = $brand["brand_name"];
                            out($brand_name); 
                        ?>
                    </td>
                    <td><?php out($speaker["speaker_model"]); ?></td>
                    <td><?php out($speaker["speaker_power_rms"]); ?></td>
                    <td><?php out($speaker["speaker_impedance_z"]); ?></td>
                    <td><?php out($speaker["speaker_vrms"]); ?></td>
                    <td><?php out($speaker["speaker_sens_spl"]); ?></td>
                    <td>
                        <?php
                            $user_id = $speaker["user_id"];
                            $user = Functions::Users()->getUser($user_id);
                            $user_name = $user["user_name"];
                            out($user_name); 
                        ?>
                    </td>
                    <td>
                        <a class="edit action-button tooltip" data-tooltip="<?php Translator::translate("speakers.edit"); ?>" href="/app/edit/speaker/<?php out($speaker["id"]); ?>"><i class="fa-solid fa-pen"></i></a>
                        <a class="del action-button tooltip" data-tooltip="<?php Translator::translate("speakers.delete"); ?>" href="/app/del/speaker/<?php out($speaker["id"]); ?>"><i class="fas fa-trash"></i></a>
                        <a class="download action-button tooltip" data-tooltip="<?php Translator::translate("speakers.download_datasheet"); ?>" href="/app/download/speaker/<?php out($speaker["id"]); ?>"><i class="fas fa-file-download"></i></a>
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