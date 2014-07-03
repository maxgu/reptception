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
    private $storagePath;
    private $webPath;
    private $webceptionUrl;
    private $path;
    private $xmlReportFileName;
    private $htmlReportFileName;
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
    private function __construct($name, $storagePath, $webPath, 
            $webceptionUrl, $xmlReportFileName, $htmlReportFileName) {
        $this->name = $name;
        $this->storagePath = $storagePath;
        $this->webPath = $webPath;
        $this->webceptionUrl = $webceptionUrl;
        $this->xmlReportFileName = $xmlReportFileName;
        $this->htmlReportFileName = $htmlReportFileName;
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
            'storagePath' => null,
            'webPath' => null,
            'webceptionUrl' => null,
            'xmlReportFileName' => null,
            'htmlReportFileName' => null,
        ];
        
        $data = array_merge($defaults, $data);
        
        return new self($data['name'], 
                $data['storagePath'], 
                $data['webPath'], 
                $data['webceptionUrl'], 
                $data['xmlReportFileName'], 
                $data['htmlReportFileName']);
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getStoragePath() {
        return $this->normalize($this->storagePath);
    }
    
    public function getWebPath() {
        return $this->normalize($this->webPath);
    }
    
    public function getWebceptionUrl() {
        return $this->webceptionUrl;
    }
    
    private function normalize($path) {
        return rtrim($path, '/');
    }
    
    public function getXmlReportFilePath() {
        return $this->getStoragePath()
                . DIRECTORY_SEPARATOR
                . $this->xmlReportFileName;
    }
    
    public function getHtmlReportFilePath() {
        return $this->getWebPath()
                . DIRECTORY_SEPARATOR
                . $this->htmlReportFileName;
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
