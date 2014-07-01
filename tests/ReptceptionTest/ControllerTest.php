<?php

namespace ReptceptionTest;

use AspectMock\Test as test;
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
    
    protected function tearDown() {
        test::clean();
    }
    
    public function testIndexActionAlwaysReturnArray() {
        
        $config = array(
            'projects' => array(
                'project 1' => '/path/to/project/1',
                'project 2' => '/path/to/project/2'
            ),
        );
        
        $userModel = test::double(
                'Reptception\ProjectModel', 
                array(
                    'create' => 'project 1 object',
                    'create' => 'project 2 object'
                )
        );
        
        $viewModel = $this->controller->indexAction($config);
        
        $userModel->verifyInvoked('create'); 
        
        $this->assertInternalType('array', $viewModel);
        $this->assertArrayHasKey('projects', $viewModel);
        $this->assertCount(2, $viewModel['projects']);
    }
    
}

