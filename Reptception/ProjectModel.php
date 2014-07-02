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

class ProjectModel implements PathAwareInterface {
    
    private $name;
    private $path;
    
    /**
     * 
     * @param string $name
     * @param string $path
     */
    private function __construct($name, $path) {
        $this->name = $name;
        $this->path = $path;
    }
    
    /**
     * 
     * @param array $data
     * @return \self
     * @throws RuntimeException
     */
    public static function create(array $data) {
        
        if (!isset($data['name'])) {
            throw new RuntimeException("data must contain 'name'");
        }
        
        if (!isset($data['path'])) {
            throw new RuntimeException("data must contain 'path'");
        }
        
        return new self($data['name'], $data['path']);
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getPath() {
        return $this->normalize($this->path);
    }
    
    private function normalize($path) {
        return rtrim($path, '/');
    }
    
}
