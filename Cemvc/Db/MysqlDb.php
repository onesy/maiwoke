<?php
/******************************************************************
*
##  Project:CEPHP,A concise and easy framework for PHP
##  Copyright: 2010 All rights reserved
##  version: 1.0.8
##  Author: eastdoor <cephp@sina.com>
*
##  File: MysqlDb.php (Cemvc_Db_MysqlDb)
*
******************************************************************/
class Cemvc_Db_MysqlDb extends Cemvc_Db_Base
{
	//类的基本信息声明：自身静态变量，主机，用户，密码，数据库，表
	protected static $Instance=NULL;
	public $Host;
	public $User;
	public $PassWord;
	public $DataBase;
	public $TableName;
	public $TablesArray=array();
	//链接，错误信息
	public $Link;
	public $ErrorInfo;
	//当前查询字串，最后一次运行字串，资源，返回数组及CRUD字串,链接字串
	public $QueryString;
	public $LastQueryString;
	public $Resource;
	public $ResourceArray;
	public $InsertString;
	public $UpdateString;
	public $DeleteString;	
	public $OrderByString;
	public $GroupByString;
	public $JoinString;
	//域字串，AS字串，LIMIT字串，最后运行的LIMIT字串及条件字串及清空和分页符
	private $FieldString;
	private $AsString;
	private $LimitString;
	private $LastLimitString;
	private $WhereString;
	private $TruncateString;
	private $GetPageTag;
	//当前页码，每页显示数，总记录数，总分页数，分页区间长度及开始和结束数及伪静态分页扩展名
	public $CurrPageNum;
	public $PageNum;
	public $CountNum;
	public $CountPageNum;
	private $PagesRangeNum;
	private $PagesRangeStartNum;
	private $PagesRangeEndNum;
	public $PageExtensions;
	//主键名及当前主键ID	
	public $PrimaryKey;
	public $CurrPrimaryId;
	//AJAX分页方式，AJAX函数名
	public $AjaxType=false;
	public $AjaxFunction="ajaxPage";
	//静态CURD及清空常量字串
	const InsertStr="INSERT INTO ";
	const SelectStr="SELECT ";
	const UpdateStr="UPDATE ";	
	const DeleteStr="DELETE ";
	const TruncateStr="TRUNCATE TABLE ";		
	//静态查询类常量字串
	const ShowTablesStr=" SHOW TABLES ";
	const FromStr=" FROM ";
	const LimitStr=" LIMIT ";
	const WhereStr=" WHERE ";
	const OrderByStr=" ORDER BY ";
	const GroupByStr=" GROUP BY ";
	const ValuesStr=" VALUES ";
	const SetStr=" SET ";
	const JoinStr=" JOIN ";
	const LeftJoinStr=" LEFT JOIN ";
	const InnerJoinStr=" INNER JOIN ";
	const RightJoinStr=" RIGHT JOIN ";
	const OnStr=" ON ";
	//静态查询类常量字串
	
