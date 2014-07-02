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
        
        $lastRunDate = 123456789;
        
        $fs = test::double(
            'Reptception\FilesystemFacade', 
            [
                'getFileChangeTime' => $lastRunDate,
            ]
        );
        
        $projectMock->expects($this->once())
                ->method('populateInfo')
                ->with($lastRunDate);
        
        $this->fetcher->fetchInfo($projectMock, '/path/to/report.html');
        
    }
    
}

