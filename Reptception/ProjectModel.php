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

class ProjectModel implements PathAwareInterface, PopulateInfoCapableInterface {
    
    private $name;
    private $path;
    private $reportFileName;
    private $lastRunDate;
    private $executionTime;
    
    /**
     * 
     * @param string $name
     * @param string $path
     */
    private function __construct($name, $path, $reportFileName) {
        $this->name = $name;
        $this->path = $path;
        $this->reportFileName = $reportFileName;
    }
    
    /**
     * 
     * @param array $data
     * @return \self
     * @throws RuntimeException
     */
    public static function create(array $data) {
        
        $defaults = [
            'name' => null,
            'path' => null,
            'reportFileName' => null,
        ];
        
        $data = array_merge($defaults, $data);
        
        return new self($data['name'], $data['path'], $data['reportFileName']);
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getPath() {
        return $this->normalize($this->path);
    }
    
    public function getReportFilePath() {
        return $this->getPath() 
                . DIRECTORY_SEPARATOR
                . $this->reportFileName;
    }
    
    public function getLastRunDateFormat() {
        return date('Y-m-d H:i:s', $this->lastRunDate);
    }
    
    public function getExecutionTime() {
        return $this->executionTime;
    }
    
    private function normalize($path) {
        return rtrim($path, '/');
    }
    
    public function populateInfo($lastRunDate, $executionTime) {
        $this->lastRunDate = $lastRunDate;
        $this->executionTime = $executionTime;
    }
    
}
