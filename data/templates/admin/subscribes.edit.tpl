{literal}
<script>
function SaveForm() {
	$('#event').val('save');
	$('#editForm').submit();
}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("subscribes.php")'/>

<form action="subscribes.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intSubscribeID" id="intSubscribeID" value="{$data.intSubscribeID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные страницы</th></tr></thead>
		<tbody>
			<tr>
				<td >Дата и время добавления</td>
				<td>Дата {html_select_date field_order=DMY prefix="varDateAdd" time=$data.varDateAdd start_year="2010" end_year="+5" month_format=%m}
					<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateYear,document.editForm.varDateMonth,document.editForm.varDateDay,false,false,this);"/> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Время {html_select_time time=$data.varDateAdd prefix="varDateAdd"}
               </td>
			</tr>
			<tr>
				<td>E-mail<span class="important">*</span></td>
				<td><input type="text" id="Email" name="varEmail" value="{$data.varEmail|escape}" size="122" /></td>
			</tr>			

			<tr>
				<td>Активен</td>
				<td><input style="float: left;" type="checkbox" id="isActive" name="isActive" value="1" {if $data.isActive == 1} checked="checked" {/if} /></td>
			</tr>	
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>