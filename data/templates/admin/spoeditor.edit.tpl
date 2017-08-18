{literal}
<script type="text/javascript" src="/js/colorpicker.js"></script>
<script type="text/javascript">	
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}

	$(document).ready(function(){
		$('#varColorBG').ColorPicker({
	  		onSubmit: function(hsb, hex, rgb) {
	    		$('#varColorBG').val(hex);
	  		},
	  		onBeforeShow: function () {
	    		$(this).ColorPickerSetColor(this.value);
	  		},
	  		onChange: function (hsb, hex, rgb) {
	  			$('#varColorBG').val(hex);
	  		}
	 	}).bind('keyup', function(){
		  	$(this).ColorPickerSetColor(this.value);
		});
        $('#varColorRO').ColorPicker({
              onSubmit: function(hsb, hex, rgb) {
                $('#varColorRO').val(hex);
              },
              onBeforeShow: function () {
                $(this).ColorPickerSetColor(this.value);
              },
              onChange: function (hsb, hex, rgb) {
                  $('#varColorRO').val(hex);
              }
         }).bind('keyup', function(){
              $(this).ColorPickerSetColor(this.value);
        });
	});
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("spoeditor.php")'/>

<form action="spoeditor.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intSPOEditorID" id="intSPOEditorID" value="{$data.intSPOEditorID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные СПО</th></tr></thead>
		<tbody>
			<tr>
				<td>Ссылка</td>
				<td>http://&nbsp;&nbsp;<input type="text" id="varLink" name="varLink" value="{$data.varLink}" /></td>
			</tr>
			<tr>
				<td width="140">Дата вылета</td>
				<td>{html_select_date field_order=DMY prefix="varDepartureDate" time=$data.varDepartureDate start_year="2010" end_year="+5" month_format=%m}
					<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDepartureDateYear,document.editForm.varDepartureDateMonth,document.editForm.varDepartureDateDay,false,false,this);"/></td>
			</tr>
			<tr>
				<td width="140">Действует до</td>
				<td>{html_select_date field_order=DMY prefix="varValidUntilDate" time=$data.varValidUntilDate start_year="2010" end_year="+5" month_format=%m}
					<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varValidUntilDateYear,document.editForm.varValidUntilDateMonth,document.editForm.varValidUntilDateDay,false,false,this);"/></td>
			</tr>
			
			<tr>
				<td>Цвет фона СПО на Главной</td>
				<td><input type="text" id="varColorBG" name="varColorBG" value="{$data.varColorBG}" title="Лучший выбор: #e7e7e7" /></td>
			</tr>
			<tr>
				<td>Цвет фона СПО на Главной при наведении</td>
				<td><input type="text" id="varColorRO" name="varColorRO" value="{$data.varColorRO}" title="Лучший выбор: #96c7f7" /></td>
			</tr>
			
			<tr>
				<td width="140">Скрыть после окончания срока действия</td>
				<td><input style="float:left" type="checkbox" id="intHideAfterTheExpiration" name="intHideAfterTheExpiration" value="1"{if $data.intHideAfterTheExpiration=='1'} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td>Отображать</td>
				<td><input style="float:left" type="checkbox" id="isShow" name="isShow" value="1"{if $data.isShow=='1'} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td>Отображать только авторизированным</td>
				<td><input style="float:left" type="checkbox" id="isAuthorized" name="isAuthorized" value="1"{if $data.isAuthorized=='1'} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td style="width: 300px;">Изображение</td>
				<td>
				{if $data.varImage}
					<a href ="{$FILES_URL}{$data.varImage}">{$data.varRealImageName}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("spoeditor.edit.php?intSPOEditorID={$data.intSPOEditorID}&varImage={$data.varImage}&event=deleteImage", "Вы уверены, что хотите удалить данный файл?")'/></td>
				{else}
					<input type="file" name="varImage" id="varImage" />
				{/if}
				</td>
			</tr>
			<tr>
				<td colspan="2">Верхняя часть</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea class="ckeditor" id="varName" name="varName" cols="120">{$data.varName}</textarea></td>
			</tr>
			<tr>
				<td colspan="2">Центральная часть</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea class="ckeditor" id="varLabel" name="varLabel" cols="120">{$data.varLabel}</textarea></td>
			</tr>
			<tr>
				<td colspan="2">Нижняя часть</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea class="ckeditor" id="varPrice" name="varPrice" cols="120">{$data.varPrice}</textarea></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>
