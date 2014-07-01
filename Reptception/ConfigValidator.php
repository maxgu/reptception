<?php

/**
 * @link http://github.com/maxgu/reptception for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package reptception
 */

namespace Reptception;

use RuntimeException;

class ConfigValidator {
    
    private $pathToConfig;
    private $config;
    
    public function __construct($path) {
        $this->pathToConfig = $path;
    }
    
    public function isValid() {
        
        if (!self::fileExists($this->pathToConfig)) {
            throw new RuntimeException("File {$this->pathToConfig} does not exists");
        }
        
        $this->config = self::loadConfig($this->pathToConfig);
        
        if (!isset($this->config['projects'])) {
            throw new RuntimeException("Config must contain 'projects' key");
        }
        
        return true;
    }
    
    public function getConfig() {
        return $this->config;
    }
    
    private static function fileExists($path) {
        return file_exists($path);
    }
    
    private static function loadConfig($path) {
        return include $path;
    }
    
}
