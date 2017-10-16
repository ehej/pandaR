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
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("forms.php")'/>

<form action="forms.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intFormID" id="intFormID" value="{$data.intFormID}" />

<table class="bordered" width="100%">
	<thead><tr><th colspan="3">Данные формы</th></tr></thead>
	<tbody>
		<tr>
			<td>Название</td>
			<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="80" /></td>
			<td></td>
		</tr>
		<tr>
			<td>Идентификатор формы</td>
			<td><input type="text" id="varIdentificator" name="varIdentificator" value="{$data.varIdentificator}" size="80" /></td>
			<td>Значение по которому будут вставлятся форма в текст</td>
		</tr>
		<tr>
			<td>Email кому</td>
			<td><input type="text" id="varEmailTO" name="varEmailTO" value="{$data.varEmailTO}" size="80" /></td>
			<td>Кому из этой формы будут приходить сообщение</td>
		</tr>
		<tr>
			<td>От кого</td>
			<td>Email - <input type="text" id="varEmailFrom" name="varEmailFrom" value="{$data.varEmailFrom}" size="30" />&nbsp;&nbsp;Имя - <input type="text" id="varFromName" name="varFromName" value="{$data.varFromName}" size="30" /></td>
			<td>От кого будет это письмо</td>
		</tr>
		<tr>
			<td>Тема</td>
			<td><input type="text" id="varSubject" name="varSubject" value="{$data.varSubject}" size="80" /></td>
			<td>Тема письма</td>
		</tr>
		<tr>
			<td>Темплейт</td>
			<td><textarea id="varTemplate" name="varTemplate" style="width: 419px;height: 150px;">{$data.varTemplate}</textarea></td>
			<td>Темплейт для письма. Возможные вставки:<br/>
				{literal}{name-form}{/literal} - название формы<br/>
				<b>{literal}{table-fields}{/literal} - таблица с полями(обязательно)</b><br/>
				{literal}{description-form}{/literal} - описание формы
			</td>
		</tr>
		<tr>
			<td>Темплейт для формы</td>
			<td><textarea id="varTemplateForm" name="varTemplateForm" style="width: 419px;height: 150px;">{$data.varTemplateForm}</textarea></td>
			<td>Темплейт для формы. Возможные вставки:<br/>
				{literal}{name-form}{/literal} - название формы<br/>
				<b>{literal}{table-fields}{/literal} - таблица с полями(обязательно)</b><br/>
				{literal}{description-form}{/literal} - описание формы<br/>
				<b>{literal}{button-submit}{/literal} - кнопка отправки(обязательно)</b>
			</td>
		</tr>
		<tr>
			<td>Описание</td>
			<td><textarea id="varDescription" name="varDescription" style="width: 419px;height: 150px;">{$data.varDescription}</textarea></td>
			<td></td>
		</tr> 
		<tr>
			<td>Активен</td>
			<td><select name="isActive" id="isActive">
				<option value="yes" {if $data.isActive!='no'}selected="selected"{/if}>Да</option>
				<option value="no" {if $data.isActive=='no'}selected="selected"{/if}>Нет</option>
			</select></td>
			<td></td>
		</tr>
	</tbody>
</table>
<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>
{if $data.intFormID != ''}
	<br><br>
	<input type="button" class="iconize" rel="23" value="Добавить поле" onclick='Go("form_field.edit.php?intFormID={$data.intFormID}")'/>


	<table class="bordered">
	<!-- Таблица -->
		<tr>
			<th>ID</th>
			<th>Название</th>
			<th>Тип</th>
			<th>Активен</th>
			<th>Действия</th>
		</tr>
		{foreach name=form from=$form_fields_list item=item key=key}{if is_integer($key)}
		<tr onDblClick='window.location="form_field.edit.php?intFieldID={$item.intFieldID}"'>
			<td>{$item.intFieldID}</td>
			<td>{$item.varName}</td>
			<td>{$FieldType[$item.varType]}</td>
			<td>{if $item.isActive=='0'}Да{else}Нет{/if}</td>
			<td nowrap="nowrap">
				<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("form_field.edit.php?intFormID={$data.intFormID}&intFieldID={$item.intFieldID}")'/> 
				<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("forms.edit.php?intFormID={$data.intFormID}&intFieldID={$item.intFieldID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intFieldID}?")'/></td>
		</tr>
		{/if}{foreachelse}
		<tr>
			<td colspan="5" align="center" style="text-align: center">Нет записей</td>
		</tr>
		{/foreach}
	</table>
	{if $form_fields_list|count > 0 }
		<br>
		<h2>Созданная форма</h2>Код для вставки <input type="text" readonly="" value="{literal}{{/literal}form name={$data.varIdentificator}{literal}}{/literal}"><br><br>
		<iframe src="forms.edit.php?intFormID={$data.intFormID}&event=GetForms" width="99%" height="400px" style="border: 1px #ccc solid; padding: 5px;"></iframe>
	{/if}
{/if}