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
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("news.php")'/>

<form action="news.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intNewsID" id="intNewsID" value="{$data.intNewsID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные новости</th></tr></thead>
		<tbody>
			<tr>
				<td>Название<span class="important">*</span></td>
				<td><input type="text" id="varTitle" name="varTitle" value="{$data.varTitle|escape}" size="122" /></td>
			</tr>
            <tr>
				<td >Дата и время редактирования</td>
				<td>Дата {html_select_date field_order=DMY prefix="varDate" time=$data.varDate start_year="2010" end_year="+5" month_format=%m}
					<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateYear,document.editForm.varDateMonth,document.editForm.varDateDay,false,false,this);"/> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Время {html_select_time time=$data.varDate prefix="varDate"}
               </td>
			</tr>
			<tr>
				<td >Аннотация</td>
				<td><textarea id="varAnnotation" name="varAnnotation" cols="120">{$data.varAnnotation}</textarea></td>
			</tr>
			<tr>
				<td >Meta Title</td>
				<td><textarea id="varMetaTitle" name="varMetaTitle" cols="120">{$data.varMetaTitle}</textarea></td>
			</tr>
			<tr>
				<td >Meta Keywords</td>
				<td><textarea id="varMetaKeywords" name="varMetaKeywords" cols="120">{$data.varMetaKeywords}</textarea></td>
			</tr>
			<tr>
				<td >Meta description</td>
				<td><textarea id="varMetaDescription" name="varMetaDescription" cols="120">{$data.varMetaDescription}</textarea></td>
			</tr>
			<tr>
				<td >Баннерная зона</td>
				<td>
					<select name="intBannerZoneID[]" multiple="multiple" style="width: 100%;">
						{foreach from=$banners_main_list item=item}
						<option value="{$item.intBannerZoneID}"{foreach from=$banners_to_modules item=it}{if $item.intBannerZoneID==$it.intBannerZoneID} selected="selected"{/if}{/foreach}>{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td >Фотогалерея</td>
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
				<td colspan="2"><textarea  class="ckeditor" id="varDescription" name="varDescription" cols="120">{$data.varDescription}</textarea></td>
			</tr>
			<tr>
				<td>Отображать на Главной</td>
				<td><input style="float:left" type="checkbox" id="intShowHome" name="intShowHome" value="1"{if $data.intShowHome=='1' || !$data.intNewsID} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td >Активна</td>
				<td><input style="float:left" type="checkbox" id="intActive" name="intActive" value="1"{if $data.intActive=='1' || !$data.intNewsID} checked="checked"{/if} /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>