<?php /* Smarty version 2.6.25, created on 2011-06-05 05:34:22
         compiled from student/info.html */ ?>
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
/Public/Img/CEPHP.png"  /></div>



	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "include/nav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  

<p><h3><?php echo $this->_tpl_vars['alert']; ?>
</h3></p>
  <table width="320" border="0" align="center" cellpadding="8" cellspacing="1" bgcolor="#666666">
    <tr>
      <td colspan="2" bgcolor="#CCCCCC"><div align="center"><strong>学生信息</strong></div></td>
    </tr>
    <tr>
      <td width="60" bgcolor="#F6F6F6">序号</td>
      <td  bgcolor="#F6F6F6"><?php echo $this->_tpl_vars['student']['id']; ?>
</td>
    </tr>
    <tr>
      <td bgcolor="#F6F6F6">姓名</td>
      <td bgcolor="#F6F6F6"><?php echo $this->_tpl_vars['student']['username']; ?>
</td>
    </tr>
    <tr>
      <td bgcolor="#F6F6F6">年龄</td>
      <td bgcolor="#F6F6F6"><?php echo $this->_tpl_vars['student']['age']; ?>
</td>
    </tr>
    <tr>
      <td bgcolor="#F6F6F6">性别</td>
      <td bgcolor="#F6F6F6"><?php echo $this->_tpl_vars['student']['sex']; ?>
</td>
    </tr>
  </table>
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
