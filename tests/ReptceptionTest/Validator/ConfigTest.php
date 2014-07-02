<?php

namespace ReptceptionTest;

use AspectMock\Test as test;
use Reptception\Validator\Config as ConfigValidator;

class ConfigTest extends \PHPUnit_Framework_TestCase {
    
    /**
     *
     * @var ConfigValidator 
     */
    private $validator;
    
    protected function setUp() {
        $this->validator = new ConfigValidator();
    }

    protected function tearDown() {
        test::clean();
    }

    public function testIsValidThrowsExceptionIfConfigDoesNotExists() {
        
        $this->setExpectedException('RuntimeException');
        
        $this->validator->isValid('/path/to/config.php');
        
    }
    
    public function testIsValidThrowsExceptionIfConfigNotContainProjectKey() {
        
        $fs = test::double(
            'Reptception\FilesystemFacade', 
            [
                'fileExists' => true,
                'includeFile' => []
            ]
        );
        
        $this->setExpectedException('RuntimeException');
        
        $this->validator->isValid('/path/to/config.php');
        
    }
    
    public function testIsValidReturnTrueWhenAllOk() {
        
        $path = '/path/to/config.php';
        
        $config = ['projects' => []];
        
        $fs = test::double(
            'Reptception\FilesystemFacade', 
            [
                'fileExists' => true,
                'includeFile' => $config
            ]
        );
        
        $result = $this->validator->isValid($path);
        
        $fs->verifyInvoked('fileExists', [$path]); 
        $fs->verifyInvoked('includeFile', [$path]); 
        $this->assertTrue($result);
        $this->assertAttributeEquals($config, 'config', $this->validator);
        $this->assertEquals($config, $this->validator->getConfig());
    }
    
}
