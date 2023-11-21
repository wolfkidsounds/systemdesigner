<?php

umask(0002);

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {

    if ($context['APP_MAINTENANCE'] === true) {
        require_once 'maintenance.html';
    }

    else {
        return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
    }
};