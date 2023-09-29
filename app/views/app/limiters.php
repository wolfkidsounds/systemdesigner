<?php //limiters.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);
?>

<h3><?php Translator::translate("limiters.limiters"); ?></h3>

<div class="toolbar">
    <ul>
        <li><a href="/app/new/limiter"><?php Translator::translate("limiter.new_lmiter"); ?></a></li>
        <input class="form-input table-custom-search" type="search" id="search" placeholder="<?php Translator::translate("limiters.search"); ?>..."></li>
    </ul>
</div>

<div class="table-custom">
    <table class="table">
    <thead>
        <tr>
            <th><?php Translator::translate("limiters.name"); ?></th>
            <th><?php Translator::translate("limiters.processor"); ?></th>
            <th><?php Translator::translate("limiters.amplifier"); ?></th>
            <th><?php Translator::translate("limiters.speaker"); ?></th>
            <th><?php Translator::translate("limiters.peak_value"); ?></th>
            <th><?php Translator::translate("limiters.rms_value"); ?></th>
            <th><?php Translator::translate("limiters.actions"); ?></th>
        </tr>
    </thead>
    <tbody>
            <?php 
            
            $limiters = Functions::Limiters()->getAll();
            

            if (!$limiters) {
                out("No Limiters were found.");                
            }

            foreach ($limiters as $limiter) { ?>
                <tr data-id="<?php out($limiter["id"]); ?>">
                    <td><?php out($limiter["name"]); ?></td>
                    <td>
                        <?php
                            $processor_id = $limiter["processor_id"];
                            $processor = Functions::Processors()->get($processor_id);
                            if ($processor) { $brand = Functions::Brands()->get($processor["brand_id"]); }
                            if ($brand) { out($brand["name"] . " - " . $processor["name"]); } 
                            else { out(Translator::translate("processors.not_found")); }
                        ?>
                    </td>
                    <td>
                        <?php
                            $amplifier_id = $limiter["amplifier_id"];
                            $amplifier = Functions::Amplifiers()->get($amplifier_id);
                            if ($amplifier) { $brand = Functions::Brands()->get($amplifier["brand_id"]); }
                            if ($brand) { out($brand["name"] . " - " . $amplifier["name"]); } 
                            else { out(Translator::translate("amplifiers.not_found")); }
                        ?>
                    </td>
                    <td>
                        <?php
                            $speaker_id = $limiter["speaker_id"];
                            $speaker = Functions::Speakers()->get($speaker_id);
                            if ($speaker) { $brand = Functions::Brands()->get($speaker["brand_id"]); }
                            if ($brand) { out($brand["name"] . " - " . $speaker["name"]); } 
                            else { out(Translator::translate("speakers.not_found")); }
                        ?>
                    </td>
                    <td><?php out($limiter["lim_peak_val"]); ?></td>
                    <td><?php out($limiter["lim_rms_val"]); ?></td>
                    <td>
                        <?php if (Functions::Users()->getUserID() == $user_id = $limiter["user_id"]) { ?>
                            <a class="edit action-button tooltip" data-id="<?php out($limiter["id"]); ?>" data-tooltip="<?php Translator::translate("limiters.edit"); ?>" href="/app/edit/limiter/<?php out($limiter["id"]); ?>"><i class="fa-solid fa-pen"></i></a>
                            <a class="del action-button tooltip" data-id="<?php out($limiter["id"]); ?>" data-tooltip="<?php Translator::translate("limiters.delete"); ?>" href="javascript:void(0);" onclick="deleteItem('limiter', <?php out($limiter['id']); ?>);"><i class="fas fa-trash"></i></a>
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