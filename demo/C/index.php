<?php
Class C_index extends Cemvc_Control_Base
{
	public function index()
	{
	
		$this->display();

	}
	public function test()
	{
		echo 'test';
	}
	public function show()
	{

		$Mdb=M_User_Student::getInstance();
		$arr=$Mdb->where(array("id>0"))->limit(3)->fetchAll();
		//echo $Mdb->LastQueryString;
		$this->assign("students",$arr);	
		//$Mdb->Limit(3);
		//$page_num= $Mdb->count();
		$this->assign("page_str",$Mdb->showPages("",6));
		//$this->assign("page_num",$page_num);	
		$this->display();
	}
}
//utf8编码
?>  
