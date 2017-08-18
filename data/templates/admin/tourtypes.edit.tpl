{literal}
<script type="text/javascript">
function SaveForm() {
	$('#event').val('save');
	$('#editForm').submit();
}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("tourtypes.php")'/>

<form action="tourtypes.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intTypeID" id="intTypeID" value="{$data.intTypeID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="3">Данные вида тура</th></tr></thead>
		<tbody>
			<tr>
				<td>Название<span class="important">*</span></td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="122" /></td>
				<td><input type="checkbox" id="intActive" name="intActive" value="1" {if $data.intActive}checked{/if} size="122" /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>