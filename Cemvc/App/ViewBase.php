<?php

class Cemvc_App_ViewBase
{
    public static $assign = array();
    
    public static $view_route = '';
    
    public function display()
    {
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
