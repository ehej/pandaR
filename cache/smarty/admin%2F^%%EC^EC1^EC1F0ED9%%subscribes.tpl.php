<?php /* Smarty version 2.6.19, created on 2016-11-11 13:16:30
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/subscribes.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '/var/www/pandaH/panda.fm/data/templates/admin/subscribes.tpl', 22, false),)), $this); ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("subscribes.edit.php")'/>

<form action="subscribes.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['sortOrder']; ?>
"/>
<input type="hidden" name="sortBy" id="sortBy" value="<?php echo $this->_tpl_vars['sortBy']; ?>
"/>
<div align="right">
	<input type="text" name="varEmail" id="varTitle" class="titled" value="<?php echo $this->_tpl_vars['filter']['LIKEvarEmail']; ?>
" title="E-mail" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varDateAdd','text' => 'Дата добавления','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varEmail','text' => 'E-mail','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'isActive','text' => 'Активен','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>		
		<th width="100">Действия</th>
	</tr>
	<?php $_from = $this->_tpl_vars['subscribes_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
	<tr onDblClick='window.location="subscribes.edit.php?intSubscribeID=<?php echo $this->_tpl_vars['item']['intSubscribeID']; ?>
"'>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDateAdd'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y %H:%M') : smarty_modifier_date_format($_tmp, '%d.%m.%Y %H:%M')); ?>
</td>
		<td><?php echo $this->_tpl_vars['item']['varEmail']; ?>
</td>
		<td><?php if ($this->_tpl_vars['item']['isActive'] == 1): ?>Да<?php else: ?>Нет<?php endif; ?></td>
		<td nowrap="nowrap"><input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("subscribes.edit.php?intSubscribeID=<?php echo $this->_tpl_vars['item']['intSubscribeID']; ?>
")'/>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("subscribes.php?intSubscribeID=<?php echo $this->_tpl_vars['item']['intSubscribeID']; ?>
&event=delete", "Вы уверены, что хотите удалить запись с ID=<?php echo $this->_tpl_vars['item']['intSubscribesID']; ?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "scroller.tpl", 'smarty_include_vars' => array('pager' => $this->_tpl_vars['subscribes_list']['pager'],'script' => 1)));
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