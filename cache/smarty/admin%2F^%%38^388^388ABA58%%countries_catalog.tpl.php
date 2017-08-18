<?php /* Smarty version 2.6.19, created on 2016-11-02 13:26:10
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/countries_catalog.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', '/var/www/pandaH/panda.fm/data/templates/admin/countries_catalog.tpl', 27, false),)), $this); ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("countries_catalog.edit.php")'/>

<form action="countries_catalog.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['sortOrder']; ?>
"/>
<input type="hidden" name="sortBy" id="sortBy" value="<?php echo $this->_tpl_vars['sortBy']; ?>
"/>
<input type="hidden" name="event" id="event" value=""/>
<div align="right">
	<input type="button" value="Сохранить порядок" class="iconize" rel="82" onclick="saveOrder()"/>
	<input type="text" name="varName" id="varName" class="titled" value="<?php echo $this->_tpl_vars['filter']['LIKEvarName']; ?>
" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>
<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th width="300"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varName','text' => 'Название страны','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th>Ссылка</th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'isActive','text' => 'Активен','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th width="50"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'intOrder','text' => 'Порядок','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th>Действия</th>
	</tr>
	<?php $_from = $this->_tpl_vars['countries_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
	<tr onDblClick='javascript:Go("countries_catalog.edit.php?intCountryID=<?php echo $this->_tpl_vars['item']['intCountryID']; ?>
)"'>
		<td><?php echo $this->_tpl_vars['item']['varName']; ?>
</td>
		<td nowrap="nowrap"><a href="<?php echo $this->_tpl_vars['item']['link']; ?>
" target="_blank"><?php echo $this->_tpl_vars['item']['link']; ?>
</a></td>
		<td><?php if ($this->_tpl_vars['item']['isActive'] == 1): ?>Да<?php else: ?>Нет<?php endif; ?></td>
		<td><input style="width: 40px" name="order[<?php echo $this->_tpl_vars['item']['intCountryID']; ?>
]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['intOrder'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
"/></td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("countries_catalog.edit.php?intCountryID=<?php echo $this->_tpl_vars['item']['intCountryID']; ?>
")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("countries_catalog.php?intCountryID=<?php echo $this->_tpl_vars['item']['intCountryID']; ?>
&event=delete", "Вы уверены, что хотите удалить запись с ID=<?php echo $this->_tpl_vars['item']['intCountryID']; ?>
?")'/>
			<input type="button" class="iconize" rel="52" value="Меню страны" onclick='javascript:Go("catalog_menu.php?intCountryID=<?php echo $this->_tpl_vars['item']['intCountryID']; ?>
")'/>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "scroller.tpl", 'smarty_include_vars' => array('pager' => $this->_tpl_vars['countries_list']['pager'],'script' => 1)));
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
function saveOrder() {
	$(\'#event\').val(\'saveorder\');
	$(\'#searchForm\').submit();
}
'; ?>

</script>