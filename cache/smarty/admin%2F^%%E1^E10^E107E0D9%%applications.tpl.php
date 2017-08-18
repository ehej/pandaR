<?php /* Smarty version 2.6.19, created on 2017-06-14 12:33:18
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/applications.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', '/var/www/pandaH/panda.fm/data/templates/admin/applications.tpl', 25, false),array('modifier', 'date_format', '/var/www/pandaH/panda.fm/data/templates/admin/applications.tpl', 27, false),)), $this); ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
 (всего: <?php echo $this->_tpl_vars['total_items']; ?>
)</h1>

<form action="applications.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['sortOrder']; ?>
"/>
<input type="hidden" name="sortBy" id="sortBy" value="<?php echo $this->_tpl_vars['sortBy']; ?>
"/>

<table class="bordered" width="100%">
	<tr>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'intOrderID','text' => 'ID','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varFIO','text' => 'ФИО','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varTel','text' => 'Телефон','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varMail','text' => 'E-mail','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varComments','text' => 'Комментарий','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varTourName','text' => 'Название тура','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varDateFrom','text' => 'Дата с','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varDateTo','text' => 'Дата по','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th>Действия</th>
	</tr>
	<?php $_from = $this->_tpl_vars['applications_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
	<tr <?php if ($this->_tpl_vars['item']['varStatus'] == 'confirmed'): ?>Подтверждена<?php elseif ($this->_tpl_vars['item']['varStatus'] == 'pending'): ?> style="background:#FFCC99;"<?php elseif ($this->_tpl_vars['item']['varStatus'] == 'denial'): ?> style="background:#FFB6C1;"<?php endif; ?>>
		<td><?php echo $this->_tpl_vars['item']['intOrderID']; ?>
</td>
		<td nowrap><?php echo $this->_tpl_vars['item']['varFIO']; ?>
</td>
		<td nowrap><?php echo $this->_tpl_vars['item']['varTel']; ?>
</td>
		<td nowrap><?php echo $this->_tpl_vars['item']['varMail']; ?>
</td>
		<td nowrap><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varComments'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
		<td nowrap><a href="tours.edit.php?intTourID=<?php echo $this->_tpl_vars['item']['intTourID']; ?>
"><?php echo $this->_tpl_vars['item']['varTourName']; ?>
</a></td>
		<td nowrap><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDateFrom'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</td>
		<td nowrap><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDateTo'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</td>
		<td nowrap="nowrap">
		<input type="button" class="iconize" rel="83" value="" onclick='OnDelete("applications.php?intOrderID=<?php echo $this->_tpl_vars['item']['intOrderID']; ?>
&event=delete", "Вы уверены, что хотите удалить эту заявку?")'/>
		</td>
	</tr>
	<?php endif; ?><?php endforeach; else: ?>
		<tr><td colspan="8" align="center" style="text-align: center">Нет записей</td></tr>
	<?php endif; unset($_from); ?>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "scroller.tpl", 'smarty_include_vars' => array('pager' => $this->_tpl_vars['applications_list']['pager'],'script' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
<?php echo '
<script>
function sortByField(field, sorder) {
	$(\'#sortBy\').val(field);
	$(\'#sortOrder\').val(sorder);
	$(\'#searchForm\').submit();
}
</script>
'; ?>