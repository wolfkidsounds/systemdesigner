<link rel="stylesheet" href="includes/assets/css/login.css">
<?php //login.php

session_start();
require_once ABSPATH . "/app/functions.php";
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
    $remember = $_POST['remember'];

    if (empty($mail) || empty($password)) {
        ?> 
        <div class="toast error">
            <p>The Fields can not be empty.</p>
        </div>
        <?php
    }

    if (Functions::checkUser($mail)) {
        Functions::loginUser($mail, $password);
    }

    ?>
    <h3>Login</h3>
    <form name="login" method="post">
    <div class="form-group">
        <div class="login-form">
            <input class="form-input" type="email" id="email" name="mail" value="<?php out($email) ?>" placeholder="E-Mail">
            <input class="form-input" type="password" id="Password" name="password" placeholder="Password">

            <label class="form-checkbox">
                <input type="checkbox" name="remember" value="<?php out($remember) ?>">
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

} else {

    ?>
    <h3>Login</h3>
    <form name="login" method="post">
    <div class="form-group">
        <div class="login-form">
            <input class="form-input" type="email" id="email" name="mail" placeholder="E-Mail">
            <input class="form-input" type="password" id="Password" name="password" placeholder="Password">
            <label class="form-checkbox">
                <input type="checkbox" name="remember">
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