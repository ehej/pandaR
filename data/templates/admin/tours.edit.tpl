<h1>{$pagetitle}</h1>

<form action="tours.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">

<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("tours.php")'/>
<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>

<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intTourID" id="intTourID" value="{$data.intTourID}" />

<table class="bordered" width="100%">
<thead><tr><th colspan="2">Данные страницы</th></tr></thead>
<tbody>
	<tr>
		<td colspan="2">
			<div style="float: left;width: 200px;">
				<label style="cursor: pointer;">Отображать <input style="float:left" type="checkbox" id="isVisible" name="isVisible" value="1"{if $data.isVisible=='1'} checked="checked"{/if} /></label>
			</div>
			<div style="float: left;width: 200px;">
				<label style="cursor: pointer;">Спец. предложение <input style="float:left" type="checkbox" id="isSpecial" name="isSpecial" value="1"{if $data.isSpecial=='1'} checked="checked"{/if} /></label>
			</div>
			<div style="float: left;width: 200px;">
				<label style="cursor: pointer;">На главную <input style="float:left" type="checkbox" id="isIndex" name="isIndex" value="1"{if $data.isIndex=='1'} checked="checked"{/if} /></label>
			</div>
		</td>
	</tr>	
	<tr>
		<td>Название<span class="important">*</span></td>
		<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="122" /></td>
	</tr>
	<tr>
		<td width="140">Тип</td>
		<td>
		<select name="intTypeID[]" id="intTypeID" multiple="multiple" size="7" style="width: 300px;">
			<option value="0" disabled>-----Выберите тип-----</option>
			{foreach from=$types_list item=item}
				<option value="{$item.intTypeID}"{if in_array($item.intTypeID,$data.intTypeID)} selected="selected"{/if}>{$item.varName}</option>
			{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td width="140">Страна</td>
		<td><select name="intCountryID[]" id="intCountryID" multiple="multiple" size="7" style="width: 300px;">
				<option value="0" disabled>-----Выберите страну-----</option>
				{foreach from=$countries_list item=item}
					<option value="{$item.intCountryID}" {if in_array($item.intCountryID,$data.intCountryID)}selected{/if}>{$item.varName}</option>
				{/foreach}
			</select></td>
	</tr>
	<tr>
		<td>Курорт</td>
		<td>
			<select name="intResortID[]" id="intResortID" multiple="multiple" size="7" style="width: 300px;">
				<option value="0" disabled>-----Выберите курорт-----</option>
				{foreach from=$resorts_list item=item}
				<option {if in_array($item.intResortID,$data.intResortID)}selected="selected"{/if} value="{$item.intResortID}" rel="{$item.intCountryID}">{$item.varName}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td>Отель</td>
		<td>
			<select name="intHotelID" id="intHotelID" size="7" style="width: 300px;">
				<option value="-1">-----Выберите отель-----</option>
				{foreach from=$hotels_list item=item}
				<option {if $item.intHotelID == $data.intHotelID}selected="selected"{/if} value="{$item.intHotelID}" rel="{$item.intResortID}">{$item.varName}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td>Дата начала</td>
		<td>
		 {html_select_date field_order=DMY prefix="varDateFrom" time=$data.varDateFrom start_year="-5" end_year="+5" month_format=%m}
			<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateFromYear,document.editForm.varDateFromMonth,document.editForm.varDateFromDay,false,false,this);"/>
		</td>
	</tr>
	<tr>
		<td>Дата окончания</td>
		<td>
		 {html_select_date field_order=DMY prefix="varDateTo" time=$data.varDateTo start_year="-5" end_year="+5" month_format=%m}
			<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateToYear,document.editForm.varDateToMonth,document.editForm.varDateToDay,false,false,this);"/>
		</td>
	</tr>
	<tr>
		<td>Цена</td>
		<td>
			<input type="text" name="intPriceFrom" id="intPriceFrom" value="{$data.intPriceFrom}" />
			<select name="intCurrencyID">
				{foreach from=$currencies item=item}
				<option {if $data.intCurrencyID==$item.intCurrencyID}selected="selected"{/if} value="{$item.intCurrencyID}">{$item.varName}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td>Комиссия для агентств</td>
		<td>
			<input type="text" name="varAgencyComission" id="varAgencyComission" value="{$data.varAgencyComission}" />
		</td>
	</tr>
	<tr>
		<td width="140">Кол- во дней</td>
		<td>
			<select name="intCountDays">
				{foreach from=$range325 item=item}
				<option {if $data.intCountDays==$item}selected="selected"{/if} value="{$item}">{$item}</option>
				{/foreach}
			</select>
			Текстовый еквивалент:
			<input type="text" name="varDays" id="varDays" value="{$data.varDays}" />
		</td>
	</tr>
	<tr>
		<td>Кол - во человек</td>
		<td>
			<select name="intCountPeoples[]" id="intCountPeoples" multiple="multiple" style="width: 150px;">
				{foreach from=$range15 item=item key=key}
				<option {if in_array($item,$data.intCountPeoplesID)}selected="selected"{/if} value="{$item}">{$item}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td>Транспорт</td>
		<td>
			<select name="varTransport[]" id="varTransport" multiple="multiple" size="4" style="width: 300px;">
				<option value="0" disabled>-----Выберите типы транспорта-----</option>
				{foreach from=$transport_list item=item key=key}
				<option {if in_array($key,$data.varTransport)}selected="selected"{/if} value="{$key}">{$item}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td>Типы питания</td>
		<td>
			<select name="intFoodTypeID[]" id="intFoodTypeID" multiple="multiple" size="7" style="width: 300px;">
				<option value="0" disabled>-----Выберите типы питания-----</option>
				{foreach from=$food_list item=item key=key}
				<option {if in_array($item.intFoodTypeID,$data.intFoodTypeID)}selected="selected"{/if} value="{$item.intFoodTypeID}">{$item.varName}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td>Типы размещения</td>
		<td>
			<select name="intPlaceTypeID[]" id="intPlaceTypeID" multiple="multiple" size="7" style="width: 300px;">
				<option value="0" disabled>-----Выберите типы размещения-----</option>
				{foreach from=$placement_list item=item key=key}
				<option {if in_array($item.intPlaceTypeID,$data.intPlaceTypeID)}selected="selected"{/if} value="{$item.intPlaceTypeID}">{$item.varName}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td width="140">Показания</td>
		<td><textarea id="varStatement" name="varStatement" cols="120">{$data.varStatement}</textarea></td>
	</tr>
	<tr>
		<td width="140">Заезды</td>
		<td><textarea id="varHeat" name="varHeat" cols="120">{$data.varHeat}</textarea></td>
	</tr>
	<tr>
		<td width="140">Описание верх</td>
		<td><textarea class="ckeditor" id="varDescription" name="varDescription" cols="120">{$data.varDescription}</textarea></td>
	</tr>
	<tr>
		<td width="140">Описание низ</td>
		<td><textarea class="ckeditor" id="varDescriptionBottom" name="varDescriptionBottom" cols="120">{$data.varDescriptionBottom}</textarea></td>
	</tr>
	<tr>
		<td width="140">Добавить файл 1</td>
		<td>
		{if $data.varFile1}
			<a href ="{$FILES_URL}{$data.varFile1}">{$data.varRealFile1Name}</a>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("tours.edit.php?intTourID={$data.intTourID}&varFile={$data.varFile1}&intFilePos=1&event=deleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
		{else}
			<input type="file" name="varFile1" id="varFile1" />
		{/if}
		</td>
	</tr>
	<tr>
		<td width="140">Добавить файл 2</td>
		<td>
		{if $data.varFile2}
			<a href ="{$FILES_URL}{$data.varFile2}">{$data.varRealFile2Name}</a>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("tours.edit.php?intTourID={$data.intTourID}&varFile={$data.varFile2}&intFilePos=2&event=deleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
		{else}
			<input type="file" name="varFile2" id="varFile2" />
		{/if}
		</td>
	</tr>
	<tr>
		<td width="140">Добавить файл 3</td>
		<td>
		{if $data.varFile3}
			<a href ="{$FILES_URL}{$data.varFile3}">{$data.varRealFile3Name}</a>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("tours.edit.php?intTourID={$data.intTourID}&varFile={$data.varFile3}&intFilePos=3&event=deleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
		{else}
			<input type="file" name="varFile3" id="varFile3" />
		{/if}
		</td>
	</tr>
</tbody>
</table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>
{literal}
<script type="text/javascript">
function SaveForm() {
	$('#event').val('save');
	$('#editForm').submit();
}
$(document).ready(function() {
	$('#intCountryID').change(function() {
		$('#intResortID option:not(:first)').hide();
		$('#intCountryID :selected').each(function(){
			$('#intResortID option[rel='+$(this).val()+']').show();
		});
		$('#intResortID').change();
	})
	
	$('#intResortID').change(function() {
		$('#intHotelID option:not(:first)').hide();
		$('#intResortID :selected').each(function(){
			$('#intHotelID option[rel='+$(this).val()+']').show();
		})
	})
	
	if(CKEDITOR.instances.varDescription) {
		CKEDITOR.instances.varDescription.destroy();
	}
	if(CKEDITOR.instances.varDescriptionBottom) {
		CKEDITOR.instances.varDescriptionBottom.destroy();
	}
	
	CKEDITOR.replace('varDescription', { toolbar: 'tiny'});
	CKEDITOR.replace('varDescriptionBottom', { toolbar: 'tiny'});
})
</script>
{/literal}