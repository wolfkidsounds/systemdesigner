<?php // login.php

require_once __DIR__ . "/partials/inc_partials.php";

if ($user->loggedIn()) {
    header("Location: /app/dashboard");
}

Partials::Open();
Partials::Header(false, false);
Partials::Footer();
Partials::Close();