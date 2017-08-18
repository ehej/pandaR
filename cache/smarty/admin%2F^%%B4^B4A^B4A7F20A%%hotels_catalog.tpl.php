<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:24
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/hotels_catalog.tpl */ ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<?php echo '
<script type="text/javascript">
function SaveForm() {
	$(\'#event\').val(\'save\');
}
</script>
'; ?>

<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("hotels_catalog.edit.php")'/>

<form action="hotels_catalog.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="<?php echo $this->_tpl_vars['sortOrder']; ?>
"/>
<input type="hidden" name="sortBy" id="sortBy" value="<?php echo $this->_tpl_vars['sortBy']; ?>
"/>
<input type="hidden" name="event" id="event" value="" />
<div align="right">
	<select name="intCountryID" id="intCountryID" onchange='<?php echo '$("#searchForm").submit();'; ?>
'  style="width: 150px;">
		<option></option>
		<?php $_from = $this->_tpl_vars['countries_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
			<?php if ($this->_tpl_vars['filter']['intCountryID'] == $this->_tpl_vars['key']): ?>
			<option value="<?php echo $this->_tpl_vars['key']; ?>
" selected="selected"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>	
			<?php else: ?>
			<option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>	
			<?php endif; ?>
		<?php endif; ?><?php endforeach; endif; unset($_from); ?>
	</select>
	<?php if ($this->_tpl_vars['resorts_list_filter']): ?>
	<select name="intResortID" id="intResortID" onchange='<?php echo '$("#searchForm").submit();'; ?>
' style="width: 150px;">
		<option></option>
		<?php $_from = $this->_tpl_vars['resorts_list_filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
			<?php if ($this->_tpl_vars['filter']['intResortID'] == $this->_tpl_vars['key']): ?>
			<option value="<?php echo $this->_tpl_vars['key']; ?>
" selected="selected"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>	
			<?php else: ?>
			<option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>	
			<?php endif; ?>
		<?php endif; ?><?php endforeach; endif; unset($_from); ?>
	</select>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['regions_list_filter']): ?>
	<select name="intRegionID" id="intRegionID" onchange='<?php echo '$("#searchForm").submit();'; ?>
' style="width: 150px;">
		<option></option>
		<?php $_from = $this->_tpl_vars['regions_list_filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
			<?php if ($this->_tpl_vars['filter']['intRegionID'] == $this->_tpl_vars['key']): ?>
			<option value="<?php echo $this->_tpl_vars['key']; ?>
" selected="selected"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>	
			<?php else: ?>
			<option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>	
			<?php endif; ?>
		<?php endif; ?><?php endforeach; endif; unset($_from); ?>
	</select>
	<?php endif; ?>
	<input type="text" name="varName" id="varName" class="titled" value="<?php echo $this->_tpl_vars['filter']['LIKEvarName']; ?>
" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
	<input type="button" value="Отменить фильтры" class="iconize" rel="4" onclick='Go("hotels_catalog.php")' name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'varName','text' => 'Название отеля','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'nameResort','text' => 'Курорт','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'nameCountry','text' => 'Страна','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
		<th><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sortlink.tpl', 'smarty_include_vars' => array('field' => 'isActive','text' => 'Активен','sortorder' => $this->_tpl_vars['sortOrder'],'sortby' => $this->_tpl_vars['sortBy'],'script' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></th>
        <th>Ссылка</th>
		<th>Действия</th>
	</tr>
	<?php $_from = $this->_tpl_vars['hotels_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
	<tr onDblClick='javascript:Go("hotels_catalog.edit.php?intHotelID=<?php echo $this->_tpl_vars['item']['intHotelID']; ?>
")'>
		<td><?php echo $this->_tpl_vars['item']['varName']; ?>
</td>
		<td><?php echo $this->_tpl_vars['resorts_list'][$this->_tpl_vars['item']['intResortID']]['varName']; ?>
</td>
		<td><?php echo $this->_tpl_vars['countries_list'][$this->_tpl_vars['item']['intCountryID']]['varName']; ?>
</td>
		<td><?php if ($this->_tpl_vars['item']['isActive'] == 1): ?><span style="color: green;">да</span><?php else: ?><span style="color: red;">нет</span><?php endif; ?></td>
		<td nowrap="nowrap"><a href="<?php echo $this->_tpl_vars['item']['link']; ?>
" target="_blank"><?php echo $this->_tpl_vars['item']['link']; ?>
</a></td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("hotels_catalog.edit.php?intHotelID=<?php echo $this->_tpl_vars['item']['intHotelID']; ?>
")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("hotels_catalog.php?intHotelID=<?php echo $this->_tpl_vars['item']['intHotelID']; ?>
&event=delete", "Вы уверены, что хотите удалить запись с ID=<?php echo $this->_tpl_vars['item']['intHotelID']; ?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "scroller.tpl", 'smarty_include_vars' => array('pager' => $this->_tpl_vars['hotels_list']['pager'],'script' => 1)));
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