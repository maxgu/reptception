<?php

/**
 * @link http://github.com/maxgu/reptception for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package reptception
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

include '../vendor/autoload.php';

use Phlyty\App;
use Reptception\ErrorHandler;
use Reptception\PhpView;
use Reptception\Controller;
use Reptception\Validator\Config as ConfigValidator;
use Reptception\Validator\Project as ProjectValidator;
use Reptception\Service\ProjectFetcher as ProjectFetcher;

$app = new App();

$errorHandler = new ErrorHandler();

$app->events()->attach('500', $errorHandler);
$app->events()->attach('501', $errorHandler);

$app->setView(new PhpView());

$app->get('/', function(App $app){
    
    $configValidator = new ConfigValidator();
    
    if (!$configValidator->isValid('../Reptception/config.php')) {
        return;
    }
    
    $controller = new Controller();
    $viewModel = $controller->indexAction(
            $configValidator->getConfig(), 
            new ProjectValidator($configValidator->getConfig()),
            new ProjectFetcher()
    );
    
    $app->render('index', $viewModel);
});

$app->run();