<script type="text/javascript">
{literal}
	function SaveForm() {
		$('#event').val('save');
		$('#intGalleryID option').css('display',''); 
		$('#editForm').submit();
	}
{/literal}
</script>
<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("other_info.php")'/>

<form action="other_info.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intInfoID" id="intInfoID" value="{$data.intInfoID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные "Общей информации"</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Название</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName|escape}" size="122" /></td>
			</tr>
			<tr>
				<td>Ссылка (Alias)</td>
				<td><input type="text" id="varUrlAlias" name="varUrlAlias" value="{$data.varUrlAlias}" size="122" /></td>
			</tr>
			<tr>
				<td>H1 текст</td>
				<td><input type="text" id="varH1Text" name="varH1Text" value="{$data.varH1Text}" size="122" /></td>
			</tr>
			<tr>
				<td>Meta Title</td>
				<td><textarea id="varPageTitle" name="varPageTitle" cols="120">{$data.varPageTitle}</textarea></td>
			</tr>
			<tr>
				<td>Meta Keywords</td>
				<td><textarea id="varPageKeywords" name="varPageKeywords" cols="120">{$data.varPageKeywords}</textarea></td>
			</tr>
			<tr>
				<td>Meta description</td>
				<td><textarea id="varPageDescription" name="varPageDescription" cols="120">{$data.varPageDescription}</textarea></td>
			</tr>
			<tr>
				<td>Позиция</td>
				<td><input type="text" id="intOrdering" name="intOrdering" value="{$data.intOrdering}" size="122" /></td>
			</tr>
			<tr>
				<td>Страна</td>
				<td>
					<select name="intCountryID" id="intCountryID">
						{foreach from=$countries_list item=item}
						<option value="{$item.intCountryID}" {if $data.intCountryID==$item.intCountryID} selected="selected"{/if}>{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td>Категория</td>
				<td>
					<select name="intCategoryID" id="intCategoryID">
						{foreach from=$category_list item=item}
						<option value="{$item.intCategoryID}" {if $data.intCategoryID==$item.intCategoryID} selected="selected"{/if}>{$item.varName}</option>
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
				<td>Активен</td>
				<td><input style="float:left" type="checkbox" id="isActive" name="isActive" value="1"{if $data.isActive=='1'} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td colspan="2">Описание</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea  class="ckeditor" id="varContent" name="varContent" cols="120">{$data.varContent}</textarea></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>
