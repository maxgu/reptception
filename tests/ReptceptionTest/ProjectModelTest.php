<?php

namespace ReptceptionTest;

use Reptception\ProjectModel;

class ProjectModelTest extends \PHPUnit_Framework_TestCase {
    
    public function testCreate() {
        
        $name = 'project 1';
        $path = '/path/to/project';
        
        $project = ProjectModel::create(array(
            'name' => $name,
            'path' => $path
        ));
        
        $this->assertInstanceOf('Reptception\ProjectModel', $project);
        $this->assertAttributeEquals($name, 'name', $project);
        $this->assertEquals($name, $project->getName());
        $this->assertAttributeEquals($path, 'path', $project);
        $this->assertEquals($path, $project->getPath());
    }
    
    public function testGetPathWillBeNormalize() {
        
        $project1 = ProjectModel::create(array(
            'name' => 'project 1',
            'path' => '/path/to/project'
        ));
        $project2 = ProjectModel::create(array(
            'name' => 'project 1',
            'path' => '/path/to/project/'
        ));
        
        $this->assertEquals('/path/to/project', $project1->getPath());
        $this->assertEquals('/path/to/project', $project2->getPath());
    }
    
}

