<script>
{literal}
function SaveForm() {
	$('#event').val('save');
	$('#hotelForm').submit();
}
{/literal}
</script>

<h1>{$pagetitle}</h1>
<form action="hotels_types.edit.php" method="POST" id="hotelForm" name="hotelForm">
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("hotels_types.php")'/>&nbsp;<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>

<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intHotelTypeID" id="intHotelTypeID" value="{$data.intHotelTypeID}" />

<table width="50%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные по категории отеля</th></tr></thead>
		<tbody>
			<tr>
				<td>Название</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName}" /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>