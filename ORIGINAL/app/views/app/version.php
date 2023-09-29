<?php //amplifier.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

$file_path = 'changelog.txt';

if (file_exists($file_path)) {
    $file_contents = file_get_contents($file_path);
} else {
    $file_contents = 'File not found.';
}
?>

<h3><?php Translator::translate("app.version"); ?></h3>
<div class="form-divider">
    <p><?php out(VERSION); ?></p>
</div>
<div class="form-divider">
    <h6><?php Translator::translate("app.changelog"); ?></h6>
    <pre>
        <?php echo htmlspecialchars($file_contents); ?>
    </pre>
</div>

<?php Partials::Close(); ?>