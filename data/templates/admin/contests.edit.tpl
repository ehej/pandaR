{literal}
<script type="text/javascript">
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("contests.php")'/>

<form action="contests.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intContestID" id="intContestID" value="{$data.intContestID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные конкурса</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Название</td>
				<td><input type="text" id="varTitle" name="varTitle" value="{$data.varTitle}" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Кол-во вопросов на странице</td>
				<td><input type="text" id="intCountQuestionsInPage" name="intCountQuestionsInPage" value="{$data.intCountQuestionsInPage}" style="width: 20px;" /> </td>
			</tr>
		</tbody>
	</table>	
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Продолжить" onclick='SaveForm()'/>
</div>
</form>