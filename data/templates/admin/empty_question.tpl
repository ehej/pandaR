<tr>
	<td style="width: 300px; vertical-align: top;" valign="top">Вопрос</td>
	<td>
		<input type="text" id="varQuestionText[{$curQuestionID}]" name="varQuestionText[{$curQuestionID}]" value="Введите текст вопроса" size="122" />
		<br /><br />
		<table cellpadding="0" cellspacing="0" id="answerTable_{$curQuestionID}" style="width: 100%; border: 0px; border-collapse: collapse;">
			<tr><th colspan="2">Ответы</th></tr>
			<tr id="tdAnswers_{$curAnswerID}" class="answers">
				<td width="140">Ответ</td>
				<td>
					<input type="text" name="varAnswerText[{$curAnswerID}]" value="Введите текст ответа" />
					<input type="checkbox" style="float:none;" id="isRight[{$curAnswerID}]" value="{$curAnswerID}" name="isRight[{$curAnswerID}]" />
					<div style="position: relative; display: inline;">
						<div style="position: absolute; top: -5px;">
							<label for="isRight[{$curAnswerID}]">Правильный</label>
						</div>
					</div>
					<div style="float: right; padding-top: 5px;">
						<input type="button" class="iconize" rel="83" value="Удалить" onclick='delAnswer({$curQuestionID}, {$curAnswerID})' />
					</div>
					<br /><br />
				</td>
			</tr>
			<tr><td colspan="2"><input type="button" class="iconize" rel="23" value="Добавить" onclick='addAnswer({$curQuestionID})'/></td></tr>
		</table>
	</td>
</tr>