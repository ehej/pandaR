<?php /* Smarty version 2.6.19, created on 2016-11-14 12:33:58
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/news.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', '/var/www/pandaH/panda.fm/data/templates/admin/news.tpl', 25, false),array('modifier', 'truncate', '/var/www/pandaH/panda.fm/data/templates/admin/news.tpl', 25, false),)), $this); ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("news.edit.php")'/>

<form action="news.php" method="GET" id="searchForm">
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
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varAnnotation','text' => 'Имя','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th>Ссылка</th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'intActive','text' => 'Отображать','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
        <th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'intShowHome','text' => 'На главной','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
        <th>Дата</th>
		<th width="80">Действия</th>
	</tr>
	<?php $_from = $this->_tpl_vars['news_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
	<tr onDblClick='window.location="news.edit.php?intNewsID=<?php echo $this->_tpl_vars['item']['intNewsID']; ?>
"'>
		<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['varTitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 70) : smarty_modifier_truncate($_tmp, 70)); ?>
</td>
		<td><?php echo $this->_tpl_vars['item']['varAnnotation']; ?>
</td>
		<td nowrap="nowrap"><a href="<?php echo $this->_tpl_vars['item']['link']; ?>
" target="_blank"><?php echo $this->_tpl_vars['item']['link']; ?>
</a></td>
		<td style="text-align: center;"><?php if ($this->_tpl_vars['item']['intActive'] == '1'): ?><span style="color: green;">да</span><?php else: ?><span style="color: red;">нет</span><?php endif; ?></td>
        <td style="text-align: center;"><?php if ($this->_tpl_vars['item']['intShowHome'] == '1'): ?><span style="color: green;">да</span><?php else: ?><span style="color: red;">нет</span><?php endif; ?></td>
        <td nowrap="nowrap"><?php echo $this->_tpl_vars['item']['varDate']; ?>
</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="" onclick='javascript:Go("news.edit.php?intNewsID=<?php echo $this->_tpl_vars['item']['intNewsID']; ?>
")'/>
			<input type="button" class="iconize" rel="83" value="" onclick='javascript:OnDelete("news.php?intNewsID=<?php echo $this->_tpl_vars['item']['intNewsID']; ?>
&event=delete", "Вы уверены, что хотите удалить запись с ID=<?php echo $this->_tpl_vars['item']['intNewsID']; ?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "scroller.tpl", 'smarty_include_vars' => array('pager' => $this->_tpl_vars['news_list']['pager'],'script' => 1)));
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