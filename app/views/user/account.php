<link rel="stylesheet" href="/includes\assets\css\account.css">
<?php //user/account.php

require_once ABSPATH . "app/functions/functions.php";
if (!Functions::Users()->checkLogin()) {
    header("Location: /login");
    exit();
}

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

?>

<div class="toolbar">
    <ul>
        <li><a href="/logout"><?php Translator::translate("account.logout"); ?></a></li>
    </ul>
</div>
<div class="table-custom">
    <table class="table">
    <thead>
        <tr>
            <th><?php Translator::translate("account.name"); ?></th>
            <th><?php Translator::translate("account.email"); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php out($_SESSION["user_name"]) ?></td>
            <td><?php out($_SESSION["user_mail"]) ?></td>
        </tr>
    </tbody>
    </table>
</div>

<?php
$user_id = Functions::Users()->getUserID();
$settings = Functions::Users()->getAllSettings($user_id);
?>
<div class="table-custom">
    <table class="table">
    <thead>
        <tr>
            <th><?php Translator::translate("account.settings_key"); ?></th>
            <th><?php Translator::translate("account.settings_value"); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($settings as $setting) { ?>
            <tr>
                <td><?php Translator::translate($setting["setting_key"]); ?></td>
                <td>
                    <label class="form-switch">
                        <input 
                            class="options"
                            value="<?php out($setting["setting_key"]); ?>" 
                            id="<?php out($setting["setting_key"]); ?>" 
                            name="<?php out($setting["setting_key"]); ?>"
                            type="checkbox" 
                            <?php if ($setting["setting_value"] == true) { out("checked"); } ?>>
                            <i class="form-icon"></i>
                    </label>                     
                </td>
            </tr>
        <?php } ?>
    </tbody>
    </table>
</div>
<script src="/node_modules\jquery\dist\jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("input[type='checkbox'].options").change(function () {
            const optionName = this.id; // Get the option name
            const isChecked = this.checked; // Get whether it's checked or not
            const iconElement = $(this).closest('label').find('i');
            iconElement.addClass("loading");

            // Send an AJAX request to update the option in the database
            updateOption(optionName, isChecked, iconElement);
        });

        function updateOption(optionName, isChecked, iconElement) {
            // Use jQuery's $.ajax() method to send the request
            $.ajax({
                type: "POST",
                url: "/user/account/update",
                data: JSON.stringify({ optionName, isChecked }),
                contentType: "application/json",
                success: function (data) {
                    console.log(data); // Handle the response from the server (if needed)
                    iconElement.removeClass("loading");
                },
                error: function (error) {
                    console.error("There was a problem with the AJAX request:", error);
                    iconElement.removeClass("loading");
                }
            });
        }
    });
</script>

<?php Partials::Close() ?>