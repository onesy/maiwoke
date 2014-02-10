<?php
/******************************************************************
*
##  Project:CEPHP,A concise and easy framework for PHP
##  Copyright: 2010 All rights reserved
##  version: 1.0.8
##  Author: eastdoor <cephp@sina.com>
*
##  File: Base.php (Cemvc_Db_Base)
*
******************************************************************/
class Cemvc_Db_Base{
	public function __call($Key, $Args)
	{
		//实现getBY字段名方式调用
		if('getBy'==substr($Key,0,5))
		return $this->getBy(substr($Key,5),$Args[0]);
		$this->ErrorInfo="$Key 方法不存在";
		$this->error();
	}
	public function error()
	{
		new Cemvc_App_Error($this->ErrorInfo);
		exit;
	}
}
?>