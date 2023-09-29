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
<h3><?php out(Translator::translate("account.account")); ?></h3>
<p class="account-page-text">
    <?php Translator::translate("account.page_text"); ?>
</p>

<div class="table-custom">
    <table class="table">
    <thead>
        <tr>
            <th><?php Translator::translate("account.subject"); ?></th>
            <th><?php Translator::translate("account.value"); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php Translator::translate("account.user_id"); ?><i class="fa-solid fa-question tooltip tooltip-right" data-tooltip="<?php Translator::translate("account.text.user_id"); ?>"></i></td>
            <td><?php out($_SESSION["user_id"]) ?></td>
        </tr>
        <tr>
            <td><?php Translator::translate("account.user_name"); ?><i class="fa-solid fa-question tooltip tooltip-right" data-tooltip="<?php Translator::translate("account.text.user_name"); ?>"></i></td>
            <td><?php out($_SESSION["user_name"]) ?></td>
        </tr>
        <tr>
            <td><?php Translator::translate("account.user_mail"); ?><i class="fa-solid fa-question tooltip tooltip-right" data-tooltip="<?php Translator::translate("account.text.user_mail"); ?>"></i></td>
            <td><?php out($_SESSION["user_mail"]) ?></td>
        </tr>
        <tr>
            <td><?php Translator::translate("account.selected_language"); ?><i class="fa-solid fa-question tooltip tooltip-right" data-tooltip="<?php Translator::translate("account.text.selected_language"); ?>"></i></td>
            <td><?php out($_SESSION["selected_language"]) ?></td>
        </tr>
        <tr>
            <td><?php Translator::translate("account.dos_counter"); ?><i class="fa-solid fa-question tooltip tooltip-right" data-tooltip="<?php Translator::translate("account.text.dos_counter"); ?>"></i></td>
            <td><?php out($_SESSION["DOS_COUNTER"]) ?></td>
        </tr>
        <tr>
            <td><?php Translator::translate("account.dos_attempts"); ?><i class="fa-solid fa-question tooltip tooltip-right" data-tooltip="<?php Translator::translate("account.text.dos_attempts"); ?>"></i></td>
            <td><?php out($_SESSION["DOS_ATTEMPTS"]) ?></td>
        </tr>
        <tr>
            <td><?php Translator::translate("account.dos_attempts_timer"); ?><i class="fa-solid fa-question tooltip tooltip-right" data-tooltip="<?php Translator::translate("account.text.dos_attempts_timer"); ?>"></i></td>
            <td><?php out($_SESSION["DOS_ATTEMPTS_TIMER"]) ?></td>
        </tr>
        <tr>
            <td><?php Translator::translate("account.dos_timer"); ?><i class="fa-solid fa-question tooltip tooltip-right" data-tooltip="<?php Translator::translate("account.text.dos_timer"); ?>"></i></td>
            <td><?php out($_SESSION["DOS_TIMER"]) ?></td>
        </tr>
        <tr>
            <td><?php Translator::translate("account.http_user_token"); ?><i class="fa-solid fa-question tooltip tooltip-right" data-tooltip="<?php Translator::translate("account.text.http_user_token"); ?>"></i></td>
            <td><?php out($_SESSION["HTTP_USER_TOKEN"]) ?></td>
        </tr>
        <tr>
            <td><?php Translator::translate("account.remember_me"); ?><i class="fa-solid fa-question tooltip tooltip-right" data-tooltip="<?php Translator::translate("account.text.remember_me"); ?>"></i></td>
            <td><?php out($_COOKIE["remember_me"]) ?></td>
        </tr>
        <tr>
            <td><?php Translator::translate("account.xsessid"); ?><i class="fa-solid fa-question tooltip tooltip-right" data-tooltip="<?php Translator::translate("account.text.xsessid"); ?>"></i></td>
            <td><?php out($_COOKIE["XSESSID"]) ?></td>
        </tr>
    </tbody>
    </table>
</div>

<?php Partials::Close() ?>