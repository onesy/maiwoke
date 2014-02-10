<?php
/******************************************************************
*
##  Project:CEPHP,A concise and easy framework for PHP
##  Copyright: 2010 All rights reserved
##  version: 1.0.8
##  Author: eastdoor <cephp@sina.com>
*
##  File: Error.php (Cemvc_App_Error)
*
******************************************************************/
Class Cemvc_App_Error{
	public function __construct($ErrorMessage){
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>系统发生错误</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
body{
	font-family: Microsoft Yahei, Verdana, arial, sans-serif;
	font-size:14px;
}

h2{
	border-bottom:1px solid #EEEEEE;
	padding:10px 0;
    font-size:25px;
}
.box{
	background:#FFFFCA;
	color:#2E2E2E;
	border:1px solid #E0E0E0;
	padding:20px;
}
</style>
</head>
<body>

<h2 align="center"><font color="#00FFFF">C</font><font color="#00CC33">E</font><font color="#CACACA">php</font></h2>
<p class="box"><font color=red>错误信息:</font>'.$ErrorMessage.'</p>
<div align="center" style="color:#FF3300;margin:5pt;font-family:Verdana"><span style="color:silver"> < A concise and easy framework for php ></span></div>
</body>
</html>';			
	}
}
?>