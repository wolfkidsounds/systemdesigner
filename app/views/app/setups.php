<link rel="stylesheet" href="includes/assets/css/setups.css">
<?php //setups.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);
?>

<h3><?php Translator::translate("setups.setups"); ?></h3>

<div class="toolbar">
    <ul>
        <li><a href="/app/new/setup"><?php Translator::translate("setups.new_setup"); ?></a></li>
    </ul>
</div>

<div class="toolbar-search">
    <ul>
        <li><input class="form-input table-custom-search" type="search" id="search" placeholder="Search..."></li>
    </ul>
</div>

<div class="table-custom">
    <table class="table">
    <thead>
        <tr>
            <th><?php Translator::translate("setups.name"); ?></th>
            <th><?php Translator::translate("setups.actions"); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Pulsation Audio - Setup 1</td>
            <td>
                <a class="edit action-button tooltip" data-tooltip="<?php Translator::translate("setups.edit"); ?>" href="/app/edit/setup/<?php out($setup["id"]); ?>"><i class="fa-solid fa-pen"></i></a>
                <a class="del action-button tooltip" data-tooltip="<?php Translator::translate("setups.delete"); ?>" href="/app/del/setup/<?php out($setup["id"]); ?>"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
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