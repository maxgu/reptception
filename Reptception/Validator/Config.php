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
use Reptception\FilesystemFacade as Filesystem;

class Config {
    
    private $config;
    
    public function isValid($path) {
        
        if (!Filesystem::fileExists($path)) {
            throw new RuntimeException("File {$path} does not exists");
        }
        
        $this->config = Filesystem::includeFile($path);
        
        $pathToLocalConfig = str_replace('config.php', 'config.local.php', $path);
        
        if (Filesystem::fileExists($pathToLocalConfig)) {
            $localConfig = Filesystem::includeFile($pathToLocalConfig);
            $this->config = array_merge($this->config, $localConfig);
        }
        
        if (!isset($this->config['projects'])) {
            throw new RuntimeException("Config must contain 'projects' key");
        }
        
        return true;
    }
    
    public function getConfig() {
        return $this->config;
    }
    
}
