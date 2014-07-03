<?php

namespace ReptceptionTest;

use Reptception\ProjectModel;

class ProjectModelTest extends \PHPUnit_Framework_TestCase {
    
    public function testCreate() {
        
        $projectConfig = array(
            'name' => 'project 1',
            'storagePath' => '/storage/proj/project1/web/tests/_output',
            'webPath' => 'http://proj1.loc/tests/_output',
            'xmlReportFileName' => 'report.xml',
            'htmlReportFileName' => 'report.html',
        );
        
        $project = ProjectModel::create($projectConfig);
        
        $this->assertInstanceOf('Reptception\ProjectModel', $project);
        $this->assertAttributeEquals($projectConfig['name'], 'name', $project);
        $this->assertEquals($projectConfig['name'], $project->getName());
        
        $this->assertAttributeEquals($projectConfig['storagePath'], 'storagePath', $project);
        $this->assertEquals($projectConfig['storagePath'], $project->getStoragePath());
        
        $this->assertAttributeEquals($projectConfig['webPath'], 'webPath', $project);
        $this->assertEquals($projectConfig['webPath'], $project->getWebPath());
        
        $this->assertAttributeEquals($projectConfig['xmlReportFileName'], 'xmlReportFileName', $project);
        $this->assertEquals(
                $projectConfig['storagePath'] . DIRECTORY_SEPARATOR . $projectConfig['xmlReportFileName'], 
                $project->getXmlReportFilePath());
        
        $this->assertAttributeEquals($projectConfig['htmlReportFileName'], 'htmlReportFileName', $project);
        $this->assertEquals(
                $projectConfig['webPath'] . DIRECTORY_SEPARATOR . $projectConfig['htmlReportFileName'], 
                $project->getHtmlReportFilePath());
    }
    
    public function testGetPathWillBeNormalize() {
        
        $project1 = ProjectModel::create(array(
            'name' => 'project 1',
            'storagePath' => '/path/to/project'
        ));
        $project2 = ProjectModel::create(array(
            'name' => 'project 1',
            'storagePath' => '/path/to/project/'
        ));
        
        $this->assertEquals('/path/to/project', $project1->getStoragePath());
        $this->assertEquals('/path/to/project', $project2->getStoragePath());
    }
    
    public function testPopulateInfo() {
        
        $project = ProjectModel::create(array(
            'name' => 'project 1',
            'storagePath' => '/path/to/project'
        ));
        
        $lastRunDate = 123456789;
        $executionTime = 8.2;
        $acceptanceTestsCount = 21;
        $seleniumTestsCount = 16;
        $acceptanceTestsFailures = 2;
        $seleniumTestsFailures = 1;
        
        $project->populateInfo(
                $lastRunDate, 
                $executionTime, 
                $acceptanceTestsCount, 
                $seleniumTestsCount,
                $acceptanceTestsFailures,
                $seleniumTestsFailures);
        
        $this->assertAttributeEquals($lastRunDate, 'lastRunDate', $project);
        $this->assertEquals(date('Y-m-d H:i:s', $lastRunDate), $project->getLastRunDateFormat());
        
        $this->assertAttributeEquals($executionTime, 'executionTime', $project);
        $this->assertEquals($executionTime, $project->getExecutionTime());
        
        $this->assertAttributeEquals($acceptanceTestsCount, 'acceptanceTestsCount', $project);
        $this->assertEquals($acceptanceTestsCount, $project->getAcceptanceTestsCount());
        
        $this->assertAttributeEquals($seleniumTestsCount, 'seleniumTestsCount', $project);
        $this->assertEquals($seleniumTestsCount, $project->getSeleniumTestsCount());
        
        $this->assertAttributeEquals($acceptanceTestsFailures, 'acceptanceTestsFailures', $project);
        $this->assertEquals($acceptanceTestsFailures, $project->getAcceptanceTestsFailures());
        
        $this->assertAttributeEquals($seleniumTestsFailures, 'seleniumTestsFailures', $project);
        $this->assertEquals($seleniumTestsFailures, $project->getSeleniumTestsFailures());
    }
    
}

