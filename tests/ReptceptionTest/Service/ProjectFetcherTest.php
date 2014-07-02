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
        
        $fs = test::double(
            'Reptception\FilesystemFacade', 
            [
                'getFileChangeTime' => $lastRunDate,
                'getFileContent' => '<div class="layout"><h1>Codeception Results <small><span style="color: green">OK</span> (10.3s)</small></h1></div>',
            ]
        );
        
        $projectMock->expects($this->once())
                ->method('populateInfo')
                ->with($lastRunDate);
        
        $this->fetcher->fetchInfo($projectMock, $path);
        
        $fs->verifyInvoked('getFileChangeTime', [$path]); 
        $fs->verifyInvoked('getFileContent', [$path]); 
    }
    
}

