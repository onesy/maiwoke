<?php /* Smarty version 2.6.25, created on 2010-05-26 08:33:22
         compiled from student/delete_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'student/delete_list.html', 28, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['WebRoot']; ?>
/Public/Css/CE.css" />
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
  <p> <br /><br /><br />
 <div style="height:400px">
   <h3>删除 演示，点击链接操作</h3>
   <br />
<table width="443" border="0" align="center" cellpadding="15" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
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

 		<td ><?php echo $this->_tpl_vars['rs']['id']; ?>
</td>
      <td><a href="<?php echo $this->_tpl_vars['WebRoot']; ?>
/student/delete/id/<?php echo $this->_tpl_vars['rs']['id']; ?>
" title="点击删除"><?php echo $this->_tpl_vars['rs']['username']; ?>
</a> <a href="<?php echo $this->_tpl_vars['WebRoot']; ?>
/student/delete/id/<?php echo $this->_tpl_vars['rs']['id']; ?>
" title="点击删除">删除</a></td>
      <td><?php echo $this->_tpl_vars['rs']['age']; ?>
</td>
      <td><?php echo $this->_tpl_vars['rs']['sex']; ?>
</td>

    </tr>
	<?php endforeach; endif; unset($_from); ?>
  </table>


<br />
 
	<?php echo $this->_tpl_vars['page_str']; ?>
  <br /><br />
    </p>

<p>
</div>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "include/bottom.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>  
</p>
</div>
</body>
</html>