<?php

/**
 * @link http://github.com/maxgu/reptception for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package reptception
 */

namespace Reptception;

use Phlyty\AppEvent;

class ErrorHandler {
    
    public static function __invoke(AppEvent $app) {
        /* @var $exception \Exception */
        $exception = $app->getParam('exception');
        
        $app->getTarget()->response()->setStatusCode(500);
        
        return $app->getTarget()->render('error', compact('exception'));
    }

}
