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
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("contacts.php")'/>

<form action="contacts.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intContactID" id="intContactID" value="{$data.intContactID}" />

<table width="100%" class="container">
	<tr>
		<td valign="top" width="50%">
			<table class="bordered" width="100%">
				<thead><tr><th colspan="2">Данные контакта</th></tr></thead>
				<tbody>
					<tr>
						<td>Город<span class="important">*</span></td>
						<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="39" /></td>
					</tr>
					<tr>
						<td>Главный оффис</td>
						<td><select name="varMain" id="varMain">
								<option value="yes" {if $data.varMain=='yes'}selected="selected"{/if}>Да</option>
								<option value="no" {if $data.varMain!='yes'}selected="selected"{/if}>Нет</option>
						</select></td>
					</tr>
					<tr>
						<td>Активен</td>
						<td><select name="varView" id="varView">
								<option value="yes" {if $data.varView!='no'}selected="selected"{/if}>Да</option>
								<option value="no" {if $data.varView=='no'}selected="selected"{/if}>Нет</option>
						</select></td>
					</tr>
					
				</tbody>
			</table>
		</td>
		<td valign="top" width="50%">
			<table class="bordered" width="100%" id="cotacts">
				<thead><tr><th colspan="2">Контакты</th></tr></thead>
				<tbody>
					{foreach from=$contacts item=item}
					<tr>
						<td><input type="text" name="contacts[]"  size="23" value="{$item.varText}"></td>
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
		</td>
	</tr>
	<tr>
		<td valign="top" colspan="2">
			<table class="bordered" width="100%">
				<thead><tr><th></th></tr></thead>
				<tr>
					<td>Адресс и описание<br><textarea class="ckeditor" id="varInfo" name="varInfo" style="width: 213px; height: 50px;">{$data.varInfo}</textarea></td>
				</tr>				
				<tr>					
					<td>Общественный транспорт<br><textarea  class="ckeditor" id="varTransport" name="varTransport" style="width: 213px; height: 50px;">{$data.varTransport}</textarea></td>
				</tr>
				<tr>
					<td>Карта<br><input type="file" id="varFoto" name="varFoto"/></td>
				</tr>			
				{if $data.varFoto}
				<tr>
					<td><img src="{$path}{$data.varFoto}"/></td>
				</tr>	
				<tr>
					<td><input type="checkbox" value="1" name="varFoto_Clear"> Удалить карту</td>
				</tr>
				{/if}
			</table>
		</td>
	</tr>
</table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>