<?php

class Cemvc_App_Template extends Cemvc_App_ViewBase
{
    public static function instance() {
        return parent::instance(__CLASS__);
    }
    
    public function assign($key, $value)
    {
        parent::$assign[$key] = $value;
    }
    
    public function display($route = '')
    {
        parent::display($route);
    }
}
