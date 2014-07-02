<?php

namespace ReptceptionTest;

use AspectMock\Test as test;
use Reptception\Service\ProjectFetcher;

class ProjectFetcherTest extends \PHPUnit_Framework_TestCase {
    
    /**
     *
     * @var ProjectFetcher
     */
    private $fetcher;
    
    public function setUp() {
        
        $this->fetcher = new ProjectFetcher();
    }
    
    protected function tearDown() {
        test::clean();
    }
    
    public function testFetchInfo() {
        
        $projectMock = $this->getMock('Reptception\PopulateInfoCapableInterface');
        
        $path = '/path/to/report.html';
        $lastRunDate = 123456789;
        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<testsuites>
  <testsuite name="selenium" tests="2" assertions="24" failures="0" errors="0" time="54.323357">
    <testcase name="AddAdvertisment" file="/storage/proj/besplatka/web/tests/selenium/AddAdvertismentCept.php" feature="Adding advertisment" assertions="12" time="27.655971"/>
    <testcase name="AddOtherAdvertisment" file="/storage/proj/besplatka/web/tests/selenium/AddOtherAdvertismentCept.php" feature="Adding other advertisment" assertions="12" time="26.667386"/>
  </testsuite>
  <testsuite name="acceptance" tests="1" assertions="7" failures="0" errors="0" time="1.173301">
    <testcase name="HomePage" file="/storage/proj/besplatka/web/tests/acceptance/HomePageCept.php" feature="Main page without errors" assertions="7" time="1.173301"/>
  </testsuite>
</testsuites>
XML;
        
        $fs = test::double(
            'Reptception\FilesystemFacade', 
            [
                'getFileChangeTime' => $lastRunDate,
                'getFileContent' => $xml,
            ]
        );
        
        $projectMock->expects($this->once())
                ->method('populateInfo');
        
        $this->fetcher->fetchInfo($projectMock, $path);
        
        $fs->verifyInvoked('getFileChangeTime', [$path]); 
        $fs->verifyInvoked('getFileContent', [$path]); 
    }
    
}

