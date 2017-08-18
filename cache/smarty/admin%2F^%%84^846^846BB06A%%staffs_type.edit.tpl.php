<?php /* Smarty version 2.6.19, created on 2017-06-01 16:22:02
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/staffs_type.edit.tpl */ ?>
<?php echo '
<script type="text/javascript" src="/fckeditor/fckeditor.js?v=1.0"></script>
<script type="text/javascript" src="/ckfinder/ckfinder.js?v=1.0"></script>
<script type="text/javascript">
	function SaveForm() {
		$(\'#event\').val(\'save\');
		$(\'#editForm\').submit();
	}
</script>
'; ?>


<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("staffs_type.php")'/>

<form action="staffs_type.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intTypeID" id="intTypeID" value="<?php echo $this->_tpl_vars['data']['intTypeID']; ?>
" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные категории новостей</th></tr></thead>
		<tbody>
			<tr>
				<td width="140">Название<span class="important">*</span></td>
				<td><input type="text" id="varNameType" name="varNameType" value="<?php echo $this->_tpl_vars['data']['varNameType']; ?>
" size="122" /></td>
			</tr>
			<tr>
				<td>Вес</td>
				<td><input type="text" id="intOrdering" name="intOrdering" value="<?php echo $this->_tpl_vars['data']['intOrdering']; ?>
" size="122" /></td>
			</tr>
			<tr>
				<td>Активна</td>
				<td><input style="float:left" type="checkbox" id="isActive" name="isActive" value="Yes" <?php if ($this->_tpl_vars['data']['isActive'] == 'Yes'): ?> checked="checked"<?php endif; ?> /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>