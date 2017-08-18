{literal}
<script type="text/javascript">
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("guest_book.php")'/>

<form action="guest_book.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intGBID" id="intGBID" value="{$data.intGBID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные отзыва</th></tr></thead>
		<tbody>
			<tr>
				<td>Дата и время</td>
				<td>Дата {html_select_date field_order=DMY prefix="varDate" time=$data.varDate start_year="2010" end_year="+5" month_format=%m}
					<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateYear,document.editForm.varDateMonth,document.editForm.varDateDay,false,false,this);"/> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Время {html_select_time time=$data.varDate prefix="varDate"}
               </td>
			</tr>
			<tr>
				<td>Имя</td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="122" /></td>
			</tr>
			<tr>
				<td>E-mail</td>
				<td><input type="text" id="varEmail" name="varEmail" value="{$data.varEmail}" size="122" /></td>
			</tr>
			<tr>
				<td>Сайт</td>
				<td><input type="text" id="varSite" name="varSite" value="{$data.varSite}" size="122" /></td>
			</tr>
			<tr>
				<td>Модерацию прошол</td>
				<td><input  style="float:left;" type="checkbox" id="intStatus" name="intStatus" value="1"{if $data.intStatus=='1'} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td colspan="2">Текст</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea  class="ckeditor" id="varText" name="varText" cols="120">{$data.varText}</textarea></td>
			</tr>
			<tr>
				<td colspan="2">Ответ</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea  class="ckeditor" id="varAnswer" name="varAnswer" cols="120">{$data.varAnswer}</textarea></td>
			</tr>
			
			
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>