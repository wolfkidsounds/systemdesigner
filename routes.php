<?php // routes.php

require_once __DIR__ . '/app_config.php';
require_once ABSPATH . 'includes/inc_loader.php';

if ($loader == false) {
  exit;
}

require_once __DIR__ . '/router.php';
require_once ABSPATH . 'app/modules/modules.php';

require_once ABSPATH . 'app/functions.php';

Functions::startSession();

// DEFINE ROUTES
get('/', function () { Modules::Views()->Index(); });

get('/login', function () { Modules::Views()->Login(); });
post('/login', function () { Modules::Views()->Login(); });
get('/logout', function () { Modules::Views()->Logout(); });
get('/register', function () { Modules::Views()->Register(); });
post('/register', function () { Modules::Views()->Register(); });

get('/app', function () { Modules::Views()->App_Dashboard(); });
get('/dashboard', function () { Modules::Views()->App_Dashboard(); });
get('/app/dashboard', function () { Modules::Views()->App_Dashboard(); });

get('/app/amplifiers', function () { Modules::Views()->App_Amplifiers(); });
get('/app/speakers', function () { Modules::Views()->App_Speakers(); });
get('/app/processors', function () { Modules::Views()->App_Processors(); });

get('/app/setups', function () { Modules::Views()->App_Setup(); });
get('/app/configurations', function () { Modules::Views()->App_Configuration(); });
get('/app/management', function () { Modules::Views()->App_Management(); });

get('/app/brands', function () { Modules::Views()->App_Brands(); });

get('/user/account', function () { Modules::Views()->User_Account(); });

any('/404', 'app/views/404.php');