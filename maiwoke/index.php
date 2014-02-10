<?php
define('GlobalSession',true);//是否开启全局SESSION
define('DebugMode',0);//设置调试模式，即error_reporting的对应值

include_once '../Cemvc/App/Init.php';//加载框架并初始化

CE::LoadClass('Public_Set_Mysql');//载入MYSQL配置文件
// CE::LoadClass('Public_Set_Smarty');//载入SMARTY配置文件，如果不使用SMARTY模板，屏蔽本行即可
CE::LoadClass('Public_Set_Acl');//载入角色配置文件
define('RBAC',true);//是否启用RBAC
define('UrlSeparation','/');//URL分拆符
define("MysqlCharset","UTF8");//设置数据库编码
define('DefaultRole',"GUEST");//默认角色
define('DefaultModuleAction',"index");//默认Module
define('DefaultMethodAction',"index");//默认Method
define('PageExtensions',".html");//页面伪静态扩展名
define('PageTag',"page");//分页标识符
define('FMWNAME', 'Cemvc');// 框架文件夹名称.
define('WebHost', 'www.maiwoke.com');
new Cemvc_Control_Divide();//开始运行
?>