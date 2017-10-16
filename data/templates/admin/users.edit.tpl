{literal}
<script type="text/javascript">
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("users.php")'/>

<form action="users.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intUserID" id="intUserID" value="{$data.intUserID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные пользователя</th></tr></thead>
		<tbody>
			<tr>
				<td width="200">Создан</td>
				<td>{$data.varCreatedTime|date_format:"%d-%m-%Y"}</td>
			</tr>
			<tr>
				<td>Логин</td>
				<td>{$data.varLogin}</td>
			</tr>
			<tr>
				<td>Пароль</td>
				<td>{$data.varPassword}</td>
			</tr>
			<tr>
				<td>Email подтверждён</td>
				<td>{if $data.intValid}Да{else}нет{/if}</td>
			</tr>
			<tr>
				<td>Название агентства<span class="important">*</span></td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="80" /></td>
			</tr>
			<tr>
				<td>Форма собственности<span class="important">*</span></td>
				<td><input type="text" id="varOwnership" name="varOwnership" value="{$data.varOwnership}" size="80" /></td>
			</tr>
			<tr>
				<td>Код ЕГРПО<span class="important">*</span></td>
				<td><input type="text" id="varEGRPO" name="varEGRPO" value="{$data.varEGRPO}" size="80" /></td>
			</tr>
			<tr>
				<td>Юридическое название агентства<span class="important">*</span></td>
				<td><input type="text" id="varUrName" name="varUrName" value="{$data.varUrName}" size="80" /></td>
			</tr>
			<tr>
				<td>Банковская гарантия<span class="important">*</span></td>
				<td><input type="text" id="varBankGuarantee" name="varBankGuarantee" value="{$data.varBankGuarantee}" size="80" /></td>
			</tr>
			<tr>
				<td>Телефоны<span class="important">*</span></td>
				<td><input type="text" id="varTels" name="varTels" value="{$data.varTels}" size="80" /></td>
			</tr>
			<tr>
				<td>Факс<span class="important">*</span></td>
				<td><input type="text" id="varFax" name="varFax" value="{$data.varFax}" size="80" /></td>
			</tr>
			<tr>
				<td>E-mail<span class="important">*</span></td>
				<td><input type="text" id="varEmail" name="varEmail" value="{$data.varEmail}" size="80" /></td>
			</tr>
			<tr>
				<td>Юр. Индекс<span class="important">*</span></td>
				<td><input type="text" id="varUrIndex" name="varUrIndex" value="{$data.varUrIndex}" size="80" /></td>
			</tr>
			<tr>
				<td>Юр. Город<span class="important">*</span></td>
				<td><input type="text" id="varUrCity" name="varUrCity" value="{$data.varUrCity}" size="80" /></td>
			</tr>
			<tr>
				<td>Юр. Улица, дом, офис<span class="important">*</span></td>
				<td><input type="text" id="varUrAddress" name="varUrAddress" value="{$data.varUrAddress}" size="80" /></td>
			</tr>
			<tr>
				<td>varFizIndex<span class="important">*</span></td>
				<td><input type="text" id="varFizIndex" name="varFizIndex" value="{$data.varFizIndex}" size="80" /></td>
			</tr>
			<tr>
				<td>Физ. Город<span class="important">*</span></td>
				<td><input type="text" id="varFizCity" name="varFizCity" value="{$data.varFizCity}" size="80" /></td>
			</tr>
			<tr>
				<td>Факт. Индекс<span class="important">*</span></td>
				<td><input type="text" id="varFizCity" name="varFizCity" value="{$data.varFizCity}" size="80" /></td>
			</tr>
			<tr>
				<td>Факт. Улица, дом, офис<span class="important">*</span></td>
				<td><input type="text" id="varFizAddress" name="varFizAddress" value="{$data.varFizAddress}" size="80" /></td>
			</tr>
			<tr>
				<td>ФИО директора<span class="important">*</span></td>
				<td><input type="text" id="varFIO" name="varFIO" value="{$data.varFIO}" size="80" /></td>
			</tr>
			<tr>
				<td>Активен</td>
				<td><input  style="float:left;" type="checkbox" id="isActive" name="isActive" value="1"{if $data.isActive=='1'} checked="checked"{/if} /></td>
			</tr>
		</tbody>
	</table>


</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>