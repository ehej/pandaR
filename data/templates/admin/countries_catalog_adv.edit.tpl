{literal}
<script type="text/javascript">
function SaveForm() {
	$('#event').val('save');
	$('#intGalleryID option').css('display',''); 
	$('#editForm').submit();
}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("countries_catalog_adv.php")'/>

<form action="countries_catalog_adv.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intCountryID" id="intCountryID" value="{$data.intCountryID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные страны</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Название</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Ссылка (Alias)</td>
				<td><input type="text" id="varUrlAlias" name="varUrlAlias" value="{$data.varUrlAlias}" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Алиас</td>
				<td><select name="intParentCountry">
					<option value=""></option>
					{foreach from=$countries_list item=item}
					<option value="{$item.intCountryID}" {if $item.intCountryID==$data.intParentCountry} selected="selected"{/if}>{$item.varName}</option>
					{/foreach}
				</select></td>
			</tr>
			
			<tr>
				<td width="140">H1 текст</td>
				<td><input type="text" id="varH1Text" name="varH1Text" value="{$data.varH1Text}" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Meta Title</td>
				<td><textarea id="varPageTitle" name="varPageTitle" cols="120">{$data.varPageTitle}</textarea></td>
			</tr>
			<tr>
				<td width="140">Meta Keywords</td>
				<td><textarea id="varPageKeywords" name="varPageKeywords" cols="120">{$data.varPageKeywords}</textarea></td>
			</tr>
			<tr>
				<td width="140">Meta description</td>
				<td><textarea id="varPageDescription" name="varPageDescription" cols="120">{$data.varPageDescription}</textarea></td>
			</tr>
			<tr>
				<td width="140">Позиция</td>
				<td><input type="text" id="intOrdering" name="intOrdering" value="{$data.intOrdering}" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Активен</td>
				<td><input style="float:left" type="checkbox" id="isActive" name="isActive" value="1"{if $data.isActive=='1'} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td width="140">Добавить картинку</td>
				<td>
				{if $data.varImage}
					<a href ="{$FILES_URL}{$data.varImage|substr:0:3}/{$data.varImage}" target="_blank">{$data.varImage}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("countries_catalog_adv.edit.php?intCountryID={$data.intCountryID}&varImage={$data.varImage}&event=DeleteImage", "Вы уверены, что хотите удалить данный файл?")'/></td>
				{else}
					<input type="file" name="varImage" id="varImage" />
				{/if}
				</td>
			</tr>
			<tr>
				<td width="140">Добавить флаг</td>
				<td>
				{if $data.varImageFlag}
					<a href ="{$FILES_URL}{$data.varImageFlag|substr:0:3 }/{$data.varImageFlag}" target="_blank">{$data.varImageFlag}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("countries_catalog_adv.edit.php?intCountryID={$data.intCountryID}&varImageFlag={$data.varImageFlag}&event=DeleteImage", "Вы уверены, что хотите удалить данный файл?")'/></td>
				{else}
					<input type="file" name="varImageFlag" id="varImageFlag" />
				{/if}
				</td>
			</tr>
			<tr>
				<td width="140">Добавить карту</td>
				<td>
				{if $data.varImageMap}
					<a href ="{$FILES_URL}{$data.varImageMap|substr:0:3}/{$data.varImageMap}" target="_blank">{$data.varImageMap}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("countries_catalog_adv.edit.php?intCountryID={$data.intCountryID}&varImageMap={$data.varImageMap}&event=DeleteImage", "Вы уверены, что хотите удалить данный файл?")'/></td>
				{else}
					<input type="file" name="varImageMap" id="varImageMap" />
				{/if}
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
				<td colspan="2">Описание</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea  class="ckeditor" id="varDescription" name="varDescription" cols="120">{$data.varDescription}</textarea></td>
			</tr>
			<tr>
				<td colspan="2">Описание на странице страны</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea  class="ckeditor" id="varDescription2" name="varDescription2" cols="120">{$data.varDescription2}</textarea></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>