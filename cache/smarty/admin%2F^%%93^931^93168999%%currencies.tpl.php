<?php /* Smarty version 2.6.19, created on 2016-10-28 13:54:05
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/currencies.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_select_date', '/var/www/pandaH/panda.fm/data/templates/admin/currencies.tpl', 24, false),array('modifier', 'date_format', '/var/www/pandaH/panda.fm/data/templates/admin/currencies.tpl', 48, false),)), $this); ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>


<form action="currencies.php" name="editForm" method="POST" id="searchForm">
<input type="hidden" name="event" value="save">
<table class="bordered" width="100%">
	<tr>
		<th>ID</th>
		<th>Название</th>
		<th>Курс</th>
		<th>Обозначение</th>
	</tr>
	<?php $_from = $this->_tpl_vars['roles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
	<tr >
		<td><?php echo $this->_tpl_vars['item']['intCurrencyID']; ?>
</td>
		<td><input type="text" name="varName[<?php echo $this->_tpl_vars['item']['intCurrencyID']; ?>
]" value="<?php echo $this->_tpl_vars['item']['varName']; ?>
"></td>
		<td><input type="text" name="intRate[<?php echo $this->_tpl_vars['item']['intCurrencyID']; ?>
]" value="<?php echo $this->_tpl_vars['item']['intRate']; ?>
"></td>
		<td><input type="text" name="varMark[<?php echo $this->_tpl_vars['item']['intCurrencyID']; ?>
]" value="<?php echo $this->_tpl_vars['item']['varMark']; ?>
"></td>
	</tr>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<tr>
		<td colspan="4">
		<?php echo smarty_function_html_select_date(array('field_order' => 'DMY','prefix' => 'varDate','time' => time(),'start_year' => "+0",'end_year' => "+10",'month_format' => "%m"), $this);?>

		<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateYear,document.editForm.varDateMonth,document.editForm.varDateDay,false,false,this);"/>
		<span style="float:right;"><input type="submit" class="iconize" rel="23" value="Сохранить" /></span>
		</td>
	</tr>
</div>
</table>
</form>
<br><hr>
<h2>Архив</h2>
<table class="bordered" width="100%">
	<tr>
		<th>Дата</th>
		<?php $_from = $this->_tpl_vars['roles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<?php if ($this->_tpl_vars['item']['intCurrencyID'] != 1): ?><th><?php echo $this->_tpl_vars['item']['varName']; ?>
</th><?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<th width="50">Действия</th>
	</tr>
	<tr>
	<?php $_from = $this->_tpl_vars['archive']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['archivecurr'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['archivecurr']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['archivecurr']['iteration']++;
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
		<?php if (( $this->_tpl_vars['aid'] != $this->_tpl_vars['item']['intArchiveID'] && ! ($this->_foreach['archivecurr']['iteration'] <= 1) )): ?>
			<td><input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("currencies.php?intArchiveID=<?php echo $this->_tpl_vars['item']['intArchiveID']; ?>
&event=delete", "Вы уверены, что хотите удалить запись с ID=<?php echo $this->_tpl_vars['item']['intArchiveID']; ?>
?")'/></td>
		</tr>
		<tr>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
		<?php endif; ?>
		<?php if (! $this->_tpl_vars['aid']): ?><td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td><?php endif; ?>
		<?php $this->assign('aid', $this->_tpl_vars['item']['intArchiveID']); ?>
		<?php $_from = $this->_tpl_vars['roles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['it']):
?>
			<?php if ($this->_tpl_vars['it']['intCurrencyID'] == $this->_tpl_vars['item']['intCurrencyID'] && $this->_tpl_vars['item']['intCurrencyID'] != 1): ?><td><?php echo $this->_tpl_vars['item']['intRate']; ?>
</td><?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<?php if (($this->_foreach['archivecurr']['iteration'] == $this->_foreach['archivecurr']['total'])): ?><td><input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("currencies.php?intArchiveID=<?php echo $this->_tpl_vars['item']['intArchiveID']; ?>
&event=delete", "Вы уверены, что хотите удалить запись с ID=<?php echo $this->_tpl_vars['item']['intArchiveID']; ?>
?")'/></td><?php endif; ?>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</tr>
</table>
