<?php /* Smarty version 2.6.19, created on 2016-11-03 15:41:49
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/pages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', '/var/www/pandaH/panda.fm/data/templates/admin/pages.tpl', 22, false),)), $this); ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("pages.edit.php")'/>

<form action="pages.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['sortOrder']; ?>
"/>
<input type="hidden" name="sortBy" id="sortBy" value="<?php echo $this->_tpl_vars['sortBy']; ?>
"/>
<div align="right">
	<input type="text" name="varTitle" id="varTitle" class="titled" value="<?php echo $this->_tpl_vars['filter']['LIKEvarTitle']; ?>
" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varTitle','text' => 'Название','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th>Ссылка</th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'intActive','text' => 'Отображать','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th width="100">Действия</th>
	</tr>
	<?php $_from = $this->_tpl_vars['pages_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
	<tr onDblClick='window.location="pages.edit.php?intPageID=<?php echo $this->_tpl_vars['item']['intPageID']; ?>
"'>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varTitle'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 70) : smarty_modifier_truncate($_tmp, 70)); ?>
</td>
		<td nowrap="nowrap"><a href="<?php echo $this->_tpl_vars['item']['link']; ?>
" target="_blank"><?php echo $this->_tpl_vars['item']['link']; ?>
</a></td>
		<td style="text-align: center;"><?php if ($this->_tpl_vars['item']['intActive'] == '1'): ?><span style="color: green;">да</span><?php else: ?><span style="color: red;">нет</span><?php endif; ?></td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("pages.edit.php?intPageID=<?php echo $this->_tpl_vars['item']['intPageID']; ?>
")'/>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("pages.php?intPageID=<?php echo $this->_tpl_vars['item']['intPageID']; ?>
&event=delete", "Вы уверены, что хотите удалить запись с ID=<?php echo $this->_tpl_vars['item']['intPageID']; ?>
?")'/>
		</td>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "scroller.tpl", 'smarty_include_vars' => array('pager' => $this->_tpl_vars['pages_list']['pager'],'script' => 1)));
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