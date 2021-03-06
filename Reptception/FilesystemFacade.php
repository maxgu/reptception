<?php

/**
 * @link http://github.com/maxgu/reptception for the canonical source
 * @copyright Copyright (c) 2012 T4 Ltd. (t4web.com.ua)
 * @author Max Gulturyan
 * @license GNU GPL v2
 * @package reptception
 */

namespace Reptception;

class FilesystemFacade {
    
    public static function fileExists($path) {
        return file_exists($path);
    }
    
    public static function isReadable($path) {
        return is_readable($path);
    }
    
    public static function includeFile($path) {
        return include $path;
    }
    
    public static function getFileChangeTime($path) {
        return filemtime($path);
    }
    
    public static function getFileContent($path) {
        return file_get_contents($path);
    }
}
