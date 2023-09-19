<link rel="stylesheet" href="includes/assets/css/dashboard.css">
<?php //dashboard.php

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


<?php Partials::Close() ?>