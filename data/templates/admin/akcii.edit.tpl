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
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("akcii.php")'/>

<form action="akcii.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intAkciyID" id="intAkciyID" value="{$data.intAkciyID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные новости</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Название</td>
				<td><input type="text" id="varTitle" name="varTitle" value="{$data.varTitle}" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Аннотация</td>
				<td><textarea id="varAnnotation" name="varAnnotation" cols="120">{$data.varAnnotation}</textarea></td>
			</tr>
			<tr>
				<td width="140">Meta Keywords</td>
				<td><textarea id="varMetaKeywords" name="varMetaKeywords" cols="120">{$data.varMetaKeywords}</textarea></td>
			</tr>
			<tr>
				<td width="140">Meta description</td>
				<td><textarea id="varMetaDescription" name="varMetaDescription" cols="120">{$data.varMetaDescription}</textarea></td>
			</tr>
			{*<tr>
				<td width="140">Конкурс</td>
				<td>
					<select name="intContestID" id="intContestID">
						<option value=""></option>
						{foreach from=$contests item=item}
						<option value="{$item.intContestID}"{if $item.intContestID==$data.intContestID} selected="selected"{/if}>{$item.varTitle}</option>
						{/foreach}
					</select>
				</td>
			</tr>*}
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
				<td colspan="2">Описание</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea class="ckeditor" id="varDescription" name="varDescription" cols="120">{$data.varDescription}</textarea></td>
			</tr>
			<tr>
				<td>Отображать только авторизированным</td>
				<td><input style="float:left" type="checkbox" id="intOnlyAuthorized" name="intOnlyAuthorized" value="1"{if $data.intOnlyAuthorized=='1'} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td width="140">Активна</td>
				<td><input style="float:left" type="checkbox" id="intActive" name="intActive" value="1"{if $data.intActive=='1'} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td width="140">Отзывы</td>
				<td><input style="float:left" type="checkbox" id="varShowComments" name="varShowComments" value="1"{if $data.varShowComments=='yes'} checked="checked"{/if} /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>