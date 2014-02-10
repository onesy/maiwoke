<?php
define('GlobalSession',true);//是否开启全局SESSION
define('DebugMode',0);//设置调试模式，即error_reporting的对应值

include_once '../Cemvc/App/Init.php';//加载框架并初始化

CE::LoadClass('Public_Set_Mysql');//载入MYSQL配置文件
define('UrlSeparation','/');//URL分拆符
define("MysqlCharset","UTF8");//设置数据库编码
define('DefaultRole',"GUEST");//默认角色
define('DefaultModuleAction',"Index");//默认Module
define('DefaultMethodAction',"index");//默认Method
define('PageExtensions',".html");//页面伪静态扩展名
define('PageTag',"page");//分页标识符
define('FMWNAME', 'Cemvc');// 框架文件夹名称.
define('WebHost', 'www.maiwoke.com');
new Cemvc_Control_Divide();//开始运行
?>