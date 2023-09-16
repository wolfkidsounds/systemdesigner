<link rel="stylesheet" href="includes/assets/css/dashboard.css">
<?php //dashboard.php

require_once ABSPATH . "app/functions/functions.php";
if (!Functions::Users()->checkLogin()) {
    header("Location: /login");
    exit();
}

Functions::Users()->logoutUser();