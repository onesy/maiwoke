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
        
        public static $controller;
        
        public static $action;
        
        public static $tpl;

        public function __construct()
	{
            // 去除RequstURI之前的多余的字符
            $request_uri = substr($_SERVER['REQUEST_URI'], 1);
            
            $requst_array = explode('?', $request_uri);
            // 确定请求参数
            $request_params = $this->getRequestParams($requst_array[0]);
            // 确定请求路径
            $request_route = $this->getRequestRoute($requst_array[1]);
            
            // 确定web_root和framework_root
            $web_root = dirname($_SERVER['SCRIPT_FILENAME']);
            $framework_root = dirname(dirname($_SERVER['SCRIPT_FILENAME'])) . DIRECTORY_SEPARATOR . FMWNAME;
            define('web_root', $web_root);
            
            if (!$request_route) {
                $request_route[] = DefaultModuleAction;
                $request_route[] = DefaultMethodAction;
            }
            $ajax = '';
            if (isset($request_params['_ajax_']) && $request_params['_ajax_'] == 1) {
                $ajax = "Ajax_";
            }
            Cemvc_App_Register::set('request_params', $request_params);
            Cemvc_App_Register::set('request_route', $request_route);
            // 初始化mvc
            $controller = "Contorller_$request_route[0]";
            self::$controller = new $controller;
            $action = $ajax . $request_route[1];
            self::$action = $action;
            self::$tpl = new Cemvc_App_Template();
            ob_start();
            self::$controller->{self::$action}();
            ob_end_flush();
            /**
             * $Obj=new $this->ClassName;
	     * $Obj->{$this->MethodAction}();
             */
            
            //-----------------------sunyuw writen------------------//
	}
        
        /**
         * 取得请求参数的array.
         * 
         * @param type $rp
         */
        public function getRequestParams($rp_str)
        {
            $rps_array = array();
            if ($rp_str) {
                $rps = explode('&', $rp_str);
                foreach ($rps as $rp) {
                    $kv = explode('=', $rp);
                    if(count($kv) == 2) {
                        $rps_array[$kv[0]] = $kv[1];
                    } else {
                        $rps_array[$kv[0]] = true;
                    }
                }
                $rps += $_GET;
                $rps += $_POST;
            }
            return $rps_array;
        }
        
        /**
         * 取得请求路径array
         * 
         * @param type $route_str
         */
        public function getRequestRoute($route_str)
        {
            $route_array = array();
            if ($route_str && count(explode('/', $route_str)) > 1 ) {
                $routes = explode('/', $route_str);
                $route_array += $routes;
            }
            return $route_array;
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