<?php /* Smarty version 2.6.25, created on 2010-05-26 08:07:28
         compiled from student/update.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['WebRoot']; ?>
/Public/Css/CE.css" />
<title><?php echo $this->_tpl_vars['alert']; ?>
</title>
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
  

<p><h3>&nbsp;</h3>
</p>
<form id="form1" name="form1" method="post" action="">
<table width="268" border="0" align="center" cellpadding="6" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><div align="center">
      更新数据演示（未设置任何数据较验）
    </div></td>
  </tr>
  <tr>
    <td width="170" bgcolor="#FFFFFF">&nbsp;姓名</td>
    <td width="82" bgcolor="#FFFFFF"><input name="username" type="text" id="username" value="<?php echo $this->_tpl_vars['student']['username']; ?>
" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">年龄</td>
    <td bgcolor="#FFFFFF"><input name="age" type="text" id="age"  value="<?php echo $this->_tpl_vars['student']['age']; ?>
" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">性别</td>
    <td bgcolor="#FFFFFF"><input name="sex" type="text" id="sex" value="<?php echo $this->_tpl_vars['student']['sex']; ?>
" /></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><div align="center">
      <input type="submit" value=" 更 新 " />
    </div></td>
  </tr>
</table>
</form>
<p>&nbsp; </p>


<p>&nbsp;</p>
<p>&nbsp;</p>
<p>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "include/bottom.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>  
</p>
</div>
</body>
</html>
