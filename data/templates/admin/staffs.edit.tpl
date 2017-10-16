{literal}
<script type="text/javascript">
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
	function AddContact(){
		$('#cotacts_add_b').before('<tr><td><input type="text" name="contacts[]" size="23"></td><td><select name="contacts_type[]"><option value="" >Тип контакта</option><option value="email" >E-mail</option><option value="phone"  >Телефон</option><option value="mobile" >Мобильный</option><option value="icq">ICQ</option><option value="skype"  >Skype</option></select></td></tr>')
		AddZebra();
	}
	$(document).ready(
		function()
		{
			$("#sortable").sortable();
			$("#sortable").disableSelection();
		}
	)
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("staffs.php")'/>&nbsp;&nbsp;
<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>

<form action="staffs.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intStaffID" id="intStaffID" value="{$data.intStaffID}" />


<table class="bordered" width="100%">
	<thead><tr><th colspan="2">Данные сотрудника</th></tr></thead>
	<tbody>
		<tr>
			<td>Ф. И. О.<span class="important">*</span></td>
			<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="39" /></td>
		</tr>
		<tr>
			<td>Должность</td>
			<td><input type="text" id="varPost" name="varPost" value="{$data.varPost}" size="39" /></td>
		</tr>
		<tr>
			<td>Info</td>
			<td><textarea id="varInfo" name="varInfo" style="width: 213px; height: 50px;">{$data.varInfo}</textarea></td>
		</tr>
		<tr>
			<td>Активен</td>
			<td><select name="varView" id="varView">
					<option value="yes" {if $data.varView!='no'}selected="selected"{/if}>Да</option>
					<option value="no" {if $data.varView=='no'}selected="selected"{/if}>Нет</option>
			</select></td>
		</tr>
		<tr>
			<td>Фото</td>
			<td><input type="file" id="varFoto" name="varFoto"/></td>
		</tr>
		{if $data.varFoto}
		<tr>
			<td colspan="2"><img src="{$path}{$data.varFoto}"/></td>
		</tr>
		<tr>
			<td colspan="2"><input type="checkbox" value="1" name="varFoto_Clear"> Удалить фото</td>
		</tr>
		{/if}
	</tbody>
</table>
<table class="bordered" width="100%" id="cotacts">
	<thead><tr><th colspan="2">Контакты</th></tr></thead>
	<tbody id="sortable">
		{foreach from=$contacts item=item}
		<tr style="cursor: move;">
			<td width="50%"><input type="text" name="contacts[]"  size="23" value="{$item.varText}"></td>
			<td><select name="contacts_type[]">
				<option value=""  	   >Тип контакта</option>
				<option value="email"  {if $item.varStaffType == 'email'}selected="selected"{/if}>E-mail</option>
				<option value="phone"  {if $item.varStaffType == 'phone'}selected="selected"{/if}>Телефон</option>
				<option value="mobile" {if $item.varStaffType == 'mobile'}selected="selected"{/if}>Мобильный</option>
				<option value="icq"    {if $item.varStaffType == 'icq'}selected="selected"{/if}>ICQ</option>
				<option value="skype"  {if $item.varStaffType == 'skype'}selected="selected"{/if}>Skype</option>
			</select></td>
		</tr>
		{/foreach}
		<tr>
			<td><input type="text" name="contacts[]" size="23" value=""></td>
			<td><select name="contacts_type[]">
				<option value=""  	   >Тип контакта</option>
				<option value="email"  >E-mail</option>
				<option value="phone"  >Телефон</option>
				<option value="mobile" >Мобильный</option>
				<option value="icq"    >ICQ</option>
				<option value="skype"  >Skype</option>
			</select></td>
		</tr>
		<tr id="cotacts_add_b">
			<td colspan="2"><input type="button" class="iconize" rel="12" value="Добавить контакт" onclick='AddContact()'/></td>
		</tr>
	</tbody>
</table>
	<table width="100%"><tr>
		<td width="49%">
			<table class="bordered" width="100%">
				<thead><tr><th colspan="2">Категория</th></tr></thead>
				<tbody>
					<tr>
						<td><select name="intTypeID[]" id="intTypeID" multiple="multiple" style="width: 200px;height: 200px;">
							{foreach from=$type_list item=item}
								<option value="{$item.intTypeID}" {if $item.intTypeID|in_array:$relation_type}selected="selected"{/if}>{$item.varNameType}</option>
							{/foreach}
							</select>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
		<td width="49%">
			<table class="bordered" width="100%">
				<thead><tr><th colspan="2">Страны</th></tr></thead>
				<tbody>
					<tr>
						<td>
							<select name="countries[]" multiple="multiple" style="width: 200px;height: 400px;">
								{foreach from=$countries item=item}
									<option value="{$item.intCountryID}" {if $item.intCountryID|in_array:$relation} selected="selected" {/if} >{$item.varName}</option>
								{/foreach}
							</select>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>