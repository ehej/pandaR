{literal}
<script type="text/javascript">
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
	function AddContact(){
		$('#cotacts_add_b').before('<tr><td><input type="text" name="contacts[]" size="43"></td></tr>')
		AddZebra();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку форм" onclick='Go("forms.php")'/>&nbsp;
<input type="button" class="iconize" rel="78" value="Вернуться к форме" onclick='Go("forms.edit.php?intFormID={$intFormID}")'/>

<form action="form_field.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intFormID" id="intFormID" value="{$intFormID}" />
<input type="hidden" name="intFieldID" id="intFieldID" value="{$data.intFieldID}" />

<table class="bordered" width="100%">
	<thead><tr><th colspan="3">Данные поля формы</th></tr></thead>
	<tbody>
		<tr>
			<td>Тип поля</td>
			<td><select name="varType" id="varType">
				{foreach name=form from=$FieldType item=item key=key}
					<option value="{$key}" {if $key == $data.varType}selected="selected"{/if}>{$item}</option>
				{/foreach}
				</select>
			</td>
			<td></td>
		</tr>
		<tr>
			<td>Вес поля</td>
			<td><input type="text" id="intOrdering" name="intOrdering" value="{$data.intOrdering}" size="80" /></td>
			<td>Чем больше число тем выше оно будет стоять в форме</td>
		</tr>
		<tr>
			<td>Название</td>
			<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="80" /></td>
			<td>Текст который будет стоять напротив поля в форме</td>
		</tr>
		<tr>
			<td>Описание</td>
			<td><input type="text" id="varDescription" name="varDescription" value="{$data.varDescription}" size="80" /></td>
			<td>Текст который будет стоять под полем описывая что там нужно воодить</td>
		</tr>
		<tr>
			<td>Обязательно поле</td>
			<td><input type="checkbox" value="1" name="intImportant" id="intImportant" {if $data.intImportant == 1}checked="checked"{/if}></td>
			<td>Если стоит галочка тогда форма не отправится без заполненого этого поля</td>
		</tr>
		<tr>
			<td>Тип проверки поля</td>
			<td><select name="varCheck" id="varCheck">
				{foreach name=form from=$FieldCheck item=item key=key}
					<option value="{$key}" {if $key == $data.varCheck}selected="selected"{/if}>{$item}</option>
				{/foreach}
				</select>
			</td>
			<td>Какая проверка поля при отправке будет осушествлена</td>
		</tr>
		<tr>
			<td>Сообщение при ошибке</td>
			<td><input type="text" id="varErrorMessage" name="varErrorMessage" value="{$data.varErrorMessage}" size="80" /></td>
			<td>Текст который будет выведен при неверном заполнении поля</td>
		</tr>
		<tr>
			<td>Максимальная длинна</td>
			<td><input type="text" id="intMaxLenght" name="intMaxLenght" value="{$data.intMaxLenght}" size="80" /></td>
			<td>Максимальная длинна вводимого текста</td>
		</tr>
		<tr>
			<td>Размеры поля (длинна)</td>
			<td><input type="text" id="intSizeW" name="intSizeW" value="{$data.intSizeW}" size="80" /></td>
			<td>Максимальная длинна вводимого текста</td>
		</tr>
		<tr>
			<td>Размеры поля (высота) </td>
			<td><input type="text" id="intSizeH" name="intSizeH" value="{$data.intSizeH}" size="80" /></td>
			<td>Максимальная длинна вводимого текста</td>
		</tr>
		<tr>
			<td>Значение по умолчанию</td>
			<td><input type="text" id="varDefaultValue" name="varDefaultValue" value="{$data.varDefaultValue}" size="80" /></td>
			<td>Значание которое будет установлено при загрузке формы</td>
		</tr>
		<tr>
			<td>Значения поля</td>
			<td><textarea id="varValues" name="varValues" style="width: 419px; height: 100px;" >{$data.varValues}</textarea></td>
			<td>Значание которое будут установлеы (Пример: Hello=Привет, test=Тест, ... )</td>
		</tr>
		<tr>
			<td>Аттребуты поля</td>
			<td><input type="text" id="varAttribute" name="varAttribute" value="{$data.varAttribute}" size="80" /></td>
			<td>Например (class="test" id="test" )</td>
		</tr>
		<tr>
			<td>Выборка из таблицы</td>
			<td><select name="varTableSelect" id="varTableSelect">
				{foreach name=form from=$FieldTableSelect item=item key=key}
					<option value="{$key}" {if $key == $data.varTableSelect}selected="selected"{/if}>{$item}</option>
				{/foreach}
				</select>
			</td>
			<td>Из какой таблицы будет осушествлека выборка для выпадающего меню</td>
		</tr>
	</tbody>
</table>
<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>
