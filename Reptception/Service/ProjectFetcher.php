<?php

/**
 * @link http://github.com/maxgu/reptception for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package reptception
 */

namespace Reptception\Service;

use Reptception\PopulateInfoCapableInterface;
use Reptception\FilesystemFacade as Filesystem;
use SimpleXMLElement;

class ProjectFetcher {
    
    public function fetchInfo(PopulateInfoCapableInterface $project, $reportFilePath) {
        
        $lastRunDate = Filesystem::getFileChangeTime($reportFilePath);
        
        $testsuites = new SimpleXMLElement(Filesystem::getFileContent($reportFilePath));
        
        $time = 0.0;
        $acceptanceTestsCount = 0;
        $seleniumTestsCount = 0;
        foreach ($testsuites as $testsuite) {
            if ($testsuite['name'] == 'selenium') {
                $seleniumTestsCount = $testsuite['tests'];
            }
            
            if ($testsuite['name'] == 'acceptance') {
                $acceptanceTestsCount = $testsuite['tests'];
            }
            
            $time += (double)$testsuite['time'];
        }
        
        $executionTime = round($time, 1);
        
        $project->populateInfo(
                $lastRunDate, 
                $executionTime, 
                $acceptanceTestsCount,
                $seleniumTestsCount);
    }
    
}
