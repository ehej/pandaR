<?php /* Smarty version 2.6.19, created on 2016-11-02 13:26:19
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/countries_catalog.edit.tpl */ ?>
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
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("countries_catalog.php")'/>
<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>

<form action="countries_catalog.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intCountryID" id="intCountryID" value="<?php echo $this->_tpl_vars['data']['intCountryID']; ?>
" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные страны</th></tr></thead>
		<tbody>
			<tr>
				<td>Активный</td>
				<td><input style="float:left" type="checkbox" id="isActive" name="isActive" value="1" <?php if ($this->_tpl_vars['data']['isActive'] == '1'): ?> checked="checked"<?php endif; ?> /></td>
			</tr>
			<tr>
				<td>Название<span class="important">*</span></td>
				<td><input type="text" id="varName" name="varName" value="<?php echo $this->_tpl_vars['data']['varName']; ?>
" size="122" /></td>
			</tr>
			<tr>
				<td>Ссылка (Alias)<span class="important">*</span></td>
				<td><input type="text" id="varUrlAlias" name="varUrlAlias" value="<?php echo $this->_tpl_vars['data']['varUrlAlias']; ?>
" size="122" /></td>
			</tr>
			<tr>
				<td>Meta Title</td>
				<td><textarea id="varMetaTitle" name="varMetaTitle" cols="120"><?php echo $this->_tpl_vars['data']['varMetaTitle']; ?>
</textarea></td>
			</tr>
			<tr>
				<td>Meta Keywords</td>
				<td><textarea id="varMetaKeywords" name="varMetaKeywords" cols="120"><?php echo $this->_tpl_vars['data']['varMetaKeywords']; ?>
</textarea></td>
			</tr>
			<tr>
				<td>Meta description</td>
				<td><textarea id="varMetaDescription" name="varMetaDescription" cols="120"><?php echo $this->_tpl_vars['data']['varMetaDescription']; ?>
</textarea></td>
			</tr>
			<tr>
				<td>Фотогалерея</td>
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
				<td>Баннерная зона</td>
				<td>
					<select name="intBannerZoneID[]" multiple="multiple" style="width: 100%;">
						<?php $_from = $this->_tpl_vars['banners_main_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<option value="<?php echo $this->_tpl_vars['item']['intBannerZoneID']; ?>
"<?php $_from = $this->_tpl_vars['banners_to_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['it']):
?><?php if ($this->_tpl_vars['item']['intBannerZoneID'] == $this->_tpl_vars['it']['intBannerZoneID']): ?> selected="selected"<?php endif; ?><?php endforeach; endif; unset($_from); ?>><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Добавить флаг<span class="important">*</span></td>
				<td>
				<?php if ($this->_tpl_vars['data']['varFlag']): ?>
					<a href ="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['data']['varFlag']; ?>
"><?php echo $this->_tpl_vars['data']['varRealFlagName']; ?>
</a>
					<input type="button" class="iconize" rel="83" id="varFlag" value="Удалить" onclick='javascript:OnDelete("countries_catalog.edit.php?intCountryID=<?php echo $this->_tpl_vars['data']['intCountryID']; ?>
&varFlag=<?php echo $this->_tpl_vars['data']['varFlag']; ?>
&event=deleteFlag", "Вы уверены, что хотите удалить данный файл?")'/></td>
				<?php else: ?>
					<input type="file" name="varFlag" id="varFlag" />
				<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">Описание</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea class="ckeditor" id="varDescription" name="varDescription" cols="120"><?php echo $this->_tpl_vars['data']['varDescription']; ?>
</textarea></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>