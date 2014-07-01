<?php

namespace ReptceptionTest;

use AspectMock\Test as test;
use Reptception\Validator\Config as ConfigValidator;

class ConfigValidatorTest extends \PHPUnit_Framework_TestCase {
    
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
        
        $validator = test::double(
            'Reptception\Validator\Config', 
            [
                'fileExists' => true,
                'loadConfig' => []
            ]
        );
        
        $this->setExpectedException('RuntimeException');
        
        $this->validator->isValid('/path/to/config.php');
        
    }
    
    public function testIsValidReturnTrueWhenAllOk() {
        
        $path = '/path/to/config.php';
        
        $config = ['projects' => []];
        
        $validator = test::double(
            'Reptception\Validator\Config', 
            [
                'fileExists' => true,
                'loadConfig' => $config
            ]
        );
        
        $result = $this->validator->isValid($path);
        
        $validator->verifyInvoked('fileExists', [$path]); 
        $validator->verifyInvoked('loadConfig', [$path]); 
        $this->assertTrue($result);
        $this->assertAttributeEquals($config, 'config', $this->validator);
        $this->assertEquals($config, $this->validator->getConfig());
    }
    
}
