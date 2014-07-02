<?php

/**
 * @link http://github.com/maxgu/reptception for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package reptception
 */

namespace Reptception;


interface PopulateInfoCapableInterface {
    
    public function populateInfo(
            $lastRunDate, 
            $executionTime, 
            $acceptanceTestsCount, 
            $seleniumTestsCount);
    
}
