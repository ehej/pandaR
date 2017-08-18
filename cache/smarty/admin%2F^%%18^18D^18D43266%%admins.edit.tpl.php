<?php /* Smarty version 2.6.19, created on 2017-06-01 16:09:12
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/admins.edit.tpl */ ?>
<?php echo '
<script type="text/javascript">
	function SaveForm() {
		$(\'#event\').val(\'save\');
		$(\'#editForm\').submit();
	}
</script>
'; ?>


<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("admins.php")'/>

<form action="admins.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intAdminID" id="intAdminID" value="<?php echo $this->_tpl_vars['data']['intAdminID']; ?>
" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные администратора</th></tr></thead>
		<tbody>
			<tr>
				<td>Логин<span class="important">*</span></td>
				<td><input type="text" id="varLogin" name="varLogin" value="<?php echo $this->_tpl_vars['data']['varLogin']; ?>
" size="122" /></td>
			</tr>
			<tr>
				<td>Пароль</td>
				<td><input type="password" id="varPassword" name="varPassword" size="122" /></td>
			</tr>
			<tr>
				<td>E-mail<span class="important">*</span></td>
				<td><input type="text" id="varEmail" name="varEmail" value="<?php echo $this->_tpl_vars['data']['varEmail']; ?>
" size="122" /></td>
			</tr>
			<tr>
				<td>Ф. И. О.<span class="important">*</span></td>
				<td><input type="text" id="varFIO" name="varFIO" value="<?php echo $this->_tpl_vars['data']['varFIO']; ?>
" size="122" /></td>
			</tr>
			<tr>
				<td>Телефон<span class="important">*</span></td>
				<td><input type="text" id="varPhone" name="varPhone" value="<?php echo $this->_tpl_vars['data']['varPhone']; ?>
" size="122" /></td>
			</tr>
			<tr>
				<td>Роль</td>
				<td>
					<select name="intRoleID" id="intRoleID">
						<?php $_from = $this->_tpl_vars['roles_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<option value="<?php echo $this->_tpl_vars['item']['intRoleID']; ?>
"<?php if ($this->_tpl_vars['item']['intRoleID'] == $this->_tpl_vars['data']['intRoleID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['varRoleName']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Активен</td>
				<td><input  style="float:left;" type="checkbox" id="isActive" name="isActive" value="1"<?php if ($this->_tpl_vars['data']['isActive'] == '1'): ?> checked="checked"<?php endif; ?> /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>