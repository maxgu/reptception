<?php

namespace ReptceptionTest;

use AspectMock\Test as test;
use Reptception\ConfigValidator;

class ConfigValidatorTest extends \PHPUnit_Framework_TestCase {
    
    protected function tearDown() {
        test::clean();
    }

    public function testIsValidThrowsExceptionIfConfigDoesNotExists() {
        $validator = new ConfigValidator('/path/to/config.php');
        
        $this->setExpectedException('RuntimeException');
        
        $validator->isValid();
        
    }
    
    public function testIsValidThrowsExceptionIfConfigNotContainProjectKey() {
        $validator = new ConfigValidator('/path/to/config.php');
        
        $validatorStatic = test::double(
            'Reptception\ConfigValidator', 
            [
                'fileExists' => true,
                'loadConfig' => []
            ]
        );
        
        $this->setExpectedException('RuntimeException');
        
        $validator->isValid();
        
    }
    
    public function testIsValidReturnTrueWhenAllOk() {
        
        $path = '/path/to/config.php';
        
        $config = ['projects' => []];
        
        $validatorStatic = test::double(
            'Reptception\ConfigValidator', 
            [
                'fileExists' => true,
                'loadConfig' => $config
            ]
        );
        
        $validator = new ConfigValidator($path);
        
        $result = $validator->isValid();
        
        $validatorStatic->verifyInvoked('fileExists', [$path]); 
        $validatorStatic->verifyInvoked('loadConfig', [$path]); 
        $this->assertTrue($result);
        $this->assertAttributeEquals($config, 'config', $validator);
        $this->assertEquals($config, $validator->getConfig());
    }
    
}
