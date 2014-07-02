<?php

namespace ReptceptionTest;

use Reptception\ProjectModel;

class ProjectModelTest extends \PHPUnit_Framework_TestCase {
    
    public function testCreate() {
        
        $name = 'project 1';
        $path = '/path/to/project';
        $reportFileName = 'report.html';
        
        $project = ProjectModel::create(array(
            'name' => $name,
            'path' => $path,
            'reportFileName' => $reportFileName
        ));
        
        $this->assertInstanceOf('Reptception\ProjectModel', $project);
        $this->assertAttributeEquals($name, 'name', $project);
        $this->assertEquals($name, $project->getName());
        $this->assertAttributeEquals($path, 'path', $project);
        $this->assertEquals($path, $project->getPath());
        $this->assertAttributeEquals($reportFileName, 'reportFileName', $project);
        $this->assertEquals($path . DIRECTORY_SEPARATOR . $reportFileName, $project->getReportFilePath());
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
    
    public function testPopulateInfo() {
        
        $project = ProjectModel::create(array(
            'name' => 'project 1',
            'path' => '/path/to/project'
        ));
        
        $lastRunDate = 123456789;
        
        $project->populateInfo($lastRunDate);
        
        $this->assertAttributeEquals($lastRunDate, 'lastRunDate', $project);
        $this->assertEquals(date('Y-m-d H:i:s', $lastRunDate), $project->getLastRunDateFormat());
    }
    
}

