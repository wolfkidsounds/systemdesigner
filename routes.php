<?php // routes.php

require_once __DIR__ . '/app_config.php';
require_once ABSPATH . 'includes/inc_loader.php';

if ($loader == false) {
  exit;
}

require_once __DIR__ . '/router.php';
require_once ABSPATH . 'app/modules/modules.php';
require_once ABSPATH . 'app/functions/functions.php';
Modules::Translator();

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
get('/app/new/amplifier', function () { Modules::Views()->App_New_Amplifier(); });
post('/app/new/amplifier', function () { Modules::Views()->App_New_Amplifier(); });
get('/app/edit/amplifier/$amplifier_id', function ($amplifier_id) { Modules::Views()->App_Edit_Amplifier($amplifier_id); });
post('/app/edit/amplifier/$amplifier_id', function ($amplifier_id) { Modules::Views()->App_Edit_Amplifier($amplifier_id); });

get('/app/processors', function () { Modules::Views()->App_Processors(); });
get('/app/new/processor', function () { Modules::Views()->App_New_Processor(); });
post('/app/new/processor', function () { Modules::Views()->App_New_Processor(); });
get('/app/edit/processor/$processor_id', function ($processor_id) { Modules::Views()->App_Edit_Processor($processor_id); });
post('/app/edit/processor/$processor_id', function ($processor_id) { Modules::Views()->App_Edit_Processor($processor_id); });

get('/app/speakers', function () { Modules::Views()->App_Speakers(); });
get('/app/new/speaker', function () { Modules::Views()->App_New_Speaker(); });
post('/app/new/speaker', function () { Modules::Views()->App_New_Speaker(); });
get('/app/edit/speaker/$speaker_id', function ($speaker_id) { Modules::Views()->App_Edit_Speaker($speaker_id); });
post('/app/edit/speaker/$speaker_id', function ($speaker_id) { Modules::Views()->App_Edit_Speaker($speaker_id); });

get('/app/setups', function () { Modules::Views()->App_Setups(); });
get('/app/new/setup', function () { Modules::Views()->App_New_Setup(); });
post('/app/new/setup', function () { Modules::Views()->App_New_Setup(); });
get('/app/edit/setup/$setup_id', function ($setup_id) { Modules::Views()->App_Edit_Setup($setup_id); });
post('/app/edit/setup/$setup_id', function ($setup_id) { Modules::Views()->App_Edit_Setup($setup_id); });


get('/app/configurations', function () { Modules::Views()->App_Configuration(); });
get('/app/management', function () { Modules::Views()->App_Management(); });

get('/app/brands', function () { Modules::Views()->App_Brands(); });
get('/app/new/brand', function () { Modules::Views()->App_New_Brand(); });
post('/app/new/brand', function () { Modules::Views()->App_New_Brand(); });
get('/app/edit/brand/$brand_id', function ($brand_id) { Modules::Views()->App_Edit_Brand($brand_id); });
post('/app/edit/brand/$brand_id', function ($brand_id) { Modules::Views()->App_Edit_Brand($brand_id); });

get('/user/account', function () { Modules::Views()->User_Account(); });

any('/404', 'app/views/404.php');