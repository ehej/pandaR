<script type="text/javascript">
{literal}
	var json_tbl_regions_list = '';	
	var json_regions_list = '';
	var json_countries_list = '';
	var json_tbl_hotels_list = '';
	var json_hotels_list = '';
	
	$(document).ready(function() {					
		setRegionResort();
	});

	function setRegionResort(){
		if(!$('#intCountryID option:selected')){
			$('#intCountryID option:visible:first').attr('selected',true);	
		}
		if ( $.browser.msie ) {
			country = $('#intCountryID option:selected').val();
			
				
			$('#intResortID option').attr('disabled',true);
			$('#intResortID option[rel="'+country+'"]').attr('disabled',false);

			if($('#intResortID option:selected').attr('disabled')==true){
				$('#intResortID option[rel="'+country+'"]:visible:first').attr('selected',true);
			}
		 } else {
		 	country = $('#intCountryID option:selected').val();
			
			$('#intResortID option').css('display','none');
			$('#intResortID option[rel="'+country+'"]').css('display','');

			if($('#intResortID option:selected').css('display')=='none'){
				$('#intResortID option[rel="'+country+'"]:visible:first').attr('selected',true);
			}
		 }
		 setRegion();
	}
	function setRegion(){
		resort = $('#intResortID').val();
		if ( $.browser.msie ) {
			$('#intRegionID option').attr('disabled',true);
			$('#intRegionID option[rel="'+resort+'"]').attr('disabled',false);
			if($('#intRegionID option:selected').css('disabled')==true){
				$('#intRegionID option[rel="'+resort+'"]:visible:first').attr('selected',true);
			}
		}else{
			$('#intRegionID option').css('display','none');
			$('#intRegionID option[rel="'+resort+'"]').css('display','');
			if($('#intRegionID option:selected').css('display')=='none'){
				$('#intRegionID option[rel="'+resort+'"]:visible:first').attr('selected',true);
			}
		}
	}

	function SaveForm() {
		$('#event').val('save');
		$('#intGalleryID option').css('display',''); 
		$('#editForm').submit();
	}
{/literal}
</script>


<div id="json_tbl_regions_list" style="display: none;">{$json_tbl_regions_list}</div>
<div id="json_countries_list" style="display: none;">{$json_countries_list}</div>
<div id="json_tbl_hotels_list" style="display: none;">{$json_tbl_hotels_list}</div>
<div id="json_hotels_list" style="display: none;">{$json_hotels_list}</div>
<div id="json_regions_list" style="display: none;">{$json_regions_list}</div>

<input type="hidden" id="curMTHotels" value="{$data.intMTHotels}" />

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("hotels_catalog.php")'/>	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>

<form action="hotels_catalog.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intHotelID" id="intHotelID" value="{$data.intHotelID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные отеля</th></tr></thead>
		<tbody>
			<tr>
				<td>Активный</td>
				<td><input style="float:left" type="checkbox" id="isActive" name="isActive" value="1" {if $data.isActive=='1'} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td style="width: 300px;">Название<span class="important">*</span></td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="122" /></td>
			</tr>
			<tr>
				<td>Ссылка (Alias)<span class="important">*</span></td>
				<td><input type="text" id="varUrlAlias" name="varUrlAlias" value="{$data.varUrlAlias}" size="122" /></td>
			</tr>
			<tr>
				<td>Meta Title</td>
				<td><textarea id="varMetaTitle" name="varMetaTitle" cols="120">{$data.varMetaTitle}</textarea></td>
			</tr>
			<tr>
				<td>Meta Keywords</td>
				<td><textarea id="varMetaKeywords" name="varMetaKeywords" cols="120">{$data.varMetaKeywords}</textarea></td>
			</tr>
			<tr>
				<td>Meta description</td>
				<td><textarea id="varMetaDescription" name="varMetaDescription" cols="120">{$data.varMetaDescription}</textarea></td>
			</tr>
			<tr>
				<td>Звездность</td>
				<td>{foreach from=$stars key=key item=item}<label><input type="radio" name="varCountStars" value="{$key}"{if $key==$data.varCountStars}checked="checked"{/if}>{$item}&nbsp;&nbsp;&nbsp;&nbsp;</label>{/foreach}</td>
			</tr>
			<tr>
				<td>Питание</td>
				<td>
					<select name="intFoodTypeID">
						{foreach from=$foodtypes item=item}
						<option {if $item.intFoodTypeID==$data.intFoodTypeID}selected="selected"{/if} value="{$item.intFoodTypeID}">{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td>Размещение</td>
				<td>
					<select name="intPlaceTypeID">
						{foreach from=$placetypes item=item}
						<option {if $item.intPlaceTypeID==$data.intPlaceTypeID}selected="selected"{/if} value="{$item.intPlaceTypeID}">{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td>Страна</td>
				<td>
				 	<select name="intCountryID" id="intCountryID" onchange="setRegionResort()">
					{foreach from=$countries_list item=item}
						<option value="{$item.intCountryID}" {if $data.intCountryID == $item.intCountryID} selected="selected"{/if}>{$item.varName}</option>
					{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td>Курорт</td>
				<td>
					<select name="intResortID" id="intResortID"  onchange="setRegion()">

					{foreach from=$resorts_list item=item}
						<option value="{$item.intResortID}" rel="{$item.intCountryID}" {if $data.intResortID == $item.intResortID} selected="selected"{/if}>{$item.varName}</option>
					{/foreach}
					</select>
				</td>
			</tr>
			<!--tr>
				<td>Регион</td>
				<td>
					<select name="intRegionID" id="intRegionID">
					{foreach from=$regions_list item=item}
						<option value="{$item.intRegionID}" rel="{$item.intResortID}" {if $data.intRegionID == $item.intRegionID} selected="selected"{/if}>{$item.varName}</option>
					{/foreach}
					</select>
				</td>
			</tr-->
			<tr>
				<td>Фотогалерея</td>
				<td>
					Фильтр галереи: <input type="text" id="find" onkeyup="finds(this.value, 'intGalleryID');">
					<select name="intGalleryID[]" id="intGalleryID" multiple="multiple" style="width: 100%;">
						{foreach from=$galeries_list item=item}
						<option value="{$item.intGalleryID}"{foreach from=$galleries_to_modules item=it}{if $item.intGalleryID==$it.intGalleryID} selected="selected"{/if}{/foreach}>{$item.varTitle}</option>
						{/foreach}
					</select>
					
				</td>
			</tr>
			<tr>
				<td>Баннерная зона</td>
				<td>
					<select name="intBannerZoneID[]" multiple="multiple" style="width: 100%;">
						{foreach from=$banners_main_list item=item}
						<option value="{$item.intBannerZoneID}"{foreach from=$banners_to_modules item=it}{if $item.intBannerZoneID==$it.intBannerZoneID} selected="selected"{/if}{/foreach}>{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td>Цена от</td>
				<td><input type="text" id="varPriceAt" name="varPriceAt" value="{$data.varPriceAt}" size="13" />
					<select name="intCurrencyID">
						{foreach from=$currencies item=item}
						<option {if $data.intCurrencyID==$item.intCurrencyID}selected="selected"{/if} value="{$item.intCurrencyID}">{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">Описание</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea  class="ckeditor" id="varDescription" name="varDescription" cols="120">{$data.varDescription}</textarea></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>