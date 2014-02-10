<?php
/******************************************************************
*
##  Project:CEPHP,A concise and easy framework for PHP
##  Copyright: 2010 All rights reserved
##  version: 1.0.8
##  Author: eastdoor <cephp@sina.com>
*
##  File: Base.php (Cemvc_Control_Base)
*
******************************************************************/
class Cemvc_Control_Base
{
    
    public static $view;
    
    public static $controller = '';
    
    public static $action = '';
    
    public static $ErrorInfo;
    
    public function __construct()
    {
        self::$view = Cemvc_App_Template::instance();
        self::$controller = Cemvc_Control_Divide::$controller_name;
        self::$action = Cemvc_Control_Divide::$action_name;
        //------------------------sunyuw---------------------//
    }
    
    public function assgin($key, $value)
    {
        self::$view->assign($key, $value);
    }
    
    //重写DISPLAY函数
    public function display($tpl = '')
    {
        if ($tpl !== '') {
            self::$view->display($tpl);
        } else {
            self::$view->display(self::$controller . DIRECTORY_SEPARATOR . self::$action . '.tpl.php');
        }
    }
    
}
