<?php /* Smarty version 2.6.19, created on 2016-11-11 13:16:20
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/static_zone.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', '/var/www/pandaH/panda.fm/data/templates/admin/static_zone.tpl', 31, false),array('modifier', 'mb_substr', '/var/www/pandaH/panda.fm/data/templates/admin/static_zone.tpl', 31, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
function SaveForm() {
	$(\'#event\').val(\'save\');
}
</script>
'; ?>

<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("static_zone.edit.php")'/>

<form action="static_zone.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['sortOrder']; ?>
"/>
<input type="hidden" name="sortBy" id="sortBy" value="<?php echo $this->_tpl_vars['sortBy']; ?>
"/>
<input type="hidden" name="event" id="event" value="" />
<div align="right">
	<input type="text" name="varText" id="varText" class="titled" value="<?php echo $this->_tpl_vars['filter']['LIKEvarText']; ?>
" title="Поиск по тексту" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varPosition','text' => 'Позиция','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varText','text' => 'Текст','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varOrdering','text' => 'Вес','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th width="100">Действия</th>
	</tr>
	<?php $_from = $this->_tpl_vars['static_zone']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['admins'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['admins']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['admins']['iteration']++;
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
	<tr onDblClick='window.location="static_zone.edit.php?intSZID=<?php echo $this->_tpl_vars['item']['intSZID']; ?>
"'>
		<td><?php echo $this->_tpl_vars['position'][$this->_tpl_vars['item']['varPosition']]; ?>
</td>
		<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['varText'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('mb_substr', true, $_tmp, 0, 150, 'UTF8') : mb_substr($_tmp, 0, 150, 'UTF8')); ?>
</td>
		<td style="text-align: center;"><input type="text" name="intOrdering[<?php echo $this->_tpl_vars['item']['intSZID']; ?>
]" size="4" value="<?php echo $this->_tpl_vars['item']['intOrdering']; ?>
" /></td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("static_zone.edit.php?intSZID=<?php echo $this->_tpl_vars['item']['intSZID']; ?>
")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("static_zone.php?intSZID=<?php echo $this->_tpl_vars['item']['intSZID']; ?>
&event=delete", "Вы уверены, что хотите удалить запись с ID=<?php echo $this->_tpl_vars['item']['intSZID']; ?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "scroller.tpl", 'smarty_include_vars' => array('pager' => $this->_tpl_vars['users_list']['pager'],'script' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<input type="submit" onclick="SaveForm()" value="Сохранить порядок" rel="82" class="iconize" style="background-position: 2px -1311px;float:right;">
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