{literal}
<script type="text/javascript">
	var json_tbl_regions_list = '';	
	var json_regions_list = '';
	var json_countries_list = '';
	function SaveForm() {
		$('#event').val('save');
		$('#intGalleryID option').css('display',''); 
		$('#editForm').submit();
	}
</script>
{/literal}

<div id="json_tbl_regions_list" style="display: none;">{$json_tbl_regions_list}</div>
<div id="json_countries_list" style="display: none;">{$json_countries_list}</div>
<div id="json_regions_list" style="display: none;">{$json_regions_list}</div>
<input type="hidden" id="curMTCityID" value="{$data.intMTCityID}" />

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("regions_catalog.php")'/>

<form action="regions_catalog.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intRegionID" id="intRegionID" value="{$data.intRegionID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные региона</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Название</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName|escape}" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Ссылка (Alias)</td>
				<td><input type="text" id="varUrlAlias" name="varUrlAlias" value="{$data.varUrlAlias}" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Meta Title</td>
				<td><textarea id="varMetaTitle" name="varMetaTitle" cols="120">{$data.varMetaTitle}</textarea></td>
			</tr>
			<tr>
				<td width="140">Meta Keywords</td>
				<td><textarea id="varMetaKeywords" name="varMetaKeywords" cols="120">{$data.varMetaKeywords}</textarea></td>
			</tr>
			<tr>
				<td width="140">Meta description</td>
				<td><textarea id="varMetaDescription" name="varMetaDescription" cols="120">{$data.varMetaDescription}</textarea></td>
			</tr>
			<tr>
				<td width="140">Курорт</td>
				<td>
					<select name="intResortID" id="intResortID">
						{foreach from=$resorts_list item=item}
						<option value="{$item.intResortID}" {if $data.intResortID==$item.intResortID} selected="selected"{/if}>{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td width="140">Фотогалерея</td>
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
				<td width="140">Баннерная зона</td>
				<td>
					<select name="intBannerZoneID[]" multiple="multiple" style="width: 100%;">
						{foreach from=$banners_main_list item=item}
						<option value="{$item.intBannerZoneID}"{foreach from=$banners_to_modules item=it}{if $item.intBannerZoneID==$it.intBannerZoneID} selected="selected"{/if}{/foreach}>{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td>Активный</td>
				<td><input style="float:left" type="checkbox" id="isActive" name="isActive" value="1" {if $data.isActive=='1'} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td colspan="2">Описание</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea class="ckeditor" id="varDescription" name="varDescription" cols="120">{$data.varDescription}</textarea></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>