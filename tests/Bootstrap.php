<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

include '../vendor/autoload.php';

$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'debug' => true,
    'includePaths' => [__DIR__.'/../Reptception']
]);