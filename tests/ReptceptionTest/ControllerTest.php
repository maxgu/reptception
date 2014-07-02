<?php

namespace ReptceptionTest;

use Reptception\Controller;

class ControllerTest extends \PHPUnit_Framework_TestCase {
    
    /**
     *
     * @var Controller
     */
    private $controller;
    
    public function setUp() {
        
        $this->controller = new Controller();
    }
    
    public function testIndexActionAlwaysReturnArray() {
        
        $config = array(
            'projects' => array(
                'project 1' => '/path/to/project/1',
                'project 2' => '/path/to/project/2'
            ),
        );
        
        $projectValidatorMock = $this->getMockBuilder('Reptception\Validator\Project')
                ->disableOriginalConstructor()
                ->getMock();
        
        $projectValidatorMock->expects($this->exactly(2))
                ->method('isValid')
                ->will($this->returnValue(true));
        
        $viewModel = $this->controller->indexAction($config, $projectValidatorMock);
        
        $this->assertInternalType('array', $viewModel);
        $this->assertArrayHasKey('projects', $viewModel);
        $this->assertCount(2, $viewModel['projects']);
    }
    
}

