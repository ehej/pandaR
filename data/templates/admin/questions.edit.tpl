{literal}
<script type="text/javascript">	
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
	function addAnswer(intQuestionID) {
		$.post("questions.edit.php", { intQuestionID: intQuestionID, event: "getNewAnswerForm" }, function(data) {
			$('#answerTable_' + intQuestionID + ' tr:last').before(data);
			AddZebra();
			CreateButtons();
		});
	}
	function addQuestion(intContestID) {
		$.post("questions.edit.php", { intContestID: intContestID, event: "getNewQuestionForm" }, function(data) {
			$('#questionTable tr:last').before(data);
			AddZebra();
			CreateButtons();
		});
	}
	function delAnswer(intQuestionID, intAnswerID) {
		if(confirm('Вы действительно хотите удалить данный ответ?')) {
			var tmp = $('#answerTable_' + intQuestionID + ' tr.answers');
			if(tmp.length > 1) {
				$.post("questions.edit.php", { intAnswerID: intAnswerID, event: "deleteAnswer" }, function(data) {
					if(data == 'delete') {
						$('#tdAnswers_' + intAnswerID).remove();
					}
				});
			} else {
				alert('Вы не можете удалить единсвенный ответ');
			}
		}
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("contests.php")'/>

<form action="questions.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intContestID" id="intContestID" value="{$data.intContestID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%" id="questionTable">
		<thead><tr><th colspan="2">Данные конкурса</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Конкурс</td>
				<td>
					{foreach from=$contests_list item=item}
						{if $item.intContestID==$data.intContestID}{$item.varTitle}{/if}
					{/foreach}	
				</td>
			</tr>
			<tr><th colspan="2">Вопросы</th></tr>
			{if $questions_list}
				{foreach from=$questions_list item=it}
			<tr>
				<td style="width: 300px; vertical-align: top;" valign="top">Вопрос</td>
				<td>
					<input type="text" id="varQuestionText[{$it.intQuestionID}]" name="varQuestionText[{$it.intQuestionID}]" value="{$it.varQuestionText}" size="122" />
					<br /><br />
					<table cellpadding="0" cellspacing="0" id="answerTable_{$it.intQuestionID}" style="width: 100%; border: 0px; border-collapse: collapse;">
						<tr><th colspan="2">Ответы</th></tr>
						{if $answers_list}
							{foreach from=$answers_list item=item}
								{if $it.intQuestionID==$item.intQuestionID}
						<tr id="tdAnswers_{$item.intAnswerID}" class="answers">
							<td width="140">Ответ</td>
							<td>
								<input type="text" name="varAnswerText[{$item.intAnswerID}]" value="{if $item.varAnswerText!=''}{$item.varAnswerText}{else}Введите текст ответа{/if}" />
								<input type="checkbox" style="float:none;" id="isRight[{$item.intAnswerID}]" value="{$item.intAnswerID}" name="isRight[{$item.intAnswerID}]"{if $item.isRight=='1'} checked="checked"{/if} />
								<div style="position: relative; display: inline;">
									<div style="position: absolute; top: -5px;">
										<label for="isRight[{$item.intAnswerID}]">Правильный</label>
									</div>
								</div>
								<div style="float: right; padding-top: 5px;">
									<input type="button" class="iconize" rel="83" value="Удалить" onclick='delAnswer({$it.intQuestionID}, {$item.intAnswerID})'/>
								</div>
								<br /><br />
							</td>
						</tr>
								{/if}
							{/foreach}
						{/if}
						<tr><td colspan="2"><input type="button" class="iconize" rel="23" value="Добавить" onclick='addAnswer({$it.intQuestionID})'/></td></tr>
					</table>
				</td>
			</tr>
				{/foreach}
			{/if}
			<tr><td colspan="2"><input type="button" class="iconize" rel="23" value="Добавить" onclick='addQuestion({$data.intContestID})'/></td></tr>
		</tbody>
	</table>	
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>