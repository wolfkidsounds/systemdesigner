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
        <li class="nav-item">
            <a href="/app/amplifiers"><?php Translator::translate("sidebar.amplifiers"); ?></a>
        </li>
        <div class="horizontal-divider"></div>
        <li class="nav-item">
            <a href="/app/speakers"><?php Translator::translate("sidebar.speakers"); ?></a>
        </li>
        <li class="nav-item">
            <a href="/app/chassis"><?php Translator::translate("sidebar.chassis"); ?></a>
        </li>
        <div class="horizontal-divider"></div>
        <li class="nav-item">
            <a href="/app/processors"><?php Translator::translate("sidebar.processors"); ?></a>
        </li>
        <div class="horizontal-divider"></div>
        <li class="nav-item">
            <a href="/app/brands"><?php Translator::translate("sidebar.brands"); ?></a>
        </li>
        <div class="horizontal-divider"></div>
        <li class="nav-item">
            <a href="/app/setups"><?php Translator::translate("sidebar.setups"); ?></a>
        </li>
        <li class="nav-item">
            <a href="/app/configurations"><?php Translator::translate("sidebar.configurations"); ?></a>
        </li>
        <li class="nav-item">
            <a href="/app/management"><?php Translator::translate("sidebar.management"); ?></a>
        </li>
    </ul>
</sidebar>