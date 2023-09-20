<link rel="stylesheet" href="includes/assets/css/login.css">
<?php //login.php

require_once ABSPATH . "app/functions/functions.php";
//Functions::Users()->checkRememberMe();

if (Functions::Users()->checkLogin()) {
    header("Location: /app/dashboard");
    exit();
}

require_once __DIR__ . "/partials/inc_partials.php";
Partials::Open();
Partials::Header(true, false);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $remember_me = $_POST['remember_me'];

    if (empty($mail) || empty($password)) {
        ?> 
        <div class="toast toast-error">
            <p>The Fields can not be empty.</p>
        </div>
        <?php
    }

    if (Functions::Users()->checkUser($mail)) {
        Functions::Users()->loginUser($mail, $password, $remember_me);
    }

    ?>
    <h3><?php Translator::translate("login.login"); ?></h3>
    <form name="login" method="post" action="/login">
    <div class="form-group">
        <div class="login-form">
            <input class="form-input" type="email" id="email" name="mail" value="<?php out($email) ?>" placeholder="<?php Translator::translate("login.email"); ?>">
            <input class="form-input" type="password" id="Password" name="password" placeholder="<?php Translator::translate("login.password"); ?>">

            <label class="form-checkbox">
            <input type="checkbox" id="remember_me" name="remember_me" value="<?php out($remember) ?>">
                <i class="form-icon"></i> <?php Translator::translate("login.remember_me"); ?>
            </label>

            <button class="btn btn-primary input-group-btn"><?php Translator::translate("login.login"); ?></button>
        </div>

        <div class="horizontal-divider"></div>
        <div class="form-group">
            <p><?php Translator::translate("login.no_account"); ?></p>
            <a class="input-sm" href="/register"><?php Translator::translate("login.register"); ?></a>
        </div>

    </div>

    </form>

    <?php

}

else {

    ?>
    <h3><?php Translator::translate("login.login"); ?></h3>
    <form name="login" method="post" action="/login">
    <div class="form-group">
        <div class="login-form">
            <input class="form-input" type="email" id="email" name="mail" placeholder="<?php Translator::translate("login.email"); ?>">
            <input class="form-input" type="password" id="Password" name="password" placeholder="<?php Translator::translate("login.password"); ?>">
            <label class="form-checkbox">
                <input type="checkbox" id="remember_me" name="remember_me">
                <i class="form-icon"></i> <?php Translator::translate("login.remember_me"); ?>
            </label>
            <button class="btn btn-primary input-group-btn"><?php Translator::translate("login.login"); ?></button>
        </div>
        <div class="horizontal-divider"></div>
        <div class="form-group">
            <p><?php Translator::translate("login.no_account"); ?></p>
            <a class="input-sm" href="/register"><?php Translator::translate("login.register"); ?></a>
        </div>
    </div>

    </form>

    <?php
}

Partials::Close();
?>