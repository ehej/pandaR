<?php /* Smarty version 2.6.19, created on 2016-11-03 14:19:13
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/resorts_catalog.edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/pandaH/panda.fm/data/templates/admin/resorts_catalog.edit.tpl', 33, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
	var json_tbl_regions_list = \'\';	
	var json_resorts_list = \'\';
	var json_countries_list = \'\';
	
	function SaveForm() {
		$(\'#event\').val(\'save\');
		$(\'#intGalleryID option\').css(\'display\',\'\'); 
		$(\'#editForm\').submit();
	}	
</script>
'; ?>


<div id="json_tbl_regions_list" style="display: none;"><?php echo $this->_tpl_vars['json_tbl_regions_list']; ?>
</div>
<div id="json_countries_list" style="display: none;"><?php echo $this->_tpl_vars['json_countries_list']; ?>
</div>
<div id="json_resorts_list" style="display: none;"><?php echo $this->_tpl_vars['json_resorts_list']; ?>
</div>
<input type="hidden" id="curMTCityID" value="<?php echo $this->_tpl_vars['data']['intMTCityID']; ?>
" />

<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("resorts_catalog.php")'/>

<form action="resorts_catalog.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intResortID" id="intResortID" value="<?php echo $this->_tpl_vars['data']['intResortID']; ?>
" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные курорта</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Название<span class="important">*</span></td>
				<td><input type="text" id="varName" name="varName" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['varName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Ссылка (Alias)</td>
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
				<td width="140">Страна</td>
				<td>
					<select name="intCountryID" id="intCountryID">
						<?php $_from = $this->_tpl_vars['countries_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<option value="<?php echo $this->_tpl_vars['item']['intCountryID']; ?>
" <?php if ($this->_tpl_vars['data']['intCountryID'] == $this->_tpl_vars['item']['intCountryID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
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
				<td width="140">Баннерная зона</td>
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
				<td>Активный</td>
				<td><input style="float:left" type="checkbox" id="isActive" name="isActive" value="1" <?php if ($this->_tpl_vars['data']['isActive'] == '1'): ?> checked="checked"<?php endif; ?> /></td>
			</tr>
			<tr>
				<td colspan="2">Краткое описание</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea class="ckeditor" id="varShortDescription" name="varShortDescription" cols="120"><?php echo $this->_tpl_vars['data']['varShortDescription']; ?>
</textarea></td>
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