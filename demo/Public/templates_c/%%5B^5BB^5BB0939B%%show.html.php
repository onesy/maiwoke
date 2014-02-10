<?php /* Smarty version 2.6.25, created on 2011-06-05 05:30:09
         compiled from ajax/show.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'ajax/show.html', 38, false),array('function', 'cycle', 'ajax/show.html', 47, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['WebRoot']; ?>
/Public/Css/CE.css" />
<script language="javascript" src="<?php echo $this->_tpl_vars['WebRoot']; ?>
/Public/Js/jquery-1.4.2.min.js"></script>
<script language="javascript">
function ajaxPage(page)
{
	$.get('<?php echo $this->_tpl_vars['WebRoot']; ?>
/ajax/getdata/page/'+page,function (data)
	{
		$("#tb").siblings().remove();
		$("#content,#pageString").css("display","none");
		$("#tb").after(data.listInfo);
		$("#pageString").html(data.pageStr);
		$("table tr:even").css("background-color","#F9F9F9"); 
		$("table tr:odd").css("background-color","#FFFFFF");
		$("#content,#pageString").fadeIn();						
	},"json");
}
</script>
<title>test</title>
</head>
<body>

<div id="body">
<div align="left"><img src="<?php echo $this->_tpl_vars['WebRoot']; ?>
/Public/Img/CEPHP.png" width="227" height="103" /></div>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "include/nav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <p> <br />
 <div style="height:400px">
   <h3 align="center">AJAX分页 演示</h3>
   <br />
<div style="margin:0 auto; text-align:center">
   
<br />
</div>
<div id="content" >
<?php if (count($this->_tpl_vars['students']) != 0): ?>
<table   width="639" border="0" align="center" cellpadding="15" cellspacing="1" bgcolor="#CCCCCC">
    <tr id="tb"> 
	<td bgcolor="#E0E0E0">序号</td>
      <td bgcolor="#E0E0E0">&nbsp;姓名</td>
      <td bgcolor="#E0E0E0">年龄</td>
      <td bgcolor="#E0E0E0">性别</td>
    </tr>
	<?php $_from = $this->_tpl_vars['students']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
	<tr bgcolor="<?php echo smarty_function_cycle(array('values' => '#FFFFFF,#F9F9F9'), $this);?>
">

 		<td><?php echo $this->_tpl_vars['rs']['id']; ?>
</td>
      <td><?php echo $this->_tpl_vars['rs']['username']; ?>
</td>
      <td><?php echo $this->_tpl_vars['rs']['age']; ?>
</td>
      <td><?php echo $this->_tpl_vars['rs']['sex']; ?>
</td>
    </tr>

	<?php endforeach; endif; unset($_from); ?>
	</table>

</div>
<?php else: ?>
<br />
<div id="error2" style="display:none;margin:0 auto; text-align:center; width:400px; height:25px; background-color: #F6F6F6; padding-top: 11px;  border-color: #FF0000; border-width: 1px; border-style: solid;">
<strong>没有符合条件的数据！</strong>
</div>
<?php endif; ?>  


<br />
 
	 <div id="pageString" align="center"><?php echo $this->_tpl_vars['page_str']; ?>
</div>  <br /><br />
    </p>

</div>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "include/bottom.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>  

</div>
</body>
</html>