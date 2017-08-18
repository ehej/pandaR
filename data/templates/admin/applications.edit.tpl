<script>
{literal}
function SaveForm() {
	$('#event').val('save');
	$('#userForm').submit();
}
{/literal}
</script>
<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="К списку заявок" onclick='Go("applications.php")'/>
<div style="text-align: right;"></div>

<form action="applications.edit.php" method="post" id="userForm" name="userForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intApplicationID" id="intApplicationID" value="{$data.intApplicationID}" />

<table width="60%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные по заявке</th></tr></thead>
		<tbody>
			<tr>
				<td width="140">Страна / регион</td>
				<td>
					<select name="intRegionID">
					{foreach from=$regions_list item=item}
						{if $item.varCountryName != $varCountryName}<optgroup label="{$item.varCountryName}">{/if}
						<option value="{$item.intRegionID}"{if $data.intRegionID == $item.intRegionID} selected="selected"{/if}>{$item.varName}</option>
						{assign var="varCountryName" value=$varCountryName}
						{if $item.varCountryName != $varCountryName}</optgroup>{/if}
					{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td>Название тура</td>
				<td><input style="width:300px;" type="text" id="varTourName" name="varTourName" value="{$data.varTourName}" /></td>
			</tr>
			<tr>
				<td>Название отеля</td>
				<td><input style="width:300px;" type="text" id="varHotelName" name="varHotelName" value="{$data.varHotelName}" /></td>
			</tr>
			<tr>
				<td>Дата с</td>
				<td>
					{html_select_date field_order=DMY prefix="varDateFrom" time=$data.varDateFrom start_year="2010" end_year="+5" month_format=%m}
					<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.userForm.varDateFromYear,document.userForm.varDateFromMonth,document.userForm.varDateFromDay,false,false,this);"/>
				</td>
			</tr>
			<tr>
				<td>Дата по</td>
				<td>
					{html_select_date field_order=DMY prefix="varDateTo" time=$data.varDateTo start_year="2010" end_year="+5" month_format=%m}
					<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.userForm.varDateToYear,document.userForm.varDateToMonth,document.userForm.varDateToDay,false,false,this);"/>
				</td>
			</tr>
			<tr>
				<td>Количество человек</td>
				<td><input style="width:300px;" type="text" id="varCountPersons" name="varCountPersons" value="{$data.varCountPersons}" /></td>
			</tr>
			<tr>
				<td>Тип номера</td>
				<td>
					<select name="varRoomType" id="varRoomType">
						<option value="Single"{if $data.varRoomType=='Single'} selected{/if}>Single</option>
						<option value="Double"{if $data.varRoomType=='Double'} selected{/if}>Double</option>
						<option value="Suite"{if $data.varRoomType=='Suite'} selected{/if}>Suite</option>
						<option value="Business suite"{if $data.varRoomType=='Business suite'} selected{/if}>Business suite</option>
						<option value="Apartments"{if $data.varRoomType=='Apartments'} selected{/if}>Apartments</option>
						<option value="Superior"{if $data.varRoomType=='Superior'} selected{/if}>Superior</option>
						<option value="Deluxe"{if $data.varRoomType=='Deluxe'} selected{/if}>Deluxe</option>
						<option value="Family room"{if $data.varRoomType=='Family room'} selected{/if}>Family room</option>
						<option value="Superior suite"{if $data.varRoomType=='Superior suite'} selected{/if}>Superior suite</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Количество номеров</td>
				<td><input style="width:300px;" type="text" id="varCountRooms" name="varCountRooms" value="{$data.varCountRooms}" /></td>
			</tr>
			<tr>
				<td>Вид оплаты</td>
				<td>
					<select name="varPayType" id="varPayType">
						<option value="account"{if $data.varPayType=='account'} selected{/if}>Счет</option>
						<option value="mail_order"{if $data.varPayType=='mail_order'} selected{/if}>Заказ по почте</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Комментарии</td>
				<td><textarea id="varAppComments" name="varAppComments" cols="50" rows="5">{$data.varAppComments}</textarea></td>
			</tr>
			<tr>
				<td>Цена</td>
				<td><input style="width:300px;" type="text" id="varPrice" name="varPrice" value="{$data.varPrice}" /></td>
			</tr>
			<tr>
				<td>Статус</td>
				<td>
					<select name="varStatus" id="varStatus">
						<option value="confirmed"{if $data.varStatus=='confirmed'} selected{/if}>Подтверждена</option>
						<option value="pending"{if $data.varStatus=='pending'} selected{/if}>В ожидании</option>
						<option value="denial"{if $data.varStatus=='denial'} selected{/if}>Отказ</option>
					</select>
				</td>
			</tr>
		</tbody>
		<thead>
			<th colspan="2">Данные по пользователю</th>
		</thead>
		<tbody>
			<tr>
				<td>Имя</td>
				<td><input style="width:300px;" type="text" id="varPersonFirstName" name="varPersonFirstName" value="{$data.varPersonFirstName}" /></td>
			</tr>
			<tr>
				<td>Фамилия</td>
				<td><input style="width:300px;" type="text" id="varPersonLastName" name="varPersonLastName" value="{$data.varPersonLastName}" /></td>
			</tr>
			<tr>
				<td>E-mail</td>
				<td><input style="width:300px;" type="text" id="varPersonEmail" name="varPersonEmail" value="{$data.varPersonEmail}" /></td>
			</tr>
			<tr>
				<td>Адрес</td>
				<td><input style="width:300px;" type="text" id="varPersonAddress" name="varPersonAddress" value="{$data.varPersonAddress}" /></td>
			</tr>
			<tr>
				<td>Телефон / факс</td>
				<td><input style="width:300px;" type="text" id="varPersonPhoneFax" name="varPersonPhoneFax" value="{$data.varPersonPhoneFax}" /></td>
			</tr>
			<tr>
				<td>Комментарии</td>
				<td><textarea id="varPersonComments" name="varPersonComments" cols="50" rows="5">{$data.varPersonComments}</textarea></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>