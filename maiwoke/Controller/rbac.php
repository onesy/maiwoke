<?php
Class C_rbac extends Cemvc_Control_Base
{
	public function index()
	{
		if($_POST)
		{
			if(strtolower($_POST['vc'])==strtolower($_SESSION['CaptchaCode']))
			{	
					if($_POST['username']=='test' && $_POST['password']=='test')
					$this->setRole("MEMBER");
					//$Mdb->insert($data);			
							
			}
			else
			{
			$this->assign("alert","验证码错误");
			}
		}
		$this->assign("currRole",$_SESSION['Role']);
		$this->display();
	}
}
//utf8编码
?>