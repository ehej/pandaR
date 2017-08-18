{literal}
<script type="text/javascript">
function SaveForm() {
	$('#event').val('save');
	$('#editForm').submit();
}
function SendForm() {
	$('#event').val('send');
	$('#editForm').submit();
}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("messages.php")'/>

<form action="messages.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intMessageID" id="intMessageID" value="{$data.intMessageID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные страницы</th></tr></thead>
		<tbody>
			<tr>
				<td>Тема<span class="important">*</span></td>
				<td><input type="text" id="varSubject" name="varSubject" value="{$data.varSubject}" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Содержание</td>
				<td><textarea  class="ckeditor" id="varMessage" name="varMessage" cols="120">{$data.varMessage}</textarea></td>
			</tr>
			<tr>
				<td width="140">Добавить файл 1</td>
				<td>
				{if $data.varFile1}
					<a href ="{$FILES_URL}{$data.varFile1}">{$data.varRealFile1Name}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("messages.edit.php?intMessageID={$data.intMessageID}&varFile={$data.varFile1}&intFilePos=1&event=deleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
				{else}
					<input type="file" name="varFile1" id="varFile1" />
				{/if}
				</td>
			</tr>
			<tr>
				<td width="140">Добавить файл 2</td>
				<td>
				{if $data.varFile2}
					<a href ="{$FILES_URL}{$data.varFile2}">{$data.varRealFile2Name}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("messages.edit.php?intMessageID={$data.intMessageID}&varFile={$data.varFile2}&intFilePos=2&event=deleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
				{else}
					<input type="file" name="varFile2" id="varFile2" />
				{/if}
				</td>
			</tr>
			<tr>
				<td width="140">Добавить файл 3</td>
				<td>
				{if $data.varFile3}
					<a href ="{$FILES_URL}{$data.varFile3}">{$data.varRealFile3Name}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("messages.edit.php?intMessageID={$data.intMessageID}&varFile={$data.varFile3}&intFilePos=3&event=deleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
				{else}
					<input type="file" name="varFile3" id="varFile3" />
				{/if}
				</td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/> {if $data.intMessageID}<input type="submit" class="iconize" rel="82" value="Разослать" onclick='SendForm()'/>{/if}
</div>
</form>