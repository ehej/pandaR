<?php /* Smarty version 2.6.19, created on 2017-06-14 16:32:57
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/static_zone.edit.tpl */ ?>
<?php echo '
<script type="text/javascript">
	function SaveForm() {
		$(\'#event\').val(\'save\');
		$(\'#editForm\').submit();
	}
</script>
'; ?>


<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("static_zone.php")'/>

<form action="static_zone.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intSZID" id="intSZID" value="<?php echo $this->_tpl_vars['data']['intSZID']; ?>
" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные администратора</th></tr></thead>
		<tbody>
			<tr>
				<td>Позиция</td>
				<td><select name="varPosition" id="varPosition">
						<?php $_from = $this->_tpl_vars['position']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
						<option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['data']['varPosition'] == $this->_tpl_vars['key']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Вес</td>
				<td><input type="text" id="intOrdering" name="intOrdering" value="<?php echo $this->_tpl_vars['data']['intOrdering']; ?>
" size="122" /></td>
			</tr>
			<tr>
				<td>Текст</td>
				<td><textarea class="ckeditor" id="varText" name="varText" cols="120"><?php echo $this->_tpl_vars['data']['varText']; ?>
</textarea></td>
			</tr>
			<tr>
				<td>Активен</td>
				<td><input  style="float:left;" type="checkbox" id="isActive" name="isActive" value="1"<?php if ($this->_tpl_vars['data']['isActive'] == '1'): ?> checked="checked"<?php endif; ?> /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>