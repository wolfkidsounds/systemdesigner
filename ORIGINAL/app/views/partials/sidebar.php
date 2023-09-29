<link rel="stylesheet" href="/includes/assets/css/sidebar.css">
<?php //sidebar.php

require_once ABSPATH . "app/functions/functions.php";
if (!Functions::Users()->checkLogin()) {
    header("Location: /login");
    exit();
}
?>

<sidebar>
    <ul class="nav">
        <?php if (Modules::Features()->getBrandFeature()) { ?>
        <li class="nav-item">
            <a href="/app/brands"><?php Translator::translate("sidebar.brands"); ?></a>
        </li>
        <?php } ?>

        <?php if (Modules::Features()->getProcessorFeature()) { ?>
        <li class="nav-item">
            <a href="/app/processors"><?php Translator::translate("sidebar.processors"); ?></a>
        </li>
        <?php } ?>


        <?php if (Modules::Features()->getAmplifierFeature()) { ?>
        <li class="nav-item">
            <a href="/app/amplifiers"><?php Translator::translate("sidebar.amplifiers"); ?></a>
        </li>
        <?php } ?>

        <?php if (Modules::Features()->getChassisFeature()) { ?>
        <li class="nav-item">
            <a href="/app/chassis"><?php Translator::translate("sidebar.chassis"); ?></a>
        </li>
        <?php } ?>

        <?php if (Modules::Features()->getSpeakerFeature()) { ?>
        <li class="nav-item">
            <a href="/app/speakers"><?php Translator::translate("sidebar.speakers"); ?></a>
        </li>
        <?php } ?>

        <div class="horizontal-divider"></div>        

        <?php if (Modules::Features()->getLimiterFeature()) { ?>
        <li class="nav-item">
            <a href="/app/limiters"><?php Translator::translate("sidebar.limiters"); ?></a>
        </li>
        <?php } ?>

        <div class="horizontal-divider"></div>

        <?php if (Modules::Features()->getRackFeature()) { ?>
        
        <li class="nav-item">
            <a href="/app/rack"><?php Translator::translate("sidebar.racks"); ?></a>
        </li>
        <?php } ?>

        <?php if (Modules::Features()->getConfigurationFeature()) { ?>
        <li class="nav-item">
            <a href="/app/configurations"><?php Translator::translate("sidebar.configurations"); ?></a>
        </li>
        <?php } ?>

        <?php if (Modules::Features()->getManagementFeature()) { ?>
        <li class="nav-item">
            <a href="/app/management"><?php Translator::translate("sidebar.management"); ?></a>
        </li>
        <?php } ?>
    </ul>
</sidebar>  