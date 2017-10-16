<!--{literal}-->
<script type="text/javascript"><!--
	var json_tbl_tours_list = '';	
	var json_countries_list = '';
	var json_regions_list = '';
	var json_departure_cities_list = '';
	var json_tbl_dep_cities_list = '';
	
	var varDateFrom = new Date();
	var varDateTo = new Date();
	var varDateValid = new Date();
	
	var varDateFromMonth = 0;
	var varDateToMonth = 0;
	var varDateValidMonth = 0;
	
	$(document).ready(function() {	
		json_tbl_tours_list = $("#json_tbl_tours_list").text();
		json_tbl_tours_list = jQuery.parseJSON(json_tbl_tours_list);

		json_countries_list = $("#json_countries_list").text();
		json_countries_list = jQuery.parseJSON(json_countries_list);

		json_regions_list = $("#json_regions_list").text();
		json_regions_list = jQuery.parseJSON(json_regions_list);
		
		
		json_tbl_regions_list = $("#json_tbl_regions_list").text();
		json_tbl_regions_list = jQuery.parseJSON(json_tbl_regions_list);

		json_tbl_dep_cities_list = $("#json_tbl_dep_cities_list").text();
		json_tbl_dep_cities_list = jQuery.parseJSON(json_tbl_dep_cities_list);
		
		json_departure_cities_list = $("#json_departure_cities_list").text();
		json_departure_cities_list = jQuery.parseJSON(json_departure_cities_list);

		//$('#intSpecOffIDMT').trigger('change');
//		setDepCities();
	});
	
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}

	function setData(intSpecOffIDMT) {
		if(intSpecOffIDMT != '') {
			for(var i = 0; i < json_tbl_tours_list.length; i++) {
				if(json_tbl_tours_list[i].sd_tourkey == intSpecOffIDMT) {	
					
					var varDateFrom = new Date(json_tbl_tours_list[i].TO_DateBegin * 1000);
					$('select[name=varDateFromYear]').val(varDateFrom.getFullYear());
					varDateFromMonth = varDateFrom.getMonth() + 1;
					if(varDateFromMonth < 10) varDateFromMonth = '0' + varDateFromMonth;
					$('select[name=varDateFromMonth]').val(varDateFromMonth);
					$('select[name=varDateFromDay]').val(varDateFrom.getDate());

					var varDateTo = new Date(json_tbl_tours_list[i].TO_DateEnd * 1000);
					$('select[name=varDateToYear]').val(varDateTo.getFullYear());
					varDateToMonth = varDateTo.getMonth() + 1;
					if(varDateToMonth < 10) varDateToMonth = '0' + varDateToMonth;
					$('select[name=varDateToMonth]').val(varDateToMonth);
					$('select[name=varDateToDay]').val(varDateTo.getDate());

					var varDateValid = new Date(json_tbl_tours_list[i].TO_DateValid * 1000);
					$('select[name=varDateValidYear]').val(varDateValid.getFullYear());
					varDateValidMonth = varDateValid.getMonth() + 1;
					if(varDateValidMonth < 10) varDateValidMonth = '0' + varDateValidMonth;
					$('select[name=varDateValidMonth]').val(varDateValidMonth);
					$('select[name=varDateValidDay]').val(varDateValid.getDate());

					$('#intCountryID').val('');
					$('#intRegionID').empty();
					for(var j = 0; j < json_countries_list.length; j++) {
						if(json_countries_list[j].intMTCountryID == json_tbl_tours_list[i].sd_cnkey) {
							$('#intCountryID').val(json_countries_list[j].intCountryID);
							$('#intCountryID').trigger('change');
						}
					} 
 					setDepCities(json_tbl_tours_list[i].sd_ctkeyfrom)
					$('#varDuration').val(json_tbl_tours_list[i].TO_HotelNights);
				}
			}
		}
	}
	
	function setDepCities(intMTCityID) {
		$('#intDepadtureCityID').html(''); // обнуляем select отелей
		if(intMTCityID != 0) {
			for(var j = 0; j < json_tbl_dep_cities_list.length; j++) {
				if(json_tbl_dep_cities_list[j].AP_CTKEY == intMTCityID) {
					
					for(var i = 0; i < json_departure_cities_list.length; i++) {
						if(json_departure_cities_list[i].intMTRegionID == json_tbl_dep_cities_list[j].ap_key) {
							var option = $('<option value="' + json_departure_cities_list[i].intDepadtureCityID + '">' + json_departure_cities_list[i].varName + '</option>');
							$('#intDepadtureCityID').append(option);  
						}
					}
				}
			}
		}
		intMTCityID = 0;
	}

	function setRegion(intCountryID) {
		$('#intRegionID').empty();
		if(intCountryID != '') {
			for(var i = 0; i < json_regions_list.length; i++) {
				if(json_regions_list[i].intCountryID == intCountryID) {
					var option = $('<option value="' + json_regions_list[i].intRegionID + '">' + json_regions_list[i].varName + '</option>');
					$('#intRegionID').append(option);
				}
			}
		}
	}
	
</script>
{/literal}

<div id="json_tbl_tours_list" style="display: none;">{$json_tbl_tours_list}</div>
<div id="json_countries_list" style="display: none;">{$json_countries_list}</div>
<div id="json_regions_list" style="display: none;">{$json_regions_list}</div>

<div id="json_departure_cities_list" style="display: none;">{$json_departure_cities_list}</div>

