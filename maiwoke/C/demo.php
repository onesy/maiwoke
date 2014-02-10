<?php
Class C_demo extends Cemvc_Control_Base
{
	public function index()
	{
	
		$this->display();

	}
	public function crud()
	{
	
		$this->display();

	}
	public function show()
	{
		$Mdb=M_User_Student::getInstance();
		$arr=$Mdb->where(array("id>0"))->limit(3)->fetchAll();//每页三行
		$this->assign("students",$arr);	
		$this->assign("page_str",$Mdb->showPages("",9));//显示区间为6，/demo/show/page/
		$this->display();
	}
}
//utf8编码
?>  
