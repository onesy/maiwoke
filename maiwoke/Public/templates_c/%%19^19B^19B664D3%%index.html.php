<?php /* Smarty version 2.6.25, created on 2011-06-05 05:34:39
         compiled from rbac/index.html */ ?>
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
/Public/Img/CEPHP.png"  /></div>



	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "include/nav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 	  
	  
  </p>
  </p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;        </p>
	<div style="text-align:center; width:100%"><font color="red">您现在的角色是<?php echo $this->_tpl_vars['currRole']; ?>
,你<?php if ('GUEST' == $this->_tpl_vars['currRole']): ?>不<?php endif; ?>具备删除权限，点<strong><a href="<?php echo $this->_tpl_vars['WebRoot']; ?>
/student/delete" target="_blank">这里</a></strong>测试！</font></div>
	<br />
<?php if ('GUEST' == $this->_tpl_vars['currRole']): ?><form id="form1" name="form1" method="post" action="">
<table width="340" border="0" align="center" cellpadding="6" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><div align="center"><strong>模拟登录：登录后获得删除权限</strong><br />
      演示用户名和密码皆为&quot;test&quot;</div></td>
  </tr>
  <tr>
    <td width="78" bgcolor="#FFFFFF">用户名</td>
    <td width="235" bgcolor="#FFFFFF"><input name="username" type="text" id="username" value="test" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">密码</td>
    <td bgcolor="#FFFFFF"><input name="password" type="text" id="password" value="test" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">验证码</td>
    <td bgcolor="#FFFFFF"><input name="vc" type="text" id="vc" size="4" style="height:30px; font-size:24px" />
      <img src="<?php echo $this->_tpl_vars['WebRoot']; ?>
/vc/vcode" />&nbsp;<br><font color=red><?php echo $this->_tpl_vars['alert']; ?>
</font></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><div align="center">
      <input type="submit" value=" 提 交 " />
    </div></td>
  </tr>
</table>
</form><?php endif; ?>
<p>&nbsp; </p>


<p>&nbsp;</p>
<p>&nbsp;</p>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "include/bottom.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>  
</p>
</div>
</body>
</html>