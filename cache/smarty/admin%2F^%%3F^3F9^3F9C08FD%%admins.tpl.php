<?php /* Smarty version 2.6.19, created on 2017-06-01 16:09:09
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/admins.tpl */ ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("admins.edit.php")'/>

<form action="admins.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['sortOrder']; ?>
"/>
<input type="hidden" name="sortBy" id="sortBy" value="<?php echo $this->_tpl_vars['sortBy']; ?>
"/>
<div align="right">
	<input type="text" name="varLogin" id="varLogin" class="titled" value="<?php echo $this->_tpl_vars['filter']['LIKEvarLogin']; ?>
" title="Login" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varLogin','text' => 'Login','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varFIO','text' => 'Ф. И. О.','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'intRoleID','text' => 'Роль','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th width="100">Действия</th>
	</tr>
	<?php $_from = $this->_tpl_vars['admins_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['admins'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['admins']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['admins']['iteration']++;
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
	<?php if ($this->_tpl_vars['item']['intAdminID'] != $this->_tpl_vars['DEFAULT_SUPER_ADMIN_ID']): ?>
	<tr onDblClick='window.location="admins.edit.php?intAdminID=<?php echo $this->_tpl_vars['item']['intAdminID']; ?>
"'>
		<td><?php echo $this->_tpl_vars['item']['varLogin']; ?>
</td>
		<td><?php echo $this->_tpl_vars['item']['varFIO']; ?>
</td>
		<td>
			<?php $_from = $this->_tpl_vars['roles_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['roles'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['roles']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['it']):
        $this->_foreach['roles']['iteration']++;
?>
				<?php if ($this->_tpl_vars['it']['intRoleID'] == $this->_tpl_vars['item']['intRoleID']): ?><?php echo $this->_tpl_vars['it']['varRoleName']; ?>
<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("admins.edit.php?intAdminID=<?php echo $this->_tpl_vars['item']['intAdminID']; ?>
")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("admins.php?intAdminID=<?php echo $this->_tpl_vars['item']['intAdminID']; ?>
&event=delete", "Вы уверены, что хотите удалить запись с ID=<?php echo $this->_tpl_vars['item']['intAdminID']; ?>
?")'/></td>
	</tr>
	<?php endif; ?>
	<?php endif; ?>
	<?php endforeach; else: ?>
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	<?php endif; unset($_from); ?>
</table>
<!-- /Таблица -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "scroller.tpl", 'smarty_include_vars' => array('pager' => $this->_tpl_vars['users_list']['pager'],'script' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>

<script>
<?php echo '
function sortByField(field, sorder) {
	$(\'#sortBy\').val(field);
	$(\'#sortOrder\').val(sorder);
	$(\'#searchForm\').submit();
}
'; ?>

</script>