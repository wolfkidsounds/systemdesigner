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
            <a href="/app/amplifiers">Amplifiers</a>
        </li>
        <li class="nav-item">
            <a href="/app/speakers">Speakers</a>
        </li>
        <li class="nav-item">
            <a href="/app/processors">Processors (DSP)</a>
        </li>
        <div class="horizontal-divider"></div>
        <li class="nav-item">
            <a href="/app/setups">Setups</a>
        </li>
        <li class="nav-item">
            <a href="/app/configurations">Configuration</a>
        </li>
        <li class="nav-item">
            <a href="/app/management">Management</a>
        </li>
        <div class="horizontal-divider"></div>
        <li class="nav-item">
            <a href="/app/brands">Brands</a>
        </li>
    </ul>
</sidebar>