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
//以下实现自动加载
spl_autoload_register(array('CE', 'LoadClass'));
class CE
{
	static function LoadClass($className='')
	{
		$ConvertString = preg_replace("/([^_]{1})_/", "\$1/", $className,2);
		if (substr($className,0,2)=='M_') {
                    $DbArr = explode("/",$ConvertString);
                    $_SESSION['DBNAME'] = $DbArr['1'];
                    $_SESSION['TBNAME'] = $DbArr['2'];
		}
		$classFile = ('Cemvc/' == substr($ConvertString,0,6))?CEPath . $ConvertString . '.php' : SitePath . '/' . $ConvertString . '.php';

		//加载文件或报错
		if(is_file($classFile))
		{
			include_once($classFile);
			//echo $classFile.'<br>';
		}
		else
		{
			new Cemvc_App_Error($ConvertString.'.php 不存在');
			exit;
		}
	}
}
?>
