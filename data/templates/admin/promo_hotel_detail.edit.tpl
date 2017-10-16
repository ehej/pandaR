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
<input type="button" class="iconize" rel="78" value="Вернуться к списку промоакций" onclick='Go("promo.php")'/>&nbsp;
<input type="button" class="iconize" rel="78" value="Вернуться к промоакций" onclick='Go("promo.edit.php?intPromoID={$intPromoID}")'/>&nbsp;
<input type="button" class="iconize" rel="78" value="Вернуться к отелю промоакций" onclick='Go("promo_hotel.edit.php?intPromoID={$intPromoID}&intHotelPromoID={$intHotelPromoID}")'/>

<form action="promo_hotel_detail.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intPromoID" id="intPromoID" value="{$intPromoID}" />
<input type="hidden" name="intHotelPromoID" id="intHotelPromoID" value="{$intHotelPromoID}" />
<input type="hidden" name="intDetailsID" id="intDetailsID" value="{$data.intDetailsID}" />
	

<table class="bordered" width="100%">
	<thead><tr><th colspan="2">Данные деталей промоакции</th></tr></thead>
	<tbody>
		<tr>
			<td colspan="2">Условия акции</td>
		</tr>			
		<tr>
			<td colspan="2"><textarea  class="ckeditor" id="varUsloviya" name="varUsloviya" cols="120">{$data.varUsloviya}</textarea></td>
		</tr>
		<tr>
			<td width="140">Дата заезда</td>
			<td>От {html_select_date field_order=DMY prefix="varDateFrom" time=$data.varDateFrom start_year="2010" end_year="+5" month_format=%m}
				
				<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateFromYear,document.editForm.varDateFromMonth,document.editForm.varDateFromDay,false,false,this);"/>	
				До {html_select_date field_order=DMY prefix="varDateTo" time=$data.varDateTo start_year="2010" end_year="+5" month_format=%m}
				<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateToYear,document.editForm.varDateToMonth,document.editForm.varDateToDay,false,false,this);"/>	
				
			</td>
				
		</tr>
	
		<tr>
			<td colspan="2">Примечание</td>
		</tr>			
		<tr>
			<td colspan="2"><textarea  class="ckeditor" id="varTextAdd" name="varTextAdd" cols="120">{$data.varTextAdd}</textarea></td>
		</tr>
	</tbody>
</table>
<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>

