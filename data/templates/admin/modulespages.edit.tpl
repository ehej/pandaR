{literal}
<script type="text/javascript">
function SaveForm() {
	$('#event').val('save');
	$('#intGalleryID option').css('display',''); 
	$('#editForm').submit();
}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("modulespages.php")'/>

<form action="modulespages.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intModulePageID" id="intModulePageID" value="{$data.intModulePageID}" />
<input type="hidden" name="varPage" id="varPage" value="{$data.varPage}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные страницы</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Название</td>
				<td>{$data.varTitle}</td>
			</tr>
			<tr>
				<td>Meta Title</td>
				<td><textarea id="varMetaTitle" name="varMetaTitle" cols="120">{$data.varMetaTitle}</textarea></td>
			</tr>
			<tr>
				<td>Meta Keywords</td>
				<td><textarea id="varMetaKeywords" name="varMetaKeywords" cols="120">{$data.varMetaKeywords}</textarea></td>
			</tr>
			<tr>
				<td>Meta description</td>
				<td><textarea id="varMetaDescription" name="varMetaDescription" cols="120">{$data.varMetaDescription}</textarea></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>