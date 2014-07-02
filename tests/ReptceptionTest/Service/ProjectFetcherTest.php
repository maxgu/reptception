<?php

namespace ReptceptionTest;

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
    
    public function testFetchInfo() {
        
        $projectMock = $this->getMock('Reptception\PathAwareInterface');
        
        $this->fetcher->fetchInfo($projectMock);
        
        $this->assertTrue(true);
    }
    
}

