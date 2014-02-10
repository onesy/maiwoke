<?php /* Smarty version 2.6.25, created on 2011-06-05 05:34:40
         compiled from demo/crud.html */ ?>
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
  

<p>&nbsp;</p>
<p>
<h2>CRUD演示:</h2><ol><li>
    <h3><a href="<?php echo $this->_tpl_vars['WebRoot']; ?>
/student/insert">插入演示(含验证码演示)</a></h3>
  </li>
  <li>
    <h3><a href="<?php echo $this->_tpl_vars['WebRoot']; ?>
/demo/show">读取演示</a></h3>
  </li>
  <li>
    <h3><a href="<?php echo $this->_tpl_vars['WebRoot']; ?>
/student/update">修改演示</a></h3>
  </li>
  <li>
    <h3><a href="<?php echo $this->_tpl_vars['WebRoot']; ?>
/student/delete">删除演示</a></h3>
  </li>
</ol>
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