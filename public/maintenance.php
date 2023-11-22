<?php

umask(0002);

$url = $_SERVER['REQUEST_URI'];

if (!($url === "/")) {
    //echo 'url is not root <br>';
    //var_dump($url);
    header('Location: /');
    exit();

} else {
    //echo 'url is root <br>';
    //var_dump($url);
    require_once 'maintenance.html';

}