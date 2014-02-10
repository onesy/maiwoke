<?php
Class C_vc extends Cemvc_Control_Base
{
	function vcode()
	{
		session_start();
		$vc=new Cemvc_Ext_Captcha();
		$vc->FontFace="Public/Fonts/Gutcruncher.ttf";
		$vc->createCaptcha();
		/*中文验证码演示
		$vc->CharSet="CH";//设定字符为中文
		$vc->BaseString="一些用来随机的汉字二百字左右为佳";
		$vc->FontFace="....字体路径....../字体.ttf";
		$vc->createCaptcha();//生成验证码
		*/
	}
}
?>