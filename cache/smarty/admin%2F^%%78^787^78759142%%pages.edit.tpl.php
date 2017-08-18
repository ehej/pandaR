<?php /* Smarty version 2.6.19, created on 2016-11-03 16:34:25
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/pages.edit.tpl */ ?>
<?php echo '
<script type="text/javascript">
function SaveForm() {
	$(\'#event\').val(\'save\');
	$(\'#intGalleryID option\').css(\'display\',\'\'); 
	$(\'#editForm\').submit();
}
</script>
'; ?>


<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("pages.php")'/>

<form action="pages.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intPageID" id="intPageID" value="<?php echo $this->_tpl_vars['data']['intPageID']; ?>
" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные страницы</th></tr></thead>
		<tbody>
			<tr>
				<td width="140">Активна</td>
				<td><input style="float:left" type="checkbox" id="intActive" name="intActive" value="1"<?php if ($this->_tpl_vars['data']['intActive'] == '1'): ?> checked="checked"<?php endif; ?> /></td>
			</tr>
			<tr>
				<td style="width: 300px;">Название<span class="important">*</span></td>
				<td><input type="text" id="varTitle" name="varTitle" value="<?php echo $this->_tpl_vars['data']['varTitle']; ?>
" size="122" /></td>
			</tr>
			<tr>
				<td>Ссылка (Alias)<span class="important">*</span></td>
				<td><input type="text" id="varUrlAlias" name="varUrlAlias" value="<?php echo $this->_tpl_vars['data']['varUrlAlias']; ?>
" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Meta Title</td>
				<td><textarea id="varMetaTitle" name="varMetaTitle" cols="120"><?php echo $this->_tpl_vars['data']['varMetaTitle']; ?>
</textarea></td>
			</tr>
			<tr>
				<td width="140">Meta Keywords</td>
				<td><textarea id="varMetaKeywords" name="varMetaKeywords" cols="120"><?php echo $this->_tpl_vars['data']['varMetaKeywords']; ?>
</textarea></td>
			</tr>
			<tr>
				<td width="140">Meta description</td>
				<td><textarea id="varMetaDescription" name="varMetaDescription" cols="120"><?php echo $this->_tpl_vars['data']['varMetaDescription']; ?>
</textarea></td>
			</tr>
			<tr>
				<td width="140">Фотогалерея</td>
				<td>
					Фильтр галереи: <input type="text" id="find" onkeyup="finds(this.value, 'intGalleryID');">
					<select name="intGalleryID[]" id="intGalleryID" multiple="multiple" style="width: 100%;">
						<?php $_from = $this->_tpl_vars['galeries_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<option value="<?php echo $this->_tpl_vars['item']['intGalleryID']; ?>
"<?php $_from = $this->_tpl_vars['galleries_to_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['it']):
?><?php if ($this->_tpl_vars['item']['intGalleryID'] == $this->_tpl_vars['it']['intGalleryID']): ?> selected="selected"<?php endif; ?><?php endforeach; endif; unset($_from); ?>><?php echo $this->_tpl_vars['item']['varTitle']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">Описание</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea  class="ckeditor" id="varDescription" name="varDescription" cols="120"><?php echo $this->_tpl_vars['data']['varDescription']; ?>
</textarea></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>