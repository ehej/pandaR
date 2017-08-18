<?php /* Smarty version 2.6.19, created on 2017-08-15 13:51:59
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/foodtypes.tpl */ ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>


<form action="foodtypes.php" method="POST" id="searchForm">
<input type="hidden" name="event" value="save">
<table class="bordered" width="100%">
<!-- Таблица -->

	<tr>
		<th width="20">ID</th>
		<th>Название</th>
		<th width="80">Действия</th>
	</tr>
	<tr>
		<td colspan="2"><span class="important">*</span><input type="text" name="varName" value="" style="width: 95%;"></td>
		<td><input type="submit" class="iconize" rel="23" value="Добавить" o/></td>
	</tr>
	<?php $_from = $this->_tpl_vars['roles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
	<tr >
		<td><?php echo $this->_tpl_vars['item']['intFoodTypeID']; ?>
</td>
		<td><?php echo $this->_tpl_vars['item']['varName']; ?>
</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("foodtypes.php?intFoodTypeID=<?php echo $this->_tpl_vars['item']['intFoodTypeID']; ?>
&event=delete", "Вы уверены, что хотите удалить запись с ID=<?php echo $this->_tpl_vars['item']['intFoodTypeID']; ?>
?")'/>
		</td>
	</tr>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
</table>
<!-- /Таблица -->
</form>