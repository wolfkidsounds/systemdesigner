<link rel="stylesheet" href="includes/assets/css/login.css">
<link rel="stylesheet" href="includes/assets/css/register.css">
<?php //register.php

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

    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    if (empty($name) || empty($mail) || empty($password)) {
        ?> 
        <div class="toast error">
            <p>The Fields can not be empty.</p>
        </div>
        <?php
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        ?> 
        <div class="toast error">
            <p>Please type a valid email address.</p>
        </div>
        <?php
    }

    if (preg_match('/^[a-zA-Z0-9 _-]+$/', $name)) {
        ?> 
        <div class="toast error">
            <p>Please type a valid name.</p>
        </div>
        <?php
    }

    if (preg_match('/^[a-zA-Z0-9_-]+$/', $password)) {
        ?> 
        <div class="toast error">
            <p>Please type a valid password.</p>
        </div>
        <?php
    }

    if (Functions::checkUser($mail)) {
        ?> 
        <div class="toast error">
            <p>The email was already registered.</p>
        </div>
        <?php
    }

    $registration = Functions::registerUser($name, $mail, $password);

    if ($registration) {
        header("Location: /login");
        exit();

    } else {
        ?> 
        <div class="toast error">
            <p>Something went wrong during registration.</p>
        </div>

        <h3>Register</h3>
        <form name="Register" method="post">
        <div class="form-group">
            <div class="register-form">
                <input class="form-input" type="name" id="name" name="name" value="<?php out($name) ?>" placeholder="Name">
                <input class="form-input" type="email" id="email" name="mail" value="<?php out($email) ?>" placeholder="E-Mail">
                <input class="form-input" type="password" id="password" name="password" placeholder="Password">
                <button class="btn btn-primary input-group-btn">Register</button>
            </div>
        </div>
        </form>

        <?php
        exit();
    }

} else {

    ?>

    <h3>Register</h3>
    <form name="Register" method="post">
    <div class="form-group">
        <div class="register-form">
        <input class="form-input" type="name" id="name" name="name" placeholder="Name">
                <input class="form-input" type="email" id="email" name="mail" placeholder="E-Mail">
                <input class="form-input" type="password" id="password" name="password" placeholder="Password">
            <button class="btn btn-primary input-group-btn">Register</button>
        </div>
    </div>
    </form>

    <?php
}

Partials::Close();

?>