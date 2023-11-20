<?php

umask(0002);

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    if (!$context['APP_MAINTENANCE'] == false || !$context['APP_MAINTENANCE']) {
        require_once 'index.html';
    }

    else {
        return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
    }
};