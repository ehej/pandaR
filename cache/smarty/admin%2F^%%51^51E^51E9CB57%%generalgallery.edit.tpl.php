<?php /* Smarty version 2.6.19, created on 2016-11-09 11:35:35
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/generalgallery.edit.tpl */ ?>
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
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("generalgallery.php")'/>

<form action="generalgallery.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intGeneralGalleryID" id="intSZID" value="<?php echo $this->_tpl_vars['data']['intGeneralGalleryID']; ?>
" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные администратора</th></tr></thead>
		<tbody>
			<tr>
				<td>Название<span class="important">*</span></td>
				<td><input type="text" id="varName" name="varName" value="<?php echo $this->_tpl_vars['data']['varName']; ?>
" size="122" /></td>
			</tr>
			<tr>
				<td>Вес</td>
				<td><input type="text" id="intOrder" name="intOrder" value="<?php echo $this->_tpl_vars['data']['intOrder']; ?>
" size="2" /></td>
			</tr>
			<tr>
				<td>Ссылка</td>
				<td><input type="text" id="varLink" name="varLink" value="<?php echo $this->_tpl_vars['data']['varLink']; ?>
" size="122" /></td>
			</tr>
			<tr>
				<td>Картинка</td>
				<td><input type="file" id="varImage" name="varImage" size="90" /></td>
			</tr>
			<?php if ($this->_tpl_vars['data']['varImage']): ?>
			<tr>
				<td>Удалить <input type="checkbox" name="delete_image" value="1"></td>
				<td><img width="500" src="<?php echo $this->_tpl_vars['path']; ?>
<?php echo $this->_tpl_vars['data']['varImage']; ?>
" /></td>
			</tr>
			<?php endif; ?>
			<tr>
				<td>Текст</td>
				<td><textarea  class="ckeditor" id="varDescription" name="varDescription" cols="120"><?php echo $this->_tpl_vars['data']['varDescription']; ?>
</textarea></td>
			</tr>
			<tr>
				<td>Активен</td>
				<td><input  style="float:left;" type="checkbox" id="intPublish" name="intPublish" value="1"<?php if ($this->_tpl_vars['data']['intPublish'] == '1'): ?> checked="checked"<?php endif; ?> /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>