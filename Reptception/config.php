<?php

/**
 * @link http://github.com/maxgu/reptception for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package reptception
 */

return array(
    'projects' => array(
        array(
            'name' => 'project 1',
            
            'storagePath' => '/storage/proj/project1/web/tests/_output/',
            
            // leave empty if not exists
            'webPath' => 'http://proj1.loc/tests/_output/',  
            
            // leave empty if not exists
            'webceptionUrl' => 'http://webception.loc/',
            
            'xmlReportFileName' => 'report.xml',
            
            // leave empty if not exists
            'htmlReportFileName' => 'report.html',
        ),
        array(
            'name' => 'project 2',
            
            'storagePath' => '/storage/proj/project2/web/tests/_output/',
            
            // leave empty if not exists
            'webPath' => 'http://proj2.loc/tests/_output/',
            
            'xmlReportFileName' => 'report.xml',
            
            // leave empty if not exists
            'htmlReportFileName' => 'report.html',
        ),
    ),
);
