<?php

/**
 * @link http://github.com/maxgu/reptception for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package reptception
 */

namespace Reptception;

class Controller {
    
    public function indexAction(array $config) {
        
        $projects = array();
        
        foreach ($config['projects'] as $projectName => $progectPath) {
            $projects[] = ProjectModel::create(array(
                'name' => $projectName,
                'path' => $progectPath
            ));
        }
        
        return compact('projects');
    }
    
}
