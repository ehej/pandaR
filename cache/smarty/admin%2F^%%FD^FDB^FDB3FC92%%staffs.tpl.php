<?php /* Smarty version 2.6.19, created on 2016-11-03 15:32:09
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/staffs.tpl */ ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("staffs.edit.php")'/>

<form action="staffs.php" method="GET" id="searchForm">
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
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'intStaffID','text' => 'ID','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varName','text' => 'Ф. И. О.','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th>Категория</th>
		<th>Контакты</th>
		<th>Страны</th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varView','text' => 'Опубликовано','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th width="100">Действия</th>
	</tr>
	<?php $_from = $this->_tpl_vars['staffs_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['staffs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['staffs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['staffs']['iteration']++;
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
	<tr onDblClick='window.location="staffs.edit.php?intStaffID=<?php echo $this->_tpl_vars['item']['intStaffID']; ?>
"'>
		<td><?php echo $this->_tpl_vars['item']['intStaffID']; ?>
</td>
		<td><?php echo $this->_tpl_vars['item']['varName']; ?>
</td>
		<td><?php echo $this->_tpl_vars['types_staff'][$this->_tpl_vars['item']['intStaffID']]; ?>
</td>
		<td><?php echo $this->_tpl_vars['contacts'][$this->_tpl_vars['item']['intStaffID']]; ?>
</td>
		<td><?php echo $this->_tpl_vars['countries_staff'][$this->_tpl_vars['item']['intStaffID']]; ?>
</td>
		<td><?php if ($this->_tpl_vars['item']['varView'] == 'yes'): ?>Да<?php else: ?>Нет<?php endif; ?></td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("staffs.edit.php?intStaffID=<?php echo $this->_tpl_vars['item']['intStaffID']; ?>
")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("staffs.php?intStaffID=<?php echo $this->_tpl_vars['item']['intStaffID']; ?>
&event=delete", "Вы уверены, что хотите удалить запись с ID=<?php echo $this->_tpl_vars['item']['intStaffID']; ?>
?")'/></td>
	</tr>
	<?php endif; ?><?php endforeach; else: ?>
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	<?php endif; unset($_from); ?>
</table>
<!-- /Таблица -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "scroller.tpl", 'smarty_include_vars' => array('pager' => $this->_tpl_vars['staffs_list']['pager'],'script' => 1)));
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