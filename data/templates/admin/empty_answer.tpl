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
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='delAnswer({$curQuestionID}, {$curAnswerID})'/>
		</div>
		<br /><br />
	</td>
</tr>