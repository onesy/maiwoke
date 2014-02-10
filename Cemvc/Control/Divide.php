<?php
/******************************************************************
*
##  Project:CEPHP,A concise and easy framework for PHP
##  Copyright: 2010 All rights reserved
##  version: 1.0.8
##  Author: eastdoor <cephp@sina.com>
*
##  File: Divide.php (Cemvc_Control_Divide)
*
******************************************************************/
class Cemvc_Control_Divide
{
	public $ClassName;
	public function __construct()
	{
		//去除接收参数中入口文件部分字符
		$BaseDirName=substr(dirname($_SERVER['SCRIPT_NAME']),1);
		$QuestingStr= preg_replace('/^\/'.str_replace("/","\/",$BaseDirName).'/i',"",preg_replace("/(index.php|\?)\//i","",$_SERVER["REQUEST_URI"]));
		
		//去除开头或结尾参多余/号
		$QuestingStr= preg_replace(array("/^(\/)+/","/(\/)+/","/(\/)+$/"),array("","/",""),$QuestingStr);	
		if(defined('UrlSeparation')) $QuestingStr=$QuestingStr.UrlSeparation;

		//定义网站根目录常量
		define('WebRoot',preg_replace("/^\/$/","",'/'.$BaseDirName));

		//定义网站URL常量
		define('WebUrl',WebRoot."/$QuestingStr");
		//如果接收到GET方式参数，则采用接收GET传参，兼容GET传参方式
		if(!defined("UrlSeparation"))
		$QuestingArr=array($_GET['module'],$_GET['controller']);
		else
		$QuestingArr=explode(UrlSeparation,$QuestingStr);			
		//生成GET参数值	
		
		if(empty($QuestingArr['0']))	
		$QuestingArr = array_slice($QuestingArr,1);		
		$ArrCount=count($QuestingArr)-1;		
		for($i=0;$i<$ArrCount;$i+=2)
		$_GET["$QuestingArr[$i]"]=urldecode($QuestingArr[($i+1)]);		
		//获取ModuleAction及MethodAction，缺省根目录访问

		$QuestingArr[0]=urldecode(!empty($QuestingArr[0])?$QuestingArr[0]:DefaultModuleAction);
		$QuestingArr[1]=urldecode(!empty($QuestingArr[1])?$QuestingArr[1]:DefaultMethodAction);
		$this->ModuleAction=$QuestingArr[0];
		$this->MethodAction=$QuestingArr[1];		
		define('ModuleAction',$this->ModuleAction);
		define('MethodAction',$this->MethodAction);

		$this->ClassName="C_$QuestingArr[0]";

		//空方法及空类的实现
		if (is_file('C/'.$QuestingArr[0].'.php')) {
			if (class_exists($this->ClassName))
			{
				$Method=$QuestingArr[1];
				if(!method_exists($this->ClassName,$Method))
				{
					if(method_exists($this->ClassName,'__empty'))
						$this->MethodAction='__empty';
					else
						new Cemvc_App_Error('类:'.$this->ClassName.'的方法 '.$Method.'() 不存在');
				}
			}
			else
				new Cemvc_App_Error('类:'.$this->ClassName.'的定义错误！');
		}
		else
		{
			if (!class_exists("C___empty"))
				new Cemvc_App_Error('类:'.$this->ClassName.' 不存在');	
			else
			{
				$this->ModuleAction='__empty';
				$this->MethodAction='__empty';
			}
		}
		$this->ClassName="C_$this->ModuleAction";
		
		//echo 'test';
		define('RbacModuleAction',$this->ModuleAction);
		define('RbacMethodAction',$this->MethodAction);

		$Obj=new $this->ClassName;
		$Obj->{$this->MethodAction}();
	}

	public function error()
	{

		if(!empty($this->ErrorInfo))
		{
			new Cemvc_App_Error($this->ErrorInfo);
		}
		exit;
	}
}
?>
