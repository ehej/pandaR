<?php /* Smarty version 2.6.19, created on 2016-11-11 13:16:31
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/messages.tpl */ ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("messages.edit.php")'/>

<form action="messages.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['sortOrder']; ?>
"/>
<input type="hidden" name="sortBy" id="sortBy" value="<?php echo $this->_tpl_vars['sortBy']; ?>
"/>
<div align="right">
	<input type="text" name="varSubject" id="varSubject" class="titled" value="<?php echo $this->_tpl_vars['filter']['LIKEvarSubject']; ?>
" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varDate','text' => 'Дата рассылки','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varSubject','text' => 'Тема','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th>Действия</th>
	</tr>
	<?php $_from = $this->_tpl_vars['messages_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
	<tr onDblClick='window.location="messages.edit.php?intMessageID=<?php echo $this->_tpl_vars['item']['intMessageID']; ?>
"'>
		<td><?php if ($this->_tpl_vars['item']['varDate'] != '0000-00-00 00:00:00'): ?><?php echo $this->_tpl_vars['item']['varDate']; ?>
<?php else: ?>еще не рассылалось<?php endif; ?></td>
		<td><?php echo $this->_tpl_vars['item']['varSubject']; ?>
</td>
		<td nowrap="nowrap" width="100">
			<input type="button" class="iconize" rel="50" value="Разослать" onclick='javascript:Go("messages.edit.php?event=send&intMessageID=<?php echo $this->_tpl_vars['item']['intMessageID']; ?>
")'/>
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("messages.edit.php?intMessageID=<?php echo $this->_tpl_vars['item']['intMessageID']; ?>
")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("messages.php?intMessageID=<?php echo $this->_tpl_vars['item']['intMessageID']; ?>
&event=delete", "Вы уверены, что хотите удалить запись с ID=<?php echo $this->_tpl_vars['item']['intMessageID']; ?>
?")'/></td>
	</tr>
	<?php endif; ?>
	<?php endforeach; else: ?>
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	<?php endif; unset($_from); ?>
</table>
<!-- /Таблица -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "scroller.tpl", 'smarty_include_vars' => array('pager' => $this->_tpl_vars['messages_list']['pager'],'script' => 1)));
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