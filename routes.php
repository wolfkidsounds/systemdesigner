<?php // routes.php

require_once __DIR__ . '/app_config.php';
require_once ABSPATH . 'includes/inc_loader.php';

if ($loader == false) {
  exit;
}

require_once __DIR__ . '/router.php';
require_once ABSPATH . 'app/modules/modules.php';

// DEFINE ROUTES
get('/', function () { Modules::Views()->Index(); });

get('/login', function () { Modules::Views()->Login(); });
get('/logout', function () { Modules::Views()->Logout(); });

get('/app', function () { Modules::Views()->App_Dashboard(); });
get('/app/dashboard', function () { Modules::Views()->App_Dashboard(); });
get('/app/amplifiers', function () { Modules::Views()->App_Amplifiers(); });
get('/app/speakers', function () { Modules::Views()->App_Speakers(); });
get('/app/dsp', function () { Modules::Views()->App_DSP(); });
get('/app/setups', function () { Modules::Views()->App_Setups(); });
get('/app/configurations', function () { Modules::Views()->App_Configurations(); });
get('/app/management', function () { Modules::Views()->App_Management(); });

get('/user/account', function () { Modules::Views()->User_Account(); });
get('/user/settings', function () { Modules::Views()->User_Settings(); });

any('/404', 'app/views/404.php');