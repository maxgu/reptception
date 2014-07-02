<?php

/**
 * @link http://github.com/maxgu/reptception for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package reptception
 */

namespace Reptception;

use Reptception\Validator\Project as ProjectValidator;
use Reptception\Service\ProjectFetcher;

class Controller {
    
    public function indexAction(
            array $config, 
            ProjectValidator $validator, 
            ProjectFetcher $projectFetcher) {
        
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
            
            $projectFetcher->fetchInfo($project, $project->getReportFilePath());
            
            $projects[] = $project;
        }
        
        return compact('projects');
    }
    
}
