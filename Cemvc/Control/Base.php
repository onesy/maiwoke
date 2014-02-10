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
class Cemvc_Control_Base{
    public $Role=DefaultRole;
    public $view;
    public $ModuleAction;
    public $MethodAction;
    public function __construct()
    {
            if(RBAC)
            $this->setRole();
            //扩展SMARTY引擎
            if(defined('SmartyInitFile'))
            {
                    include_once (SmartyInitFile);
                    $this->view = new Smarty;
                    //配置SMARTY引擎
                    $this->view->template_dir =TemplateDir;
                    $this->view->compile_dir =CompileDir;
                    $this->view->left_delimiter = LeftDelimiter;
                    $this->view->right_delimiter = RightDelimiter;
                    $this->view->TplExtension = TplExtension;
                    $this->view->assign('WebRoot',WebRoot);
                    $this->view->assign('WebUrl',WebUrl);
            }

    }
    //重写DISPLAY函数
    public function display($tpl=NULL)
    {
            if(NULL==$tpl)
                    $this->view->display(ModuleAction."/".MethodAction.TplExtension);
            else
                    $this->view->display($tpl);		
    }
    //调用SMARTY函数，不存在时报错
    public function __call($Method, $Args)
    {

            if(method_exists($this->view,$Method))
            {
                    $Args=array_pad($Args,5,NULL);
                    return ($this->view->{$Method}($Args[0],$Args[1],$Args[2],$Args[3],$Args[4]));
            }
            else
            {
                    $this->ErrorInfo="$Method 方法不存在";
                    $this->Error();
            }
    }
    //重定向
    public function redirect($TargetUrl)
    {
            $RedirectUrl=WebRoot.'/'.$TargetUrl;
            if (!headers_sent()) {
                header('Location: '.$RedirectUrl);
            } else {
                echo '<meta http-equiv="Refresh" content="0;URL='.$RedirectUrl.'" />';
            }
    }
    //设置角色
    public function setRole($Role=NULL)
    {
            if(NULL!=$Role)
            {
                    $this->Role=$Role;
                    $_SESSION['Role']=$Role;
            }
            else
            {
                    if(isset($_SESSION['Role']))
                    $this->Role=$_SESSION['Role'];
                    else
                    $_SESSION['Role']=$this->Role;
            }
            $this->issue();
    }
    //授予访问权限
    public function issue()
    {
            $CurrTarget=RbacModuleAction.UrlSeparation.RbacMethodAction;
            $AllowArr=isset($_SESSION[$this->Role]['ALLOW'])?$_SESSION[$this->Role]['ALLOW']:array();
            $ForbidArr=isset($_SESSION[$this->Role]['FORBID'])?$_SESSION[$this->Role]['FORBID']:array();
            if((count($AllowArr)>0 && !in_array($CurrTarget,$AllowArr)) | (count($ForbidArr)>0 && in_array($CurrTarget,$ForbidArr))){
                    new Cemvc_App_Error('Role:'.$this->Role.',权限不够!');
                    exit();
            }	
    }
}
?>
