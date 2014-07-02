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
use Zend\Dom\Query;

class ProjectFetcher {
    
    public function fetchInfo(PopulateInfoCapableInterface $project, $reportFilePath) {
        
        $lastRunDate = Filesystem::getFileChangeTime($reportFilePath);
        
        $dom = new Query(Filesystem::getFileContent($reportFilePath));
        $executionTimeRaw = $dom->execute('div.layout h1 small')->current()->nodeValue;
        $executionTimeRaw = explode(' ', $executionTimeRaw);
        $executionTime = trim($executionTimeRaw[1], '()');
        
        $project->populateInfo($lastRunDate, $executionTime);
    }
    
}
