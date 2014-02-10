<?php

class Cemvc_App_ViewBase
{
    public static $instance = array();
    
    public static $assign = array();
    
    public static $view_route = '';
    
    
    public static function instance($class_name)
    {
        if (!isset(self::$instance[$class_name])) {
            self::$instance[$class_name] = new $class_name();
        }
        return self::$instance[$class_name];
    }
    
    public function display($route)
    {
        static::$view_route = $route;
        include("View.php");
    }
    
    public function extractIt()
    {
        extract(self::$assign, EXTR_OVERWRITE);
    }
    
    public function renderIt()
    {
        return web_root . DIRECTORY_SEPARATOR . self::$view_route;
    }
}
