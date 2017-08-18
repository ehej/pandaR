<?php /* Smarty version 2.6.19, created on 2017-06-01 16:08:44
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/roles.tpl */ ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("roles.edit.php")'/>

<form action="roles.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['sortOrder']; ?>
"/>
<input type="hidden" name="sortBy" id="sortBy" value="<?php echo $this->_tpl_vars['sortBy']; ?>
"/>
<div align="right">
	<input type="text" name="varRoleName" id="varRoleName" class="titled" value="<?php echo $this->_tpl_vars['filter']['LIKEvarRoleName']; ?>
" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varRoleName','text' => 'Название роли','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th width="100">Действия</th>
	</tr>
	<?php $_from = $this->_tpl_vars['roles_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
	<?php if ($this->_tpl_vars['item']['intRoleID'] != $this->_tpl_vars['DEFAULT_SUPER_ADMIN_ID']): ?>
	<tr onDblClick='window.location="roles.edit.php?intRoleID=<?php echo $this->_tpl_vars['item']['intRoleID']; ?>
"'>
		<td><?php echo $this->_tpl_vars['item']['varRoleName']; ?>
</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("roles.edit.php?intRoleID=<?php echo $this->_tpl_vars['item']['intRoleID']; ?>
")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("roles.php?intRoleID=<?php echo $this->_tpl_vars['item']['intRoleID']; ?>
&event=delete", "Вы уверены, что хотите удалить запись с ID=<?php echo $this->_tpl_vars['item']['intRoleID']; ?>
?")'/></td>
	</tr>
	<?php endif; ?><?php endif; ?>
	<?php endforeach; else: ?>
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	<?php endif; unset($_from); ?>
</table>
<!-- /Таблица -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "scroller.tpl", 'smarty_include_vars' => array('pager' => $this->_tpl_vars['roles_list']['pager'],'script' => 1)));
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