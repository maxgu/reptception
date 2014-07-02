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
    
    private $config;
    
    public function __construct($config) {
        $this->config = $config;
    }
    
    public function isValid(PathAwareInterface $project) {
        
        $pathToHtmlReport = $project->getPath() 
                . DIRECTORY_SEPARATOR
                . $this->config['html-report-file-name'];
        
        if (!Filesystem::fileExists($pathToHtmlReport)) {
            throw new RuntimeException("File {$pathToHtmlReport} does not exists");
        }
        
        return true;
    }
    
}
