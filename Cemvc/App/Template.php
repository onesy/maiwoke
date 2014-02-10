<?php

class Cemvc_App_Template extends Cemvc_App_ViewBase
{
    public function assign($key, $value)
    {
        parent::$assign[$key] = $value;
    }
    
    public function display($route = '')
    {
        parent::$view_route = $route;
        parent::display();
    }
}
