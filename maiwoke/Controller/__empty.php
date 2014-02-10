<?php
Class C___empty extends Cemvc_Control_Base
{
	public function __empty()
	{
		$Mdb=M_User_Student::getInstance();
		$arr=$Mdb->getByUsername(ModuleAction);
		//$Mdb->test();
		$this->assign("student",$arr);	
		$this->assign("alert","空操作演示");	
		$this->display('student/info.html');
		

		$time_end=explode(" ",microtime());
		$c=$time_end[0]+$time_end[1]-$_SESSION['time_start'][0]-$_SESSION['time_start'][1];
		echo "<center>运行时间：".$c."秒</center>";	
			
	}
}
//utf8编码
?>  
