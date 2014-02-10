<?php
/******************************************************************
*
##  Project:CEPHP,A concise and easy framework for PHP
##  Copyright: 2010 All rights reserved
##  version: 1.0.8
##  Author: eastdoor <cephp@sina.com>
*
##  File: Init.php (Cemvc_App_Init)
*
******************************************************************/
if(defined('DebugMode') && GlobalSession)
session_start();
if(defined('DebugMode'))
error_reporting(DebugMode);
//Cephp框架路径
define('CEPath', str_replace("Cemvc","",dirname(dirname(__FILE__))));
//网站路径
define('SitePath', dirname($_SERVER['SCRIPT_FILENAME']));
define('web_root', dirname($_SERVER['SCRIPT_FILENAME']));
define('CssPath', DIRECTORY_SEPARATOR . 'Public' . DIRECTORY_SEPARATOR . 'Css' . DIRECTORY_SEPARATOR);
define('PicPath', DIRECTORY_SEPARATOR . 'Public' . DIRECTORY_SEPARATOR . 'Img' . DIRECTORY_SEPARATOR);
//以下实现自动加载
spl_autoload_register(array('CE', 'LoadClass'));
class CE
{
	static function LoadClass($className='')
	{
            $ConvertString = preg_replace("/([^_]{1})_/", "\$1/", $className,3);
            $route_site_path = SitePath . DIRECTORY_SEPARATOR . $ConvertString . '.php';
            $route_root_path = CEPath . $ConvertString . '.php';
            if (file_exists($route_root_path)) {
                require $route_root_path;
            } elseif (file_exists($route_site_path)) {
                require $route_site_path;
            }
	}
}
?>
