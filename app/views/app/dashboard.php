<link rel="stylesheet" href="includes/assets/css/dashboard.css">
<?php //dashboard.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

$amplifier_count = Functions::Amplifiers()->count();
$speaker_count = Functions::Speakers()->count();
$processor_count = Functions::Processors()->count();
$brand_count = Functions::Brands()->count();

?>
<h3><?php Translator::translate("dashboard.dashboard"); ?></h3>

<div class="chart amplifiers"><p>You have currently registered <?php out($amplifier_count); ?> Amplifiers.</p></div>
<div class="chart speakers"><p>You have currently registered <?php out($speaker_count); ?> Speakers.</p></div>
<div class="chart processor"><p>You have currently registered <?php out($processor_count); ?> Processors.</p></div>
<div class="chart brands"><p>You have currently registered <?php out($brand_count); ?> Brands.</p></div>

<?php 
Partials::Close();
?>