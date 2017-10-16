<script type="text/javascript">
{literal}
function change_area(){
	Area = $('#intAreaID option:selected').val();
		
	$('#intCityID option').css('display','none');
	$('#intCityID option[rel="'+Area+'"]').css('display','');
	$('#intCityID option.first').css('display','');

	if($('#intCityID option:selected').css('display')=='none'){
		$('#intCityID option').removeAttr('selected');
		$('#intCityID option[rel="'+Area+'"]').filter(":first").attr('selected','selected');
	}
}

function SaveForm() {
	$('#event').val('save');
	$('#editForm').submit();
}
{/literal}
</script>


<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("where_buy.php")'/>

<form action="where_buy.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intWhereBuyID" id="intWhereBuyID" value="{$data.intWhereBuyID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные</th></tr></thead>
		<tbody>
			<tr>
				<td width="140">Область</td>
				<td>
					<select name="intAreaID" id="intAreaID" onchange="change_area()">
						{foreach from=$area_list item=item}
						<option value="{$item.intAreaID}" {if $data.intAreaID==$item.intAreaID} selected="selected"{/if}>{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td width="140">Город</td>
				<td>
					<select name="intCityID" id="intCityID">
						{foreach from=$city_list item=item}
						<option value="{$item.intCityID}" rel="{$item.intAreaID}" {if $data.intAreaID!=$item.intAreaID} style="display:none;"{/if}  {if $data.intCityID==$item.intCityID} selected="selected"{/if}>{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 300px;">Название агентства</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName|escape}" size="122" /></td>
			</tr>
			<tr>
				<td style="width: 300px;">Агентство NewsTravel</td>
				<td><label><input type="radio" name="varMIBSAgency" value="Y" {if $data.varMIBSAgency == 'Y'}checked="checked"{/if} /> Да </label><label><input type="radio" name="varMIBSAgency" value="N" {if $data.varMIBSAgency != 'Y'}checked="checked"{/if}/> Нет </label></td>
			</tr>
			<tr>
				<td style="width: 300px;">Телефон агентства</td>
				<td><input type="text" id="varPhone" name="varPhone" value="{$data.varPhone|escape}" size="122" /></td>
			</tr>
			<tr>
				<td>Подробнее об агентстве</td>
				<td><textarea class="ckeditor" id="varDetail" name="varDetail" cols="120">{$data.varDetail}</textarea></td>
			</tr>
			<tr>
				<td width="140">Действует до</td>
				<td>{html_select_date field_order=DMY prefix="varActivelyTo" time=$data.varActivelyTo start_year="2010" end_year="+5" month_format=%m}
					<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varActivelyToYear,document.editForm.varActivelyToMonth,document.editForm.varActivelyToDay,false,false,this);"/></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>