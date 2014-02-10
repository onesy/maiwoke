<?php
Class C_ajax extends Cemvc_Control_Base
{
	public function getdata()
	{
		$Mdb=M_User_Student::getInstance();
		$arr=$Mdb->limit(3)->fetchAll();
		$listInfo='';
		foreach($arr as $student)
	 	$listInfo.='<tr><td>'.$student['id'].'</td><td >'.$student['username'].'</td><td>'.$student['age'].'</td><td>'.$student['sex'].'</td></tr>';
		$Mdb->AjaxType=true;
		//$Mdb->AjaxFunction=getPage;
		$pageStr=$Mdb->showPages();
		header("Content-Type:text/html; charset=utf-8");
		echo '{ "listInfo":"'.$listInfo.'","pageStr":"'.$pageStr.'"}';
	}
	public function show()
	{

		$Mdb=M_User_Student::getInstance();
		$arr=$Mdb->limit(3)->fetchAll();
		$this->assign("students",$arr);	
		$Mdb->AjaxType=true;
		//$Mdb->AjaxFunction=getPage;
		$this->assign("page_str",$Mdb->showPages());//   /demo/show/page/

		$this->display();

	}
}
//utf8编码
?>