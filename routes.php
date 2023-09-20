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

// Standard Route
get('/', function () { Modules::Views()->Index(); });

// Login Routes
get('/login', function () { Modules::Views()->Login(); });
post('/login', function () { Modules::Views()->Login(); });
get('/logout', function () { Modules::Views()->Logout(); });

//Register Routes
get('/register', function () { Modules::Views()->Register(); });
post('/register', function () { Modules::Views()->Register(); });

// Dashboard Routes
get('/app', function () { Modules::Views()->App_Dashboard(); });
get('/dashboard', function () { Modules::Views()->App_Dashboard(); });
get('/app/dashboard', function () { Modules::Views()->App_Dashboard(); });

//Amplifier Routes
get('/app/amplifiers', function () { Modules::Views()->App_Amplifiers(); });
get('/app/new/amplifier', function () { Modules::Views()->App_New_Amplifier(); });
post('/app/new/amplifier', function () { Modules::Views()->App_New_Amplifier(); });
get('/app/edit/amplifier/$amplifier_id', function ($amplifier_id) { Modules::Views()->App_Edit_Amplifier($amplifier_id); });
post('/app/edit/amplifier/$amplifier_id', function ($amplifier_id) { Modules::Views()->App_Edit_Amplifier($amplifier_id); });

//Processor Routes
get('/app/processors', function () { Modules::Views()->App_Processors(); });
get('/app/new/processor', function () { Modules::Views()->App_New_Processor(); });
post('/app/new/processor', function () { Modules::Views()->App_New_Processor(); });
get('/app/edit/processor/$processor_id', function ($processor_id) { Modules::Views()->App_Edit_Processor($processor_id); });
post('/app/edit/processor/$processor_id', function ($processor_id) { Modules::Views()->App_Edit_Processor($processor_id); });

//Speaker Routes
get('/app/speakers', function () { Modules::Views()->App_Speakers(); });
get('/app/new/speaker', function () { Modules::Views()->App_New_Speaker(); });
post('/app/new/speaker', function () { Modules::Views()->App_New_Speaker(); });
get('/app/edit/speaker/$speaker_id', function ($speaker_id) { Modules::Views()->App_Edit_Speaker($speaker_id); });
post('/app/edit/speaker/$speaker_id', function ($speaker_id) { Modules::Views()->App_Edit_Speaker($speaker_id); });

//Setup Routes
get('/app/setups', function () { Modules::Views()->App_Setups(); });
get('/app/new/setup', function () { Modules::Views()->App_New_Setup(); });
post('/app/new/setup', function () { Modules::Views()->App_New_Setup(); });
get('/app/edit/setup/$setup_id', function ($setup_id) { Modules::Views()->App_Edit_Setup($setup_id); });
post('/app/edit/setup/$setup_id', function ($setup_id) { Modules::Views()->App_Edit_Setup($setup_id); });

//Brand Routes
get('/app/brands', function () { Modules::Views()->App_Brands(); });
get('/app/new/brand', function () { Modules::Views()->App_New_Brand(); });
post('/app/new/brand', function () { Modules::Views()->App_New_Brand(); });
get('/app/edit/brand/$brand_id', function ($brand_id) { Modules::Views()->App_Edit_Brand($brand_id); });
post('/app/edit/brand/$brand_id', function ($brand_id) { Modules::Views()->App_Edit_Brand($brand_id); });

//Modal Routes
get('/app/modal/open/$type/$action/$rack_id', function ($type, $action, $rack_id) { Modules::Modals()->OpenModal($type, $action, $rack_id); });

// User Routes
get('/user/account', function () { Modules::Views()->User_Account(); });
post('/user/account/update', function () { Functions::Users()->setSetting(); });

any('/404', 'app/views/404.php');