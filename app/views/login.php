<link rel="stylesheet" href="includes/assets/css/login.css">
<?php //login.php

require_once ABSPATH . "/app/functions.php";
Functions::checkRememberMe();

if (Functions::checkLogin()) {
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

    if (Functions::checkUser($mail)) {
        Functions::loginUser($mail, $password, $remember_me);
    }

    ?>
    <h3>Login</h3>
    <form name="login" method="post" action="/login">
    <div class="form-group">
        <div class="login-form">
            <input class="form-input" type="email" id="email" name="mail" value="<?php out($email) ?>" placeholder="E-Mail">
            <input class="form-input" type="password" id="Password" name="password" placeholder="Password">

            <label class="form-checkbox">
            <input type="checkbox" id="remember_me" name="remember_me" value="<?php out($remember) ?>">
                <i class="form-icon"></i> Remember Me
            </label>

            <button class="btn btn-primary input-group-btn">Login</button>
        </div>

        <div class="horizontal-divider"></div>
        <div class="form-group">
            <p>Don't have an account?</p>
            <a class="input-sm" href="/register">Register</a>
        </div>

    </div>

    </form>

    <?php

}

else {

    ?>
    <h3>Login</h3>
    <form name="login" method="post" action="/login">
    <div class="form-group">
        <div class="login-form">
            <input class="form-input" type="email" id="email" name="mail" placeholder="E-Mail">
            <input class="form-input" type="password" id="Password" name="password" placeholder="Password">
            <label class="form-checkbox">
                <input type="checkbox" id="remember_me" name="remember_me">
                <i class="form-icon"></i> Remember Me
            </label>
            <button class="btn btn-primary input-group-btn">Login</button>
        </div>
        <div class="horizontal-divider"></div>
        <div class="form-group">
            <p>Don't have an account yet?</p>
            <a class="input-sm" href="/register">Register</a>
        </div>
    </div>

    </form>

    <?php
}

Partials::Close();
?>