	//单例模式实现函数
	public static function getInstance()
	{
		if(!self::$Instance instanceof self){
			self::$Instance=new self;
		}
		$InstanceObj=self::$Instance;
		if($InstanceObj->DataBase!=$_SESSION['DBNAME'])
			$InstanceObj->selectDb($_SESSION['DBNAME']);
		$InstanceObj->TableName=$_SESSION['TBNAME'];
		return $InstanceObj;
	}
	//初始化链接数据库，选库
	public function __construct($DataBase=NULL,$TableName=NULL)
	{
		if(!empty($DataBase) && !empty($TableName)){
			$this->DataBase=$DataBase;
			$this->TableName=$TableName;
		}else{
			$DataBaseArr=explode("/",preg_replace("/([^_]{1})_/", "\$1/", get_class($this),2));
			$this->DataBase=$DataBaseArr[1];
			$this->TableName=$DataBaseArr[2];
		}

		if('Db'==$this->DataBase && 'MysqlDb'==$this->TableName){
			$this->DataBase=$_SESSION['DBNAME'];
			$this->TableName=$_SESSION['TBNAME'];
		}
		$this->connect(DefaultLink);
		$this->selectDb();
		if(defined("MysqlCharset"))
		$this->setDbCodeNames(MysqlCharset);
		if(defined("PageExtensions"))
		$this->PageExtensions=constant("PageExtensions");
	}
	//重新设置库名
	public function setDb($DataBase)
	{
		$this->DataBase=$DataBase;
		$this->selectDb();
	}
	//重新设置表名
	public function setTable($TableName)
	{
		$this->TableName=$TableName;
	}	
	//设置数据库编码
	public function setDbCodeNames($Name)
	{
		$this->QueryString="set names ".$Name;
		$this->query();
		$this->resetQueryString();
	}
	//链接数据库
	public function connect($LinkName)
	{
		$LinkArr=explode(",",$LinkName);
		$this->Host=$LinkArr[0];
		$this->User=$LinkArr[1];
		$this->PassWord=$LinkArr[2];
		$link =@mysql_connect($LinkArr[0],$LinkArr[1],$LinkArr[2]);	
		if (!$link)
		{
			$this->ErrorInfo='Mysql连接错误:('.$this->Host.')';
			$this->error();
		}
		else
		{
			$this->Link =$link;
		}
	}
	//选取当前数据库
	public function selectDb($DataBase=NULL)
	{
		if(NULL!=$DataBase)		
		$this->DataBase=$DataBase;
		if(!@mysql_select_db($this->DataBase,$this->Link))
		{
			$this->ErrorInfo=mysql_error();
			$this->error();	
		}
		else
		{
			return $this;
		}
	}
	//设置当前数据表
	public function formatTable($TableName=NULL)
	{
		if(NULL!=$TableName)	
		return '`'.$TableName.'`';	
	}
	//设定查询的字段，默认为*
	public function setField($Fields=NULL)
	{
		if(is_array($Fields))
			$this->FieldString='`'.implode('`,`',$Fields).'`';
		else
			$this->FieldString=is_null($Fields)?' * ':'`'.$Fields.'`';
		return $this;
	}	
	//构造WHERE字串
	public function where($WhereString)
	{
		if(is_array($WhereString))
		$this->WhereString=' '.self::WhereStr.implode(" and ",$WhereString);
		else
		$this->WhereString=' '.self::WhereStr.$WhereString;
		return $this;
	}
	//构造AS字串
	public function fieldAs($AsString)
	{
		if(is_array($AsString))
		$this->AsString.=' ,'.implode(" , ",$AsString);
		else
		$this->AsString.=' ,'.$AsString;
		return $this;
	}
	//构造JOIN字串
	public function join($TableSting,$OnString,$JoinStr=self::JoinStr)
	{
		if(!empty($TableSting))
		{
			$this->JoinString.=$JoinStr.$this->formatTable($TableSting).self::OnStr.$OnString;
		}
		return $this;
	}
	//构造LEFT JOIN字串
	public function leftJoin($TableSting,$OnString)
	{
		return $this->join($TableSting,$OnString,self::LeftJoinStr);
	}
	//构造INNER JOIN字串
	public function innerJoin($TableSting,$OnString)
	{
		return $this->join($TableSting,$OnString,self::InnerJoinStr);
	}
	//构造RIGHT JOIN字串
	public function rightJoin($TableSting,$OnString)
	{
		return $this->join($TableSting,$OnString,self::RightJoinStr);
	}
	//构造LIMIT字串
	public function limit($LimitString,$SetPageParameter=TRUE)
	{
		$PageTagString=isset($_GET[PageTag])?$_GET[PageTag]:"";
		$pageLength=strlen($PageTagString);
		$targetCurrPage=!empty($this->PageExtensions)?substr($PageTagString,0,$pageLength-strlen($this->PageExtensions)):$PageTagString;
		$currPageNum=isset($_GET[PageTag])?$targetCurrPage:1;
		if($LimitString>0)
		$this->getPage($currPageNum);
		if(!empty($LimitString)){
			if($SetPageParameter)
			$this->LimitString=self::LimitStr.((($this->CurrPageNum)-1)*$LimitString).','.$LimitString;
			else
			$this->LimitString=self::LimitStr.$LimitString;
			$this->PageNum=$LimitString;
		}
		$this->LastLimitString=$this->LimitString;
		return $this;
	}
	//构造排序字串
	public function orderBy($OrderByString)
	{
		if(!empty($OrderByString)){
		$this->OrderByString=self::OrderByStr.$OrderByString;
		}
		return $this;
	}
	//构造group by字串
	public function groupBy($GroupByStr)
	{
		if(is_array($GroupByStr))
		$this->GroupByString=self::GroupByStr.implode(" , ",$GroupByStr);
		else
		$this->GroupByString=self::GroupByStr.$GroupByStr;
		return $this;
	}
	//手工执行函数
	public function mysqlQuery($QueryString=NULL)
	{	
		$this->LastQueryString=$QueryString;
		$this->QueryString=$QueryString;
		return $this;
	}
	//构造查询字串，所有动作执行的最终统一入口
	public function query()
	{
		if(!isset($QueryString)) $QueryString=NULL;
		if(empty($this->QueryString))
		{
			$QueryString.=self::SelectStr;
				if(empty($this->FieldString))
				$this->FieldString='*';
			$QueryString.=$this->FieldString;
			$QueryString.=$this->AsString;
			$QueryString.=self::FromStr;
			$QueryString.=$this->formatTable($this->TableName);
			$QueryString.=$this->JoinString;	
			$QueryString.=$this->WhereString;
			$QueryString.=$this->GroupByString;
			$QueryString.=$this->OrderByString;
		}
		else
		{
			$QueryString=$this->QueryString;
		}
		$QueryString.=$this->LimitString;
		$this->LastQueryString=$QueryString;
		$Resource=mysql_query($QueryString);
		$this->resetQueryString();
		if(false==$Resource)
		{
			$this->ErrorInfo=mysql_error();
			$this->error();	
			return false;		
		}
		else
		{
			$this->Resource=$Resource;
			return $this;
		}
	}
	//构造插入记录字串并运行
	public function insert($DataArray)
	{
		$this->InsertString=self::InsertStr.$this->TableName.' (`'.implode("`,`",array_keys($DataArray)).'`)'.self::ValuesStr.'("'.implode('","',array_values($DataArray)).'")';
		$this->QueryString=$this->InsertString;
		$this->query();
		$this->resetQueryString();
	}
	//构造更新记录字串并运行
	public function update($DataArray)
	{
		if(is_array($DataArray)){
			while (list($key, $val) = each($DataArray))
				$DataStrArr[]= "`$key` = '$val'";
			$SetValuesString=implode(',',$DataStrArr);
		}else{
			$SetValuesString=$DataArray;
		}
		$this->UpdateString=self::UpdateStr.$this->TableName.self::SetStr.$SetValuesString.$this->WhereString;
		$this->QueryString=$this->UpdateString;
		$this->query();
		$this->resetQueryString();
	}
	//构造删除记录字串并运行
	public function delete()
	{
		$this->DeleteString=self::DeleteStr.self::FromStr.$this->TableName.$this->WhereString;
		$this->QueryString=$this->DeleteString;
		$this->query();
		$this->resetQueryString();
	}
	//构造清空数据表字串并运行
	public function truncate()
	{
		$this->TruncateString=self::TruncateStr.$this->TableName;
		$this->QueryString=$this->TruncateString;
		$this->query();
		$this->ResetQueryString();
	}
	//返回查询结果，以数组方式
	public function fetchArray($Resource)
	{
		$ResourceArray=@mysql_fetch_assoc($Resource);
		$this->ResourceArray=$ResourceArray;
		return $ResourceArray;
	}
	//返回所有符合条件的结果，以数组返回
	public function fetchAll()
	{
		$this->query();
		while($temp_array=$this->fetchArray($this->Resource))
		{
			$array[]=$temp_array;
		}
		$this->resetQueryString();
		$array=is_array($array)?$array:array();
		return $array;
	}
	//FETCH的别名函数
	public function fetchOne()
	{
		return $this->fetch();
	}
	//以数组方式返回第一条符合条件的结果
	public function fetch()
	{
		$this->query();
		$ResourceArray=$this->fetchArray($this->Resource);
		$this->ResourceArray=$ResourceArray;
		$this->resetQueryString();
		return $ResourceArray;
	}
	//获取表的主键名
	public function getPrimaryKey()
	{
		$this->QueryString="DESCRIBE ".$this->TableName;
		$this->query();
		while($temp_array=$this->fetchArray($this->Resource))
		{
			if('PRI'==$temp_array['Key'])
			{
				$this->PrimaryKey=$temp_array['Field'];
				break;
			}
		}
		if(empty($this->PrimaryKey))
		{
			$this->ErrorInfo="主键不存在";
			$this->Error();
		}
		return $this->PrimaryKey;
	}
	//查询以主键名为查询条件的数据并返回
	public function find($PrimaryId)
	{
		if(empty($this->PrimaryKey))
		$this->getPrimaryKey();

		$this->QueryString=self::SelectStr.' * '.self::FromStr.$this->TableName.self::WhereStr.$this->PrimaryKey.'='.$PrimaryId;
		$this->query();
		$ResourceArray=$this->fetchArray($this->Resource);
		$this->ResourceArray=$ResourceArray;
		$this->resetQueryString();
		$this->CurrPrimaryId=$PrimaryId;
		return $ResourceArray;
	}
	//查询字段和特定值匹配的记录
	public function getBy($FieldName,$FieldValue,$OperateStr='=')
	{

		$this->QueryString=self::SelectStr.' * '.self::FromStr.$this->TableName.self::WhereStr.$FieldName.$OperateStr.'"'.$FieldValue.'"';
		$this->query();
		$ResourceArray=$this->fetchArray($this->Resource);
		$this->ResourceArray=$ResourceArray;
		$this->resetQueryString();
		return $ResourceArray;
	}
	//重设所有操作字串
	public function resetQueryString()
	{
		$this->FieldString=NULL;
		$this->AsString=NULL;
		$this->WhereString=NULL;
		$this->LimitString=NULL;
		$this->QueryString=NULL;
		$this->OrderByString=NULL;
		$this->JoinString=NULL;
	}
	//获取当前分页数字	
	public function getPage($CurrPageNum=1)
	{	
		$this->CurrPageNum=($CurrPageNum>0)?$CurrPageNum:1;
		return $this;
	}
	//统计记录个数
	public function countAll()
	{
		$this->QueryString=str_replace($this->LastLimitString,"",$this->LastQueryString);
		$this->query();
		$CountNum=@mysql_num_rows($this->Resource);
		$this->CountNum=$CountNum;
		return $CountNum;
	}
	//获取分页区间范围
	private function getPagesRange($PageRange)
	{
		if($PageRange>$this->CountPageNum)
		$PageRange=$this->CountPageNum;
		$this->PagesRangeNum=$PageRange;
		$HalfRangeNum=floor($this->PagesRangeNum/2);

		$leftSideNum=$this->CurrPageNum-$HalfRangeNum;
		if($this->CurrPageNum>$HalfRangeNum)
		{
			$rightSideNum=$this->CurrPageNum+$PageRange-$HalfRangeNum-1;
			$endPageNum=($rightSideNum>$this->CountPageNum)?$this->CountPageNum:$rightSideNum;
			$startPageNum=$endPageNum-$PageRange+1;
		}
		else
		{
			$startPageNum=($leftSideNum>=0)?$leftSideNum:1;
			$endPageNum=$PageRange;
		}

		if($startPageNum<=0)
			$startPageNum=1;
		$this->PagesRangeStartNum=$startPageNum;
		$this->PagesRangeEndNum=$endPageNum;
	}
	//取得分页组合字符串
	public function getPageString($SetPageUrl)
	{
		if($SetPageUrl=='')
		{
			//分页符变量
			$PSN=defined('UrlSeparation')?UrlSeparation:NULL;
			if($PSN=='/') $PSN="\\".$PSN;
			$ExtReplaceExp=!empty($this->PageExtensions)?"(".$this->PageExtensions.")":"";
			$PageTagString=isset($_GET[PageTag])?preg_replace("/".$PSN.PageTag.$PSN."\d+".$ExtReplaceExp.$PSN."$/","",WebUrl).$PSN.PageTag.$PSN:WebUrl.PageTag.$PSN;
			$PageTagString=str_replace("\\","",$PageTagString);
		}
		else
		{
			$PageTagString=WebRoot.$SetPageUrl;
		}
		return $PageTagString;
	}
	//生成可配置页面字串
	public function showPages($SetPageUrl="",$RangeNum=10,$TargetType="_self",$FirstTag="«",$PrevTag="‹",$NextTag="›",$LastTag="»",$PrevTenTag="...",$NextTenTag="...")
	{
		$countNum=$this->countAll();
		$this->PageNum=(($this->PageNum)>0)?$this->PageNum:$countNum;
		$this->CountPageNum=ceil($countNum/$this->PageNum);//总页数WebUrl
		$this->getPagesRange($RangeNum);
		if($this->CurrPageNum<=$this->CountPageNum)
		{			
			$PageTagString=(!$this->AjaxType)?urldecode($this->getPageString($SetPageUrl)):"";

			if(!isset($PageStr)) $PageStr=NULL;
			if($this->CurrPageNum>=2) $PageStr.=" <a href='".$PageTagString."1".$this->PageExtensions."' target='$TargetType'>".$FirstTag."</a> ";
			if($this->CurrPageNum>$this->PagesRangeNum) $PageStr.=" <a href='".$PageTagString.($this->CurrPageNum-$this->PagesRangeNum).$this->PageExtensions."' target='$TargetType'>".$PrevTenTag."</a> ";
			if($this->CurrPageNum>1) $PageStr.=" <a href='".$PageTagString.($this->CurrPageNum-1).$this->PageExtensions."' target='$TargetType'>".$PrevTag."</a> ";
			for($i=$this->PagesRangeStartNum;$i<=$this->PagesRangeEndNum;$i++)
			{
				if($this->CurrPageNum!=$i)		
				$PageStr.=" <a href='".$PageTagString."$i".$this->PageExtensions."' target='$TargetType'>[$i]</a> ";
				else
				$PageStr.=" <b>$i</b> ";
			}
			if($this->CurrPageNum<$this->CountPageNum && $this->CountPageNum>1) $PageStr.=" <a href='".$PageTagString.($this->CurrPageNum+1).$this->PageExtensions."' target='$TargetType'>".$NextTag."</a> ";
			if($this->CountPageNum-$this->CurrPageNum>$this->PagesRangeNum) $PageStr.=" <a href='".$PageTagString.($this->CurrPageNum+$this->PagesRangeNum).$this->PageExtensions."' target='$TargetType'>".$NextTenTag."</a> ";
			if($this->CurrPageNum<$this->CountPageNum && $this->CountPageNum>1) $PageStr.=" <a href='".$PageTagString."$this->CountPageNum".$this->PageExtensions."' target='$TargetType'>".$LastTag."</a> ";
			//$this->CountPageNum=$this->CountPageNum;
			if($this->AjaxType)
			$PageStr=preg_replace("/<a\shref=\'(.*?)\'\starget/i", '<a href=javascript:'.$this->AjaxFunction."('\${1}'); target",$PageStr);
			return $PageStr;
		}
	}

	//生成简单的分页字串
	public function showSamplePages($SetPageUrl="")
	{
		$countNum=$this->countAll();
		$this->PageNum=(($this->PageNum)>0)?$this->PageNum:$countNum;
		//总页数
		$CountPageNum=ceil($countNum/$this->PageNum);
		$PageTagString=(!$this->AjaxType)?urldecode($this->getPageString($SetPageUrl)):"";
		$PageTagString=urldecode($PageTagString);
		for($i=1;$i<=$CountPageNum;$i++)
		{
			if($this->CurrPageNum!=$i)		
			$PageStr.=" <a href='".$PageTagString.$i.$this->PageExtensions."' >[$i]</a> ";
			else
			$PageStr.=" <b>$i</b> ";
		}
		if($this->AjaxType)
		$PageStr=preg_replace("/<a\shref=\'(.*?)\'/i", '<a href=javascript:'.$this->AjaxFunction."('\${1}');",$PageStr);
		return $PageStr;
	}
	public function dumpInfo($var='')
	{
		if(!empty($var)){
		return var_dump($var);
		}
		else
		{
			return var_dump($this);
		}
	}		
}
?>