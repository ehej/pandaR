{literal}
<script>
	function SaveForm() {
		$('#event').val('save');
		$('#commentsForm').submit();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<form action="comments.edit.php" method="POST" id="commentsForm" name="commentsForm">
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("comments.php")'/>

<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intCommentID" id="intCommentID" value="{$data.intCommentID}" />
<input type="hidden" name="varModuleName" id="varModuleName" value="{$data.varModuleName}" />
<input type="hidden" name="intModuleID" id="intModuleID" value="{$data.intModuleID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные комментария</th></tr></thead>
		<tbody>
			<tr>
				<td>Имя посетителя</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName}" /></td>
			</tr>
			<tr>
				<td width="140">Текст комментария</td>
				<td><textarea id="varComment" name="varComment" style="width: 99%;">{$data.varComment}</textarea></td>
			</tr>
			<tr>
				<td>Опубликовать</td>
				<td><input style="float:left" type="checkbox" id="isActive" name="isActive" value="1"{if $data.isActive=='1'} checked="checked"{/if} /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>