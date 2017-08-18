<!--{literal}-->
<script type="text/javascript">
	var json_tbl_regions_list = '';	
	var json_regions_list = '';
	var json_countries_list = '';
	var json_tbl_dep_cities_list = '';
	var json_dep_cities_list = '';
	
	$(document).ready(function() {
	
		json_tbl_regions_list = $("#json_tbl_regions_list").text();
		json_tbl_regions_list = jQuery.parseJSON(json_tbl_regions_list);

		json_countries_list = $("#json_countries_list").text();
		json_countries_list = jQuery.parseJSON(json_countries_list);

		json_regions_list = $("#json_regions_list").text();
		json_regions_list = jQuery.parseJSON(json_regions_list);

		json_dep_cities_list = $("#json_dep_cities_list").text();
		json_dep_cities_list = jQuery.parseJSON(json_dep_cities_list);
		
		json_tbl_dep_cities_list = $("#json_tbl_dep_cities_list").text();
		json_tbl_dep_cities_list = jQuery.parseJSON(json_tbl_dep_cities_list);

		setDepCities();
		
		for(var j = 0; j < json_tbl_dep_cities_list.length; j++) {
			if(json_tbl_dep_cities_list[j].ap_key == $('#curMTRegionID').val()) {
				$('#intMTRegionID option[value=' + $('#curMTRegionID').val() + ']').attr('selected', 'selected');
			}
		}
		 
	});

	function setDepCities() {
		
		$('#err_airoport').css('display', 'none'); 
		$('#intMTRegionID').html(''); // обнуляем select отелей
		var intRegionID = $('#intRegionID').val(); // id из списка стран - регионов
		var intMTCityID = 0; // id региона из чужой таблицы
		err = true;
		if(intRegionID != 0) {
			for(var i = 0; i < json_regions_list.length; i++) {
				if(json_regions_list[i].intRegionID == intRegionID) {
					intMTCityID = json_regions_list[i].intMTCityID;
				}
			}
			if(intMTCityID != 0) {
				for(var j = 0; j < json_tbl_dep_cities_list.length; j++) {
					if(json_tbl_dep_cities_list[j].AP_CTKEY == intMTCityID) {
						var option = $('<option value="' + json_tbl_dep_cities_list[j].ap_key + '">' + json_tbl_dep_cities_list[j].AP_NAME + '</option>');
						$('#intMTRegionID').append(option);  
						err=false;
					}
				}
			}
			intMTCityID = 0;
		}
		if(err){
			$('#err_airoport').css('display', 'block'); 	
		}
	}
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}

<div id="json_tbl_regions_list" style="display: none;">{$json_tbl_regions_list}</div>
<div id="json_countries_list" style="display: none;">{$json_countries_list}</div>
<div id="json_tbl_dep_cities_list" style="display: none;">{$json_tbl_dep_cities_list}</div>
<div id="tbl_dep_cities_list" style="display: none;">{$tbl_dep_cities_list}</div>
<div id="json_regions_list" style="display: none;">{$json_regions_list}</div>

<input type="hidden" id="curMTRegionID" value="{$data.intMTRegionID}" />

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("departure_cities.php")'/>

<form action="departure_cities.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intDepadtureCityID" id="intDepadtureCityID" value="{$data.intDepadtureCityID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные города вылета</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Название</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Страна - регион</td>
				<td>
					<select name="intRegionID" id="intRegionID" onchange="setDepCities()">
					{foreach from=$regions_list item=item}
						{if $item.intCountryID != $prev_c_id}<optgroup label="{$item.varCountryName}">{/if}
						<option value="{$item.intRegionID}"{if $data.intRegionID == $item.intRegionID} selected="selected"{/if}>{$item.varName}</option>
						{assign var="prev_c_id" value=$item.intCountryID}
						{if $item.intCountryID != $prev_c_id}</optgroup>{/if}
					{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td width="140">Город вылета (Мастер-тур)</td>
				<td>
					<select name="intMTRegionID" id="intMTRegionID"></select><div id="err_airoport" style="display: none;float:right;color:red;">Город не найден. Проверте привязан ли регион к мастер туру либо же такого аэропорта в базе нет.</div>
				</td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>