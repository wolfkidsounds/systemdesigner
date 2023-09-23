<?php // routes.php
use marcocesarato\security\Security;

require_once __DIR__ . '/app_config.php';
require_once ABSPATH . 'vendor\autoload.php';

$isAPI = false; // default is FALSE (this remove some check that could block API request)
$security = new Security($isAPI);

require_once ABSPATH . 'includes/inc_loader.php';

if ($loader == false) {
  exit;
}

require_once __DIR__ . '/router.php';
require_once ABSPATH . 'app/modules/modules.php';
require_once ABSPATH . 'app/functions/functions.php';
Modules::Translator();

// DEFINE ROUTES

// Standard Route
get('/', function () { Modules::Views()->Index(); });

// Login Routes
get('/login', function () { Modules::Views()->Login(); });
post('/login', function () { Modules::Views()->Login(); });
get('/logout', function () { Functions::Users()->logoutUser(); });

//Register Routes
if (Modules::Features()->getUserRegisterFeature()) {
  get('/register', function () { Modules::Views()->Register(); });
  post('/register', function () { Modules::Views()->Register(); });
}

// Dashboard Routes
get('/app', function () { Modules::Views()->App_Dashboard(); });
get('/dashboard', function () { Modules::Views()->App_Dashboard(); });
get('/app/dashboard', function () { Modules::Views()->App_Dashboard(); });
get('/app/version', function () { Modules::Views()->App_Version(); });

// Brands
if (Modules::Features()->getBrandFeature()) {
  get('/app/brands', function () { Modules::Views()->App_Brands(); });
  get('/app/new/brand', function () { Modules::Views()->App_New_Brand(); });
  post('/app/new/brand', function () { Modules::Views()->App_New_Brand(); });
  get('/app/edit/brand/$brand_id', function ($brand_id) { Modules::Views()->App_Edit_Brand($brand_id); });
  post('/app/edit/brand/$brand_id', function ($brand_id) { Modules::Views()->App_Edit_Brand($brand_id); });
  post('/app/del/brand/$brand_id', function ($brand_id) { Functions::Brands()->delete($brand_id); });
}

//Processor Routes
if (Modules::Features()->getProcessorFeature()) {
  get('/app/processors', function () { Modules::Views()->App_Processors(); });
  get('/app/new/processor', function () { Modules::Views()->App_New_Processor(); });
  post('/app/new/processor', function () { Modules::Views()->App_New_Processor(); });
  get('/app/edit/processor/$processor_id', function ($processor_id) { Modules::Views()->App_Edit_Processor($processor_id); });
  post('/app/edit/processor/$processor_id', function ($processor_id) { Modules::Views()->App_Edit_Processor($processor_id); });
  post('/app/del/processor/$processor_id', function ($processor_id) { Functions::Processors()->delete($processor_id); });
}

//Amplifier Routes
if (Modules::Features()->getAmplifierFeature()) {
  get('/app/amplifiers', function () { Modules::Views()->App_Amplifiers(); });
  get('/app/new/amplifier', function () { Modules::Views()->App_New_Amplifier(); });
  post('/app/new/amplifier', function () { Modules::Views()->App_New_Amplifier(); });
  get('/app/edit/amplifier/$amplifier_id', function ($amplifier_id) { Modules::Views()->App_Edit_Amplifier($amplifier_id); });
  post('/app/edit/amplifier/$amplifier_id', function ($amplifier_id) { Modules::Views()->App_Edit_Amplifier($amplifier_id); });
  post('/app/del/amplifier/$amplifier_id', function ($amplifier_id) { Functions::Amplifiers()->delete($amplifier_id); });
}

//Speaker Routes
if (Modules::Features()->getSpeakerFeature()) {
  get('/app/speakers', function () { Modules::Views()->App_Speakers(); });
  get('/app/new/speaker', function () { Modules::Views()->App_New_Speaker(); });
  post('/app/new/speaker', function () { Modules::Views()->App_New_Speaker(); });
  get('/app/edit/speaker/$speaker_id', function ($speaker_id) { Modules::Views()->App_Edit_Speaker($speaker_id); });
  post('/app/edit/speaker/$speaker_id', function ($speaker_id) { Modules::Views()->App_Edit_Speaker($speaker_id); });
  post('/app/del/speaker/$speaker_id', function ($speaker_id) { Functions::Speakers()->delete($speaker_id); });
}

//Limiter Routes
if (Modules::Features()->getLimiterFeature()) {
  get('/app/limiters', function () { Modules::Views()->App_Limiters(); });
  get('/app/new/limiter', function () { Modules::Views()->App_New_Limiter(); });
  post('/app/new/limiter', function () { Modules::Views()->App_New_Limiter(); });
  get('/app/edit/limiter/$limiter_id', function ($limiter_id) { Modules::Views()->App_Edit_Limiter($limiter_id); });
  post('/app/edit/limiter/$limiter_id', function ($limiter_id) { Modules::Views()->App_Edit_Limiter($limiter_id); });
  post('/app/del/limiter/$limiter_id', function ($limiter_id) { Functions::Limiters()->delete($limiter_id); });
}

//Racks Routes
if (Modules::Features()->getRackFeature()) {
  get('/app/racks', function () { Modules::Views()->App_Racks(); });
  get('/app/new/rack', function () { Modules::Views()->App_New_Rack(); });
  post('/app/new/rack', function () { Modules::Views()->App_New_Rack(); });
  get('/app/edit/rack/$rack_id', function ($rack_id) { Modules::Views()->App_Edit_Rack($rack_id); });
  post('/app/edit/rack/$rack_id', function ($rack_id) { Modules::Views()->App_Edit_Rack($rack_id); });
}

// User Routes
if (Modules::Features()->getUserAccountFeature()) {
  get('/user/account', function () { Modules::Views()->User_Account(); });
  post('/user/account/update', function () { Functions::Users()->setSetting(); });
  get('/user/settings', function () { Modules::Views()->User_Settings(); });
}

// API Routes
if (Modules::Features()->getAPIFeature()) {
  post('/api/get/processor', function () { Modules::API()->getProcessor(); });
  post('/api/get/amplifier', function () { Modules::API()->getAmplifier(); });
  post('/api/get/speaker', function () { Modules::API()->getSpeaker(); });
  post('/api/get/limiter/calc', function () { Modules::API()->calcLimiter(); });
}

//Modal Routes
get('/app/modal/open/$type/$action/$rack_id', function ($type, $action, $rack_id) { Modules::Modals()->OpenModal($type, $action, $rack_id); });

// Not Found Routes
any('/404', 'app/views/404.php');