{literal}
<script>
	function SaveForm() {
		$('#event').val('save');
		$('#hotelForm').submit();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<form action="hotels.edit.php" method="POST" id="hotelForm" name="hotelForm">
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("hotels.php")'/>&nbsp;<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>

<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intHotelID" id="intHotelID" value="{$data.intHotelID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные по отелю</th></tr></thead>
		<tbody>
			<tr>
				<td>Название</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName}" /></td>
			</tr>
			<tr>
				<td width="140">Регион</td>
				<td>
					<select name="intRegionID">
					{foreach from=$regions_list item=item}
						{if $item.varCountryName != $varCountryName}<optgroup label="{$item.varCountryName}">{/if}
						<option value="{$item.intRegionID}"{if $data.intRegionID == $item.intRegionID} selected="selected"{/if}>{$item.varName}</option>
						{assign var="varCountryName" value=$varCountryName}
						{if $item.varCountryName != $varCountryName}</optgroup>{/if}
					{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td>Категория</td>
				<td>
					<select name="intHotelTypeID">
					{foreach from=$hotels_types_list item=item}
						<option value="{$item.intHotelTypeID}"{if $data.intHotelTypeID == $item.intHotelTypeID} selected="selected"{/if}>{$item.varName}</option>						
					{/foreach}
					</select>
				</td>
			</tr>
		</tbody>
	</table>
</td></tr><tr><td><textarea  class="ckeditor" id="varDescription" name="varDescription" style="width: 99%;">{$data.varDescription}</textarea></td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>