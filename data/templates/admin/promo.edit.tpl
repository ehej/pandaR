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
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("promo.php")'/>

<form action="promo.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intPromoID" id="intPromoID" value="{$data.intPromoID}" />

<table class="bordered" width="100%">
	<thead><tr><th colspan="2">Данные промоакции</th></tr></thead>
	<tbody>
		<tr>
			<td>Название  Промоакции</td>
			<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="100" /></td>
		</tr>
		<tr>
			<td>Название Заголовка1</td>
			<td><input type="text" id="varHead" name="varHead" value="{$data.varHead}" size="100" /></td>
		</tr>
		<tr>
			<td>Название Заголовка2</td>
			<td><input type="text" id="varFoot" name="varFoot" value="{$data.varFoot}" size="100" /></td>
		</tr>
		<tr>
			<td>Активен</td>
			<td><select name="isActive" id="isActive">
				<option value="no" {if $data.isActive=='no'}selected="selected"{/if}>Нет</option>
				<option value="yes" {if $data.isActive=='yes'}selected="selected"{/if}>Да</option>
			</select></td>
		</tr>
		<tr>
			<td>Страна</td>
			<td>
				<select name="intCountryID" style="width: 200px;">
					{foreach from=$countries item=item}	
						<option value="{$item.intCountryID}" {if $item.intCountryID== $data.intCountryID} selected="selected" {/if} >{$item.varName}</option>
					{/foreach}
				</select>
			</td>
		</tr>
	</tbody>
</table>
<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>
{if $data.intPromoID != ''}
<br><br>
<input type="button" class="iconize" rel="23" value="Добавить отель" onclick='Go("promo_hotel.edit.php?intPromoID={$data.intPromoID}")'/>


<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>ID</th>
		<th>Название</th>
		<th>Блок акцент</th>
		
		<th>Действия</th>
	</tr>
	{foreach name=promo from=$promo_hotel_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="promo_hotel.edit.php?intHotelPromoID={$item.intHotelPromoID}"'>
		<td>{$item.intHotelPromoID}</td>
		<td>{$item.varNameHotel}</td>
		<td>{if $item.intAkcent == '1'}Да{else}Нет{/if}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("promo_hotel.edit.php?intPromoID={$data.intPromoID}&intHotelPromoID={$item.intHotelPromoID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("promo_hotel.php?intPromoID={$data.intPromoID}&intHotelPromoID={$item.intHotelPromoID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intHotelPromoID}?")'/></td>
	</tr>
	{/if}{foreachelse}
	<tr>
		<td colspan="4" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>


{/if}