<?php

require_once '../vendor/autoload.php';

require_once '../routes/web.php';

$env = file_get_contents("../.env");
$lines = explode("\n", $env);
