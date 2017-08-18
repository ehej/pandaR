<?php /* Smarty version 2.6.19, created on 2016-10-27 14:48:10
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/tours.edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_select_date', '/var/www/pandaH/panda.fm/data/templates/admin/tours.edit.tpl', 76, false),)), $this); ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>

<form action="tours.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">

<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("tours.php")'/>
<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>

<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intTourID" id="intTourID" value="<?php echo $this->_tpl_vars['data']['intTourID']; ?>
" />

<table class="bordered" width="100%">
<thead><tr><th colspan="2">Данные страницы</th></tr></thead>
<tbody>
	<tr>
		<td colspan="2">
			<div style="float: left;width: 200px;">
				<label style="cursor: pointer;">Отображать <input style="float:left" type="checkbox" id="isVisible" name="isVisible" value="1"<?php if ($this->_tpl_vars['data']['isVisible'] == '1'): ?> checked="checked"<?php endif; ?> /></label>
			</div>
			<div style="float: left;width: 200px;">
				<label style="cursor: pointer;">Спец. предложение <input style="float:left" type="checkbox" id="isSpecial" name="isSpecial" value="1"<?php if ($this->_tpl_vars['data']['isSpecial'] == '1'): ?> checked="checked"<?php endif; ?> /></label>
			</div>
			<div style="float: left;width: 200px;">
				<label style="cursor: pointer;">На главную <input style="float:left" type="checkbox" id="isIndex" name="isIndex" value="1"<?php if ($this->_tpl_vars['data']['isIndex'] == '1'): ?> checked="checked"<?php endif; ?> /></label>
			</div>
		</td>
	</tr>	
	<tr>
		<td>Название<span class="important">*</span></td>
		<td><input type="text" id="varName" name="varName" value="<?php echo $this->_tpl_vars['data']['varName']; ?>
" size="122" /></td>
	</tr>
	<tr>
		<td width="140">Тип</td>
		<td>
		<select name="intTypeID[]" id="intTypeID" multiple="multiple" size="7" style="width: 300px;">
			<option value="0" disabled>-----Выберите тип-----</option>
			<?php $_from = $this->_tpl_vars['types_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<option value="<?php echo $this->_tpl_vars['item']['intTypeID']; ?>
"<?php if (in_array ( $this->_tpl_vars['item']['intTypeID'] , $this->_tpl_vars['data']['intTypeID'] )): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="140">Страна</td>
		<td><select name="intCountryID[]" id="intCountryID" multiple="multiple" size="7" style="width: 300px;">
				<option value="0" disabled>-----Выберите страну-----</option>
				<?php $_from = $this->_tpl_vars['countries_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
					<option value="<?php echo $this->_tpl_vars['item']['intCountryID']; ?>
" <?php if (in_array ( $this->_tpl_vars['item']['intCountryID'] , $this->_tpl_vars['data']['intCountryID'] )): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select></td>
	</tr>
	<tr>
		<td>Курорт</td>
		<td>
			<select name="intResortID[]" id="intResortID" multiple="multiple" size="7" style="width: 300px;">
				<option value="0" disabled>-----Выберите курорт-----</option>
				<?php $_from = $this->_tpl_vars['resorts_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<option <?php if (in_array ( $this->_tpl_vars['item']['intResortID'] , $this->_tpl_vars['data']['intResortID'] )): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['intResortID']; ?>
" rel="<?php echo $this->_tpl_vars['item']['intCountryID']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Отель</td>
		<td>
			<select name="intHotelID" id="intHotelID" size="7" style="width: 300px;">
				<option value="-1">-----Выберите отель-----</option>
				<?php $_from = $this->_tpl_vars['hotels_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<option <?php if ($this->_tpl_vars['item']['intHotelID'] == $this->_tpl_vars['data']['intHotelID']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['intHotelID']; ?>
" rel="<?php echo $this->_tpl_vars['item']['intResortID']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Дата начала</td>
		<td>
		 <?php echo smarty_function_html_select_date(array('field_order' => 'DMY','prefix' => 'varDateFrom','time' => $this->_tpl_vars['data']['varDateFrom'],'start_year' => "-5",'end_year' => "+5",'month_format' => "%m"), $this);?>

			<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateFromYear,document.editForm.varDateFromMonth,document.editForm.varDateFromDay,false,false,this);"/>
		</td>
	</tr>
	<tr>
		<td>Дата окончания</td>
		<td>
		 <?php echo smarty_function_html_select_date(array('field_order' => 'DMY','prefix' => 'varDateTo','time' => $this->_tpl_vars['data']['varDateTo'],'start_year' => "-5",'end_year' => "+5",'month_format' => "%m"), $this);?>

			<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateToYear,document.editForm.varDateToMonth,document.editForm.varDateToDay,false,false,this);"/>
		</td>
	</tr>
	<tr>
		<td>Цена</td>
		<td>
			<input type="text" name="intPriceFrom" id="intPriceFrom" value="<?php echo $this->_tpl_vars['data']['intPriceFrom']; ?>
" />
			<select name="intCurrencyID">
				<?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<option <?php if ($this->_tpl_vars['data']['intCurrencyID'] == $this->_tpl_vars['item']['intCurrencyID']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['intCurrencyID']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Комиссия для агентств</td>
		<td>
			<input type="text" name="varAgencyComission" id="varAgencyComission" value="<?php echo $this->_tpl_vars['data']['varAgencyComission']; ?>
" />
		</td>
	</tr>
	<tr>
		<td width="140">Кол- во дней</td>
		<td>
			<select name="intCountDays">
				<?php $_from = $this->_tpl_vars['range325']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<option <?php if ($this->_tpl_vars['data']['intCountDays'] == $this->_tpl_vars['item']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
			Текстовый еквивалент:
			<input type="text" name="varDays" id="varDays" value="<?php echo $this->_tpl_vars['data']['varDays']; ?>
" />
		</td>
	</tr>
	<tr>
		<td>Кол - во человек</td>
		<td>
			<select name="intCountPeoples[]" id="intCountPeoples" multiple="multiple" style="width: 150px;">
				<?php $_from = $this->_tpl_vars['range15']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				<option <?php if (in_array ( $this->_tpl_vars['item'] , $this->_tpl_vars['data']['intCountPeoplesID'] )): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Транспорт</td>
		<td>
			<select name="varTransport[]" id="varTransport" multiple="multiple" size="4" style="width: 300px;">
				<option value="0" disabled>-----Выберите типы транспорта-----</option>
				<?php $_from = $this->_tpl_vars['transport_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				<option <?php if (in_array ( $this->_tpl_vars['key'] , $this->_tpl_vars['data']['varTransport'] )): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Типы питания</td>
		<td>
			<select name="intFoodTypeID[]" id="intFoodTypeID" multiple="multiple" size="7" style="width: 300px;">
				<option value="0" disabled>-----Выберите типы питания-----</option>
				<?php $_from = $this->_tpl_vars['food_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				<option <?php if (in_array ( $this->_tpl_vars['item']['intFoodTypeID'] , $this->_tpl_vars['data']['intFoodTypeID'] )): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['intFoodTypeID']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Типы размещения</td>
		<td>
			<select name="intPlaceTypeID[]" id="intPlaceTypeID" multiple="multiple" size="7" style="width: 300px;">
				<option value="0" disabled>-----Выберите типы размещения-----</option>
				<?php $_from = $this->_tpl_vars['placement_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				<option <?php if (in_array ( $this->_tpl_vars['item']['intPlaceTypeID'] , $this->_tpl_vars['data']['intPlaceTypeID'] )): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['intPlaceTypeID']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="140">Показания</td>
		<td><textarea id="varStatement" name="varStatement" cols="120"><?php echo $this->_tpl_vars['data']['varStatement']; ?>
</textarea></td>
	</tr>
	<tr>
		<td width="140">Заезды</td>
		<td><textarea id="varHeat" name="varHeat" cols="120"><?php echo $this->_tpl_vars['data']['varHeat']; ?>
</textarea></td>
	</tr>
	<tr>
		<td width="140">Описание верх</td>
		<td><textarea class="ckeditor" id="varDescription" name="varDescription" cols="120"><?php echo $this->_tpl_vars['data']['varDescription']; ?>
</textarea></td>
	</tr>
	<tr>
		<td width="140">Описание низ</td>
		<td><textarea class="ckeditor" id="varDescriptionBottom" name="varDescriptionBottom" cols="120"><?php echo $this->_tpl_vars['data']['varDescriptionBottom']; ?>
</textarea></td>
	</tr>
	<tr>
		<td width="140">Добавить файл 1</td>
		<td>
		<?php if ($this->_tpl_vars['data']['varFile1']): ?>
			<a href ="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['data']['varFile1']; ?>
"><?php echo $this->_tpl_vars['data']['varRealFile1Name']; ?>
</a>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("tours.edit.php?intTourID=<?php echo $this->_tpl_vars['data']['intTourID']; ?>
&varFile=<?php echo $this->_tpl_vars['data']['varFile1']; ?>
&intFilePos=1&event=deleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
		<?php else: ?>
			<input type="file" name="varFile1" id="varFile1" />
		<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td width="140">Добавить файл 2</td>
		<td>
		<?php if ($this->_tpl_vars['data']['varFile2']): ?>
			<a href ="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['data']['varFile2']; ?>
"><?php echo $this->_tpl_vars['data']['varRealFile2Name']; ?>
</a>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("tours.edit.php?intTourID=<?php echo $this->_tpl_vars['data']['intTourID']; ?>
&varFile=<?php echo $this->_tpl_vars['data']['varFile2']; ?>
&intFilePos=2&event=deleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
		<?php else: ?>
			<input type="file" name="varFile2" id="varFile2" />
		<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td width="140">Добавить файл 3</td>
		<td>
		<?php if ($this->_tpl_vars['data']['varFile3']): ?>
			<a href ="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['data']['varFile3']; ?>
"><?php echo $this->_tpl_vars['data']['varRealFile3Name']; ?>
</a>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("tours.edit.php?intTourID=<?php echo $this->_tpl_vars['data']['intTourID']; ?>
&varFile=<?php echo $this->_tpl_vars['data']['varFile3']; ?>
&intFilePos=3&event=deleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
		<?php else: ?>
			<input type="file" name="varFile3" id="varFile3" />
		<?php endif; ?>
		</td>
	</tr>
</tbody>
</table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>
<?php echo '
<script type="text/javascript">
function SaveForm() {
	$(\'#event\').val(\'save\');
	$(\'#editForm\').submit();
}
$(document).ready(function() {
	$(\'#intCountryID\').change(function() {
		$(\'#intResortID option:not(:first)\').hide();
		$(\'#intCountryID :selected\').each(function(){
			$(\'#intResortID option[rel=\'+$(this).val()+\']\').show();
		});
		$(\'#intResortID\').change();
	})
	
	$(\'#intResortID\').change(function() {
		$(\'#intHotelID option:not(:first)\').hide();
		$(\'#intResortID :selected\').each(function(){
			$(\'#intHotelID option[rel=\'+$(this).val()+\']\').show();
		})
	})
	
	if(CKEDITOR.instances.varDescription) {
		CKEDITOR.instances.varDescription.destroy();
	}
	if(CKEDITOR.instances.varDescriptionBottom) {
		CKEDITOR.instances.varDescriptionBottom.destroy();
	}
	
	CKEDITOR.replace(\'varDescription\', { toolbar: \'tiny\'});
	CKEDITOR.replace(\'varDescriptionBottom\', { toolbar: \'tiny\'});
})
</script>
'; ?>