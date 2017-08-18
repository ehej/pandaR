{literal}
<script type="text/javascript">
function SaveForm() {
	$('#event').val('save');
	$('#editForm').submit();
}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("ukrainian_area.php")'/>

<form action="ukrainian_area.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intAreaID" id="intAreaID" value="{$data.intAreaID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные страны</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Название</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="122" /></td>
			</tr>
			<tr>
				<td>Активный</td>
				<td><input style="float:left" type="checkbox" id="isActive" name="isActive" value="1" {if $data.isActive=='1'} checked="checked"{/if} /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>