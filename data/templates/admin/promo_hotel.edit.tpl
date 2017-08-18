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
<input type="button" class="iconize" rel="78" value="Вернуться к списку промоакций" onclick='Go("promo.php")'/>&nbsp;<input type="button" class="iconize" rel="78" value="Вернуться к промоакций" onclick='Go("promo.edit.php?intPromoID={$intPromoID}")'/>

<form action="promo_hotel.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intPromoID" id="intPromoID" value="{$intPromoID}" />
<input type="hidden" name="intHotelPromoID" id="intHotelPromoID" value="{$data.intHotelPromoID}" />

<table class="bordered" width="100%">
	<thead><tr><th colspan="2">Данные отеля промоакции</th></tr></thead>
	<tbody>
		<tr>
			<td>Название отеля</td>
			<td><input type="text" id="varNameHotel" name="varNameHotel" value="{$data.varNameHotel}" size="100" /></td>
		</tr>
        <tr>
			<td>Ссылка</td>
			<td><input type="text" id="varLink" name="varLink" value="{$data.varLink}" size="150" /></td>
		</tr>
		<tr>
			<td><input type="checkbox" value="1" name="intAkcent" id="intAkcent" {if $data.intAkcent == 1}checked="checked"{/if}></td>
			<td> Поместить в блок акцент соотвествующей страны </td>
		</tr>
	</tbody>
</table>
<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>
{if $data.intHotelPromoID != ''}
<br><br>
<input type="button" class="iconize" rel="23" value="Добавить детали промоакции" onclick='Go("promo_hotel_detail.edit.php?intPromoID={$intPromoID}&intHotelPromoID={$data.intHotelPromoID}")'/>


<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>ID</th>
		<th>Условия</th>
		<th>Дата заезда</th>
		<th>Действия</th>
	</tr>
	{foreach name=promo from=$promo_hotel_details_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="promo_hotel_details.edit.php?intHotelPromoID={$item.intHotelPromoID}"'>
		<td>{$item.intDetailsID}</td>
		<td>{$item.varUsloviya}</td>
		<td>{$item.varDateFrom} - {$item.varDateTo}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("promo_hotel_detail.edit.php?intPromoID={$intPromoID}&intHotelPromoID={$data.intHotelPromoID}&intDetailsID={$item.intDetailsID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("promo_hotel_detail.php?intHotelPromoID={$item.intHotelPromoID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intHotelPromoID}?")'/></td>
	</tr>
	{/if}{foreachelse}
	<tr>
		<td colspan="4" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>


{/if}