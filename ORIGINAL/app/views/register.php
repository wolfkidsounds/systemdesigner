<link rel="stylesheet" href="includes/assets/css/login.css">
<link rel="stylesheet" href="includes/assets/css/register.css">
<?php //register.php

require_once ABSPATH . "/app/functions/functions.php";
if (Functions::Users()->checkLogin()) {
    header("Location: /app/dashboard");
    exit();
}

require_once __DIR__ . "/partials/inc_partials.php";
Partials::Open();
Partials::Header(true, false);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    if (empty($name) || empty($mail) || empty($password)) {
        ?> 
        <div class="toast toast-error">
            <p>The Fields can not be empty.</p>
        </div>
        <?php
    }

    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        ?> 
        <div class="toast toast-error">
            <p>Please type a valid email address.</p>
        </div>
        <?php
    }

    if (preg_match('/^[a-zA-Z0-9 _-]+$/', $name)) {
        ?> 
        <div class="toast toast-error">
            <p>Please type a valid name.</p>
        </div>
        <?php
    }

    if (preg_match('/^[a-zA-Z0-9_-]+$/', $password)) {
        ?> 
        <div class="toast toast-error">
            <p>Please type a valid password.</p>
        </div>
        <?php
    }

    if (Functions::Users()->checkUser($mail)) {
        ?> 
        <div class="toast toast-error">
            <p>The email was already registered.</p>
        </div>
        <?php
    }

    $registration = Functions::Users()->registerUser($name, $mail, $password);

    if ($registration) {
        header("Location: /login");
        exit();

    } else {
        ?> 
        <div class="toast toast-error">
            <p>Something went wrong during registration.</p>
        </div>

        <h3><?php Translator::translate("register.register"); ?></h3>
        <form name="Register" method="post" action="/register">
        <div class="form-group">
            <div class="register-form">
                <input class="form-input" type="name" id="name" name="name" value="<?php out($name) ?>" placeholder="<?php Translator::translate("register.name"); ?>">
                <input class="form-input" type="email" id="mail" name="mail" value="<?php out($mail) ?>" placeholder="<?php Translator::translate("register.email"); ?>">
                <input class="form-input" type="password" id="password" name="password" placeholder="<?php Translator::translate("register.password"); ?>">
                <button class="btn btn-primary input-group-btn"><?php Translator::translate("register.register"); ?></button>
            </div>
        </div>
        </form>

        <?php
        exit();
    }

} else {

    ?>

    <h3><?php Translator::translate("register.register"); ?></h3>
    <form name="Register" method="post" action="/register">
    <div class="form-group">
        <div class="register-form">
        <input class="form-input" type="name" id="name" name="name" placeholder="<?php Translator::translate("register.name"); ?>">
                <input class="form-input" type="email" id="mail" name="mail" placeholder="<?php Translator::translate("register.email"); ?>">
                <input class="form-input" type="password" id="password" name="password" placeholder="<?php Translator::translate("register.password"); ?>">
            <button class="btn btn-primary input-group-btn"><?php Translator::translate("register.register"); ?></button>
        </div>
    </div>
    </form>

    <?php
}

Partials::Close();

?>