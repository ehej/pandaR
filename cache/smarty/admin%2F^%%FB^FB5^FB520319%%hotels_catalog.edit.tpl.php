<?php /* Smarty version 2.6.19, created on 2016-10-27 12:56:15
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/hotels_catalog.edit.tpl */ ?>
<script type="text/javascript">
<?php echo '
	var json_tbl_regions_list = \'\';	
	var json_regions_list = \'\';
	var json_countries_list = \'\';
	var json_tbl_hotels_list = \'\';
	var json_hotels_list = \'\';
	
	$(document).ready(function() {					
		setRegionResort();
	});

	function setRegionResort(){
		if(!$(\'#intCountryID option:selected\')){
			$(\'#intCountryID option:visible:first\').attr(\'selected\',true);	
		}
		if ( $.browser.msie ) {
			country = $(\'#intCountryID option:selected\').val();
			
				
			$(\'#intResortID option\').attr(\'disabled\',true);
			$(\'#intResortID option[rel="\'+country+\'"]\').attr(\'disabled\',false);

			if($(\'#intResortID option:selected\').attr(\'disabled\')==true){
				$(\'#intResortID option[rel="\'+country+\'"]:visible:first\').attr(\'selected\',true);
			}
		 } else {
		 	country = $(\'#intCountryID option:selected\').val();
			
			$(\'#intResortID option\').css(\'display\',\'none\');
			$(\'#intResortID option[rel="\'+country+\'"]\').css(\'display\',\'\');

			if($(\'#intResortID option:selected\').css(\'display\')==\'none\'){
				$(\'#intResortID option[rel="\'+country+\'"]:visible:first\').attr(\'selected\',true);
			}
		 }
		 setRegion();
	}
	function setRegion(){
		resort = $(\'#intResortID\').val();
		if ( $.browser.msie ) {
			$(\'#intRegionID option\').attr(\'disabled\',true);
			$(\'#intRegionID option[rel="\'+resort+\'"]\').attr(\'disabled\',false);
			if($(\'#intRegionID option:selected\').css(\'disabled\')==true){
				$(\'#intRegionID option[rel="\'+resort+\'"]:visible:first\').attr(\'selected\',true);
			}
		}else{
			$(\'#intRegionID option\').css(\'display\',\'none\');
			$(\'#intRegionID option[rel="\'+resort+\'"]\').css(\'display\',\'\');
			if($(\'#intRegionID option:selected\').css(\'display\')==\'none\'){
				$(\'#intRegionID option[rel="\'+resort+\'"]:visible:first\').attr(\'selected\',true);
			}
		}
	}

	function SaveForm() {
		$(\'#event\').val(\'save\');
		$(\'#intGalleryID option\').css(\'display\',\'\'); 
		$(\'#editForm\').submit();
	}
'; ?>

</script>


<div id="json_tbl_regions_list" style="display: none;"><?php echo $this->_tpl_vars['json_tbl_regions_list']; ?>
</div>
<div id="json_countries_list" style="display: none;"><?php echo $this->_tpl_vars['json_countries_list']; ?>
</div>
<div id="json_tbl_hotels_list" style="display: none;"><?php echo $this->_tpl_vars['json_tbl_hotels_list']; ?>
</div>
<div id="json_hotels_list" style="display: none;"><?php echo $this->_tpl_vars['json_hotels_list']; ?>
</div>
<div id="json_regions_list" style="display: none;"><?php echo $this->_tpl_vars['json_regions_list']; ?>
</div>

<input type="hidden" id="curMTHotels" value="<?php echo $this->_tpl_vars['data']['intMTHotels']; ?>
" />

<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("hotels_catalog.php")'/>	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>

<form action="hotels_catalog.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intHotelID" id="intHotelID" value="<?php echo $this->_tpl_vars['data']['intHotelID']; ?>
" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные отеля</th></tr></thead>
		<tbody>
			<tr>
				<td>Активный</td>
				<td><input style="float:left" type="checkbox" id="isActive" name="isActive" value="1" <?php if ($this->_tpl_vars['data']['isActive'] == '1'): ?> checked="checked"<?php endif; ?> /></td>
			</tr>
			<tr>
				<td style="width: 300px;">Название<span class="important">*</span></td>
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
				<td>Звездность</td>
				<td><?php $_from = $this->_tpl_vars['stars']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><label><input type="radio" name="varCountStars" value="<?php echo $this->_tpl_vars['key']; ?>
"<?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['data']['varCountStars']): ?>checked="checked"<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;</label><?php endforeach; endif; unset($_from); ?></td>
			</tr>
			<tr>
				<td>Питание</td>
				<td>
					<select name="intFoodTypeID">
						<?php $_from = $this->_tpl_vars['foodtypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<option <?php if ($this->_tpl_vars['item']['intFoodTypeID'] == $this->_tpl_vars['data']['intFoodTypeID']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['intFoodTypeID']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Размещение</td>
				<td>
					<select name="intPlaceTypeID">
						<?php $_from = $this->_tpl_vars['placetypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<option <?php if ($this->_tpl_vars['item']['intPlaceTypeID'] == $this->_tpl_vars['data']['intPlaceTypeID']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['intPlaceTypeID']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Страна</td>
				<td>
				 	<select name="intCountryID" id="intCountryID" onchange="setRegionResort()">
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
				<td>Курорт</td>
				<td>
					<select name="intResortID" id="intResortID"  onchange="setRegion()">

					<?php $_from = $this->_tpl_vars['resorts_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<option value="<?php echo $this->_tpl_vars['item']['intResortID']; ?>
" rel="<?php echo $this->_tpl_vars['item']['intCountryID']; ?>
" <?php if ($this->_tpl_vars['data']['intResortID'] == $this->_tpl_vars['item']['intResortID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
			<!--tr>
				<td>Регион</td>
				<td>
					<select name="intRegionID" id="intRegionID">
					<?php $_from = $this->_tpl_vars['regions_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<option value="<?php echo $this->_tpl_vars['item']['intRegionID']; ?>
" rel="<?php echo $this->_tpl_vars['item']['intResortID']; ?>
" <?php if ($this->_tpl_vars['data']['intRegionID'] == $this->_tpl_vars['item']['intRegionID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr-->
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
				<td>Цена от</td>
				<td><input type="text" id="varPriceAt" name="varPriceAt" value="<?php echo $this->_tpl_vars['data']['varPriceAt']; ?>
" size="13" />
					<select name="intCurrencyID">
						<?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<option <?php if ($this->_tpl_vars['data']['intCurrencyID'] == $this->_tpl_vars['item']['intCurrencyID']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['intCurrencyID']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
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