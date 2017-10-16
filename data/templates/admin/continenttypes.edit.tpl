{literal}
<script type="text/javascript">
function SaveForm() {
	$('#event').val('save');
	$('#editForm').submit();
}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("continenttypes.php")'/>

<form action="continenttypes.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intTypeID" id="intTypeID" value="{$data.intTypeID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные континента</th></tr></thead>
		<tbody>
			<tr>
				<td>Название</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Добавить изображение</td>
				<td>
				{if $data.varLogo}
					<a href ="{$FILES_URL}{$data.varLogo}">{$data.varRealLogoName}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("continenttypes.edit.php?intTypeID={$data.intTypeID}&varLogo={$data.varLogo}&event=deleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
				{else}
					<input type="file" name="varLogo" id="varLogo" />
				{/if}
				</td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>