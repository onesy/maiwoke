<?php
Class C_student extends Cemvc_Control_Base
{
	public function __empty()
	{
		$Mdb=M_User_Student::getInstance();
		$arr=$Mdb->getByUsername(preg_replace("/\.html$/i","",MethodAction));
		$this->assign("student",$arr);	
		$this->display('student/info.html');
	}
	public function insert()
	{
		session_start();
	if($_POST)
	{
		if($_POST['vc']==$_SESSION['CaptchaCode'])
		{	
				$Mdb=M_User_Student::getInstance();
				$data["username"]=$_POST['username'];
				$data["age"]=$_POST['age'];
				$data["sex"]=$_POST['sex'];
				$Mdb->insert($data);
							
		}
		else
		{
		$this->assign("alert","验证码错误");
		}
		
	  }
	  $this->display();
	}
	public function update()
	{

		//$Mdb->SetDbCodeNames("utf8");
		if(!$_GET['id'])
		{
		//echo 'test';
		$this->update_list();	
		}
		else
		{
			$Mdb=M_User_Student::getInstance();
			if($_POST)
			{
			$Mdb->where(array("id=$_GET[id]","id>14"))->update($_POST);//必须将按钮名设为空
			/*更安全的方法
			$data["username"]=$_POST['username'];
			$data["age"]=$_POST['age'];
			$data["sex"]=$_POST['sex'];
			$Mdb->where(array("id=$_GET['id']"))->update($data);
			*/	
			}

			$this->assign("student",$Mdb->find($_GET['id']));	
			$this->display();				
		}

	}
	public function update_list()
	{
		$Mdb=M_User_Student::getInstance();
		$arr=$Mdb->where(array("id>14"))->limit(3)->fetchAll();//每页三行
		$this->assign("students",$arr);	
		$this->assign("page_str",$Mdb->showPages("/student/update/page/",6));//显示区间为6，/demo/show/page/
		$this->display("student/update_list.html");
	}	
	public function delete()
	{
		if(!$_GET['id'])
		{
		$this->delete_list();	
		}
		else
		{
			$Mdb=M_User_Student::getInstance();

			$Mdb->where(array("id=$_GET[id]","id>14"))->delete();
			$this->delete_list();	
		}

	}
	public function delete_list()
	{

		$Mdb=M_User_Student::getInstance();
		$arr=$Mdb->where(array("id>14"))->limit(3)->fetchAll();//每页三行
		$this->assign("students",$arr);	
		$this->assign("page_str",$Mdb->showPages("/student/delete/page/",6));//显示区间为6，/demo/show/page/
		$this->display("student/delete_list.html");
	}
	public function info()
	{
		$Mdb=M_User_Student::getInstance();
		if($_GET['name'])
		$arr=$Mdb->getByUsername($_GET['name']);
		else
		$arr=$Mdb->find($_GET['id']);
		$this->assign("student",$arr);	

		$this->display();
	}
}
//utf8编码
?>