<div id="json_tbl_regions_list" style="display: none;">{$json_tbl_regions_list}</div>
<div id="json_tbl_dep_cities_list" style="display: none;">{$json_tbl_dep_cities_list}</div>
<div id="tbl_dep_cities_list" style="display: none;">{$tbl_dep_cities_list}</div>

<input type="hidden" id="curMTRegionID" value="{$data.intMTRegionID}" />

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("special_offers.php")'/>

<form action="special_offers.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intSpecOffID" id="intSpecOffID" value="{$data.intSpecOffID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные спецпредложения</th></tr></thead>
		<tbody>
			<tr>
				<td>Название</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="122" /></td>
			</tr>
			<tr>
				<td>Название (Мастер-тур)</td>
				<td>
					<select id="intSpecOffIDMT" name="intSpecOffIDMT" onchange="setData(this.value)">
						<option value=""></option>
						{foreach from=$tbl_tours_list item=item}
						<option value="{$item.sd_tourkey}"{if $data.intSpecOffIDMT==$item.sd_tourkey} selected="selected"{/if}>{$item.sd_tourname}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td>Страна</td>
				<td>
					<select id="intCountryID" name="intCountryID" onchange="setRegion(this.value)">
						<option value=""></option>
						{foreach from=$countries_list item=item}
						<option value="{$item.intCountryID}"{if $data.intCountryID==$item.intCountryID} selected="selected"{/if}>{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td width="140">Регион</td>
				<td>
					<select name="intRegionID" id="intRegionID">
						{foreach from=$regions_list item=item}
							{if $data.intCountryID==$item.intCountryID}
								<option value="{$item.intRegionID}"{if $data.intRegionID==$item.intRegionID} selected="selected"{/if}>{$item.varName}</option>
							{/if}
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td>Город вылета</td>
				<td>
					<select id="intDepadtureCityID" name="intDepadtureCityID">
						{foreach from=$departure_cities_list item=item}
						{if $data.intDepadtureCityID==$item.intDepadtureCityID}
						<option value="{$item.intDepadtureCityID}"  selected="selected" >{$item.varName}</option>
						{/if}
						{/foreach}
						
					</select>
				</td>
			</tr>
			<tr>
				<td>Дата действия СПО с</td>
				<td>{html_select_date field_order=DMY prefix="varDateFrom" time=$data.varDateFrom start_year="2010" end_year="+5" month_format=%m}
					<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateFromYear,document.editForm.varDateFromMonth,document.editForm.varDateFromDay,false,false,this);"/></td>
			</tr>
			<tr>
				<td>Дата действия СПО по</td>
				<td>{html_select_date field_order=DMY prefix="varDateTo" time=$data.varDateTo start_year="2010" end_year="+5" month_format=%m}
					<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateToYear,document.editForm.varDateToMonth,document.editForm.varDateToDay,false,false,this);"/></td>
			</tr>
			<tr>
				<td>Действует до</td>
				<td>{html_select_date field_order=DMY prefix="varDateValid" time=$data.varDateValid start_year="2010" end_year="+5" month_format=%m}
					<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateValidYear,document.editForm.varDateValidMonth,document.editForm.varDateValidDay,false,false,this);"/></td>
			</tr>
			<tr>
				<td colspan="2">Описание</td>
			</tr>
			<tr>
				<td colspan="2"><textarea class="ckeditor" id="varDescription" name="varDescription" cols="120">{$data.varDescription}</textarea></td>
			</tr>
			<tr>
				<td>Продолжительность тура (ночей)</td>
				<td><input type="text" id="varDuration" name="varDuration" value="{$data.varDuration}" size="122" /></td>
			</tr>
			<tr>
				<td>Тип спецпредложения</td>
				<td>
					<select id="intPromotionTypeID" name="intPromotionTypeID">
						{foreach from=$promotions_types_list item=item}
						<option value="{$item.intPromotionTypeID}">{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td>Отображать</td>
				<td><input style="float:left" type="checkbox" id="isShow" name="isShow" value="1"{if $data.isShow=='1'} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td>Минимальная цена</td>
				<td><input type="text" id="varMinPrice" name="varMinPrice" value="{$data.varMinPrice}" size="122" /></td>
			</tr>
			<tr>
				<td>Файл .doc/.xls</td>
				<td>
				{if $data.varFile}
					<a href ="{$FILES_URL}{$data.varFile}">{$data.varRealFileName}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("special_offers.edit.php?intSpecOffID={$data.intSpecOffID}&varFile={$data.varFile}&event=deleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
				{else}
					<input type="file" name="varFile" id="varFile" />
				{/if}
				</td>
			</tr>
			<tr>
				<td>Файл .xml</td>
				<td>
				{if $data.varFileXML}
					<a href ="{$FILES_URL}{$data.varFileXML}">{$data.varRealFileXMLName}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("special_offers.edit.php?intSpecOffID={$data.intSpecOffID}&varFileXML={$data.varFileXML}&event=deleteFileXML", "Вы уверены, что хотите удалить данный файл?")'/></td>
				{else}
					<input type="file" name="varFileXML" id="varFileXML" />
				{/if}
				</td>
			</tr>
			<tr>
				<td colspan="2">Информация о туре</td>
			</tr>
			<tr>
				<td colspan="2"><textarea class="ckeditor" id="varInfo" name="varInfo" cols="120">{$data.varInfo}</textarea></td>
			</tr>
			<tr>
				<td colspan="2">Информация по ссылке</td>
			</tr>
			<tr>
				<td colspan="2"><textarea class="ckeditor" id="varInfoByLink" name="varInfoByLink" cols="120">{$data.varInfoByLink}</textarea></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>