{literal}
<script>
function SaveForm() {
	$('#event').val('save');
	$('#editForm').submit();
}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("hotels_option.php")'/>

<form action="hotels_option.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intOptionID" id="intOptionID" value="{$data.intOptionID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные опции</th></tr></thead>
		<tbody>
			<tr>
				<td width="140">Имя</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName|escape}" size="122" /></td>
			</tr>
			<tr>
				<td>Позиция</td>
				<td><input type="text" id="intOrdering" name="intOrdering" value="{$data.intOrdering|escape}" size="122" /></td>
			</tr>			
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>