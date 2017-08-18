<?php /* Smarty version 2.6.19, created on 2017-08-17 00:49:06
         compiled from F:/OpenServer/domains/panda.fm/data/templates/admin/logon.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title><?php echo $this->_tpl_vars['pagetitle']; ?>
</title>
<link rel="STYLESHEET" type="text/css" href="/css/admin.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="developer" content="www.miritec.com" />
</head>

<body>
<div id="login-container">

<form method="post" action="logon.php">
<input type="hidden" name="q" value="<?php echo $this->_tpl_vars['logon_target']; ?>
"/>
<input type="hidden" name="event" value="logon"/>
<table width="100%" height="95%">
	<tbody><tr><td width="100%" height="100%" style="text-align: center; vertical-align: middle; ">
		<table style="width: 185px; margin: 0 auto;"><tbody>
			<?php if ($this->_tpl_vars['messages']): ?><tr><td colspan="2">
			<div class="messagesbox">
				<ul>
				<?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['message']):
?>
					<li><?php echo $this->_tpl_vars['message']['msg']; ?>
</li>
				<?php endforeach; endif; unset($_from); ?>
				</ul>
			</div>
			<br /></td></tr>
			<?php endif; ?>
		<tr>
			<td><label for="login">Логин</label></td>
			<td><input type="text" id="login" name="login" /></td>
		</tr>
		<tr>
			<td><label for="password">Пароль</label></td>
			<td><input type="password" id="password" name="password" /></td>
		</tr>
		<tr>
			<td colspan="2" align="right" style="text-align: right;"><input type="submit" value="Вход"></td>
		</tr></tbody></table>
	</td></tr></tbody>
</table>
</form>

</div>
</body>
</html>