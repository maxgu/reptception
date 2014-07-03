<?php

/**
 * @link http://github.com/maxgu/reptception for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package reptception
 */

namespace Reptception\Validator;

use RuntimeException;
use Reptception\PathAwareInterface;
use Reptception\FilesystemFacade as Filesystem;

class Project {
    
    public function isValid(PathAwareInterface $project) {
        
        $pathToXmlReport = $project->getXmlReportFilePath();
        
        if (!Filesystem::isReadable($pathToXmlReport)) {
            throw new RuntimeException("File {$pathToXmlReport} does not exists");
        }
        
        return true;
    }
    
}
