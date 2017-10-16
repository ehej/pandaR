{literal}
<script type="text/javascript">
function SaveForm() {
	$('#event').val('save');
	$('#editForm').submit();
}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("document.php")'/>

<form action="document.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intDocumentID" id="intDocumentID" value="{$data.intDocumentID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Название</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName|escape}" size="122" /></td>
			</tr>
			<tr>
				<td colspan="2">Описание</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea  class="ckeditor" id="varDescription" name="varDescription" cols="120">{$data.varDescription|escape}</textarea></td>
			</tr>
			<tr>
				<td width="140">Категория</td>
				<td><select name="intCategoryID">
					{foreach from=$category item=item}
					<option value="{$item.intCategoryID}" {if $item.intCategoryID==$data.intCategoryID} selected="selected"{/if}>{$item.varName}</option>
					{/foreach}
				</select></td>
			</tr>
			<tr>
				<td width="140">Позиция</td>
				<td><input type="text" id="intOrdering" name="intOrdering" value="{$data.intOrdering}" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Активен</td>
				<td><input style="float:left" type="checkbox" id="isActive" name="isActive" value="1"{if $data.isActive=='1'} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td width="140">Файл</td>
				<td>
				{if $data.varFileName}
					<a href ="{$FILES_URL}{$data.varFileName|substr:0:3}/{$data.varFileName}" target="_blank">{$data.varFileNameReal}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("document.edit.php?intDocumentID={$data.intDocumentID}&varFileName={$data.varFileName}&event=DeleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
				{else}
					<input type="file" name="varFileName" id="varFileName" />
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