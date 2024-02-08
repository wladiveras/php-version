<?php

namespace Config;

define('SITE_NAME', 'Fogão');

define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', '');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'secret');
define('DB_NAME', 'fogao_v1');

function wladi()
{
    return 'test';
}
