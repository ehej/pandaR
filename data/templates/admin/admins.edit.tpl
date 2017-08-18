{literal}
<script type="text/javascript">
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("admins.php")'/>

<form action="admins.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intAdminID" id="intAdminID" value="{$data.intAdminID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные администратора</th></tr></thead>
		<tbody>
			<tr>
				<td>Логин<span class="important">*</span></td>
				<td><input type="text" id="varLogin" name="varLogin" value="{$data.varLogin}" size="122" /></td>
			</tr>
			<tr>
				<td>Пароль</td>
				<td><input type="password" id="varPassword" name="varPassword" size="122" /></td>
			</tr>
			<tr>
				<td>E-mail<span class="important">*</span></td>
				<td><input type="text" id="varEmail" name="varEmail" value="{$data.varEmail}" size="122" /></td>
			</tr>
			<tr>
				<td>Ф. И. О.<span class="important">*</span></td>
				<td><input type="text" id="varFIO" name="varFIO" value="{$data.varFIO}" size="122" /></td>
			</tr>
			<tr>
				<td>Телефон<span class="important">*</span></td>
				<td><input type="text" id="varPhone" name="varPhone" value="{$data.varPhone}" size="122" /></td>
			</tr>
			<tr>
				<td>Роль</td>
				<td>
					<select name="intRoleID" id="intRoleID">
						{foreach from=$roles_list item=item}
						<option value="{$item.intRoleID}"{if $item.intRoleID==$data.intRoleID} selected="selected"{/if}>{$item.varRoleName}</option>
						{/foreach}
					</select>
				</td>
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