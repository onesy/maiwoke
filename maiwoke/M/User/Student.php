<?php
class M_User_student extends Cemvc_Db_MysqlDb{
	public $PrimaryKey='id';
	/*CEPHP会在要需要时查询主键，但主动设置主键可以使程序执行更快*/
}
?>