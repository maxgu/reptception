<?php

namespace ReptceptionTest;

use AspectMock\Test as test;
use Reptception\Validator\Project as ProjectValidator;
use Reptception\ProjectModel as Project;

class ProjectTest extends \PHPUnit_Framework_TestCase {
    
    /**
     *
     * @var ProjectValidator 
     */
    private $validator;
    
    protected function setUp() {
        $this->validator = new ProjectValidator(
            [
                'html-report-file-name' => 'report.html'
            ]);
    }

    protected function tearDown() {
        test::clean();
    }

    public function testIsValidThrowsExceptionIfConfigDoesNotExists() {
        
        return $this->markTestIncomplete();
        
        $this->setExpectedException('RuntimeException');
        
        $project = test::double('Reptception\ProjectModel', ['getPath' => '/path/to/project']);
        
        $this->validator->isValid($project);
        
    }
    
    
}
