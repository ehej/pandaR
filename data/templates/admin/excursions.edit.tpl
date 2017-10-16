<script type="text/javascript">
	{literal}
	function SaveForm() {
		$('#event').val('save');
		$('#intGalleryID option').css('display',''); 
		$('#editForm').submit();
	}
	
	function setRegionResort(){
		country = $('#intCountryID option:selected').val();	
		$('#intResortID option').css('display','none');
		$('#intResortID option[rel="'+country+'"]').css('display','');
		$('#intResortID option:selected').each(function(){
			if($(this).css('display')=='none'){
				$(this).removeAttr('selected');
			} 		
		})
		setRegion();		
	}
	function setRegion(){
	
		var resort = $('#intResortID').val();
		$('#intRegionID option').css('display','none');
		if(resort != null){
			$('#intRegionID option').each(function(){
				if(jQuery.inArray($(this).attr('rel'), resort)!=-1){
					$(this).css('display','');			
				}
			})
			$('#intRegionID option:selected').each(function(){
				if($(this).css('display')=='none'){
					$(this).removeAttr('selected');
				} 		
			})
		}
	}
	{/literal}
</script>

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("excursions.php")'/>

<form action="excursions.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intExcursionID" id="intExcursionID" value="{$data.intExcursionID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные экскурсии</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Название</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName|escape}" size="122" /></td>
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
				<td>Прикрепить к стране</td>
				<td>
					<select name="intCountryID[]" style="width: 100%;" id="intCountryID" onchange="setRegionResort()">
						{foreach from=$country_list item=item}
						<option value="{$item.intCountryID}" {if isset($relation_list.country[$item.intCountryID])}selected="selected"{/if}>{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td>Прикрепить к курорту</td>
				<td>
					<select name="intResortID[]" multiple="multiple" style="width: 100%;"  id="intResortID"  onchange="setRegion()">
						{foreach from=$resort_list item=item}
						<option value="{$item.intResortID}" rel="{$item.intCountryID}"  {if isset($relation_list.resort[$item.intResortID])}selected="selected"{/if}>{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>			
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
				<td>Отзывы</td>
				<td><input style="float:left" type="checkbox" id="varShowComments" name="varShowComments" value="1"{if $data.varShowComments=='yes'} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td>Активный</td>
				<td><input style="float:left" type="checkbox" id="isActive" name="isActive" value="1" {if $data.isActive=='1'} checked="checked"{/if} /></td>
			</tr>
			<!--
			<tr>
				<td>Регион (Мастер-тур)</td>
				<td>
					<select name="intMTCityID" id="intMTCityID"></select>
				</td>
			</tr>
			-->
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