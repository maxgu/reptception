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
    private $acceptanceTestsCount;
    private $seleniumTestsCount;
    private $acceptanceTestsFailures;
    private $seleniumTestsFailures;
    
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
    
    public function getAcceptanceTestsCount() {
        return $this->acceptanceTestsCount;
    }
    
    public function getSeleniumTestsCount() {
        return $this->seleniumTestsCount;
    }
    
    public function getAcceptanceTestsFailures() {
        return $this->acceptanceTestsFailures;
    }
    
    public function getSeleniumTestsFailures() {
        return $this->seleniumTestsFailures;
    }
    
    public function getFailurePercent() {
        $totalTests = $this->seleniumTestsCount + $this->acceptanceTestsCount;
        $totalFailures = $this->seleniumTestsFailures + $this->acceptanceTestsFailures;
        return round(($totalFailures * 100) / $totalTests);
    }
    
    public function getSuccesPercent() {
        return 100 - $this->getFailurePercent();
    }
    
    public function isSuccess() {
        return ($this->getAcceptanceTestsFailures() == 0 && $this->getSeleniumTestsFailures() == 0);
    }
    
    private function normalize($path) {
        return rtrim($path, '/');
    }
    
    public function populateInfo(
            $lastRunDate, 
            $executionTime, 
            $acceptanceTestsCount, 
            $seleniumTestsCount,
            $acceptanceTestsFailures,
            $seleniumTestsFailures) {
        $this->lastRunDate = $lastRunDate;
        $this->executionTime = $executionTime;
        $this->acceptanceTestsCount = $acceptanceTestsCount;
        $this->seleniumTestsCount = $seleniumTestsCount;
        $this->acceptanceTestsFailures = $acceptanceTestsFailures;
        $this->seleniumTestsFailures = $seleniumTestsFailures;
    }
    
}
