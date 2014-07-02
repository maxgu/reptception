<?php

/**
 * @link http://github.com/maxgu/reptception for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package reptception
 */

namespace Reptception;

use RuntimeException;
use Reptception\Validator\Project as ProjectValidator;

class Controller {
    
    public function indexAction(array $config, ProjectValidator $validator) {
        
        $projects = array();
        
        foreach ($config['projects'] as $projectName => $projectPath) {
            $project = ProjectModel::create(array(
                'name' => $projectName,
                'path' => $projectPath,
                'reportFileName' => $config['html-report-file-name']
            ));
            
            if (!$validator->isValid($project)) {
                return;
            }
            
            $projects[] = $project;
        }
        
        return compact('projects');
    }
    
}
