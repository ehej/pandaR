<?php /* Smarty version 2.6.19, created on 2016-11-03 15:32:13
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/staffs.edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'in_array', '/var/www/pandaH/panda.fm/data/templates/admin/staffs.edit.tpl', 106, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
	function SaveForm() {
		$(\'#event\').val(\'save\');
		$(\'#editForm\').submit();
	}
	function AddContact(){
		$(\'#cotacts_add_b\').before(\'<tr><td><input type="text" name="contacts[]" size="23"></td><td><select name="contacts_type[]"><option value="" >Тип контакта</option><option value="email" >E-mail</option><option value="phone"  >Телефон</option><option value="mobile" >Мобильный</option><option value="icq">ICQ</option><option value="skype"  >Skype</option></select></td></tr>\')
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
'; ?>


<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("staffs.php")'/>&nbsp;&nbsp;
<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>

<form action="staffs.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intStaffID" id="intStaffID" value="<?php echo $this->_tpl_vars['data']['intStaffID']; ?>
" />


<table class="bordered" width="100%">
	<thead><tr><th colspan="2">Данные сотрудника</th></tr></thead>
	<tbody>
		<tr>
			<td>Ф. И. О.<span class="important">*</span></td>
			<td><input type="text" id="varName" name="varName" value="<?php echo $this->_tpl_vars['data']['varName']; ?>
" size="39" /></td>
		</tr>
		<tr>
			<td>Должность</td>
			<td><input type="text" id="varPost" name="varPost" value="<?php echo $this->_tpl_vars['data']['varPost']; ?>
" size="39" /></td>
		</tr>
		<tr>
			<td>Info</td>
			<td><textarea id="varInfo" name="varInfo" style="width: 213px; height: 50px;"><?php echo $this->_tpl_vars['data']['varInfo']; ?>
</textarea></td>
		</tr>
		<tr>
			<td>Активен</td>
			<td><select name="varView" id="varView">
					<option value="yes" <?php if ($this->_tpl_vars['data']['varView'] != 'no'): ?>selected="selected"<?php endif; ?>>Да</option>
					<option value="no" <?php if ($this->_tpl_vars['data']['varView'] == 'no'): ?>selected="selected"<?php endif; ?>>Нет</option>
			</select></td>
		</tr>
		<tr>
			<td>Фото</td>
			<td><input type="file" id="varFoto" name="varFoto"/></td>
		</tr>
		<?php if ($this->_tpl_vars['data']['varFoto']): ?>
		<tr>
			<td colspan="2"><img src="<?php echo $this->_tpl_vars['path']; ?>
<?php echo $this->_tpl_vars['data']['varFoto']; ?>
"/></td>
		</tr>
		<tr>
			<td colspan="2"><input type="checkbox" value="1" name="varFoto_Clear"> Удалить фото</td>
		</tr>
		<?php endif; ?>
	</tbody>
</table>
<table class="bordered" width="100%" id="cotacts">
	<thead><tr><th colspan="2">Контакты</th></tr></thead>
	<tbody id="sortable">
		<?php $_from = $this->_tpl_vars['contacts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<tr style="cursor: move;">
			<td width="50%"><input type="text" name="contacts[]"  size="23" value="<?php echo $this->_tpl_vars['item']['varText']; ?>
"></td>
			<td><select name="contacts_type[]">
				<option value=""  	   >Тип контакта</option>
				<option value="email"  <?php if ($this->_tpl_vars['item']['varStaffType'] == 'email'): ?>selected="selected"<?php endif; ?>>E-mail</option>
				<option value="phone"  <?php if ($this->_tpl_vars['item']['varStaffType'] == 'phone'): ?>selected="selected"<?php endif; ?>>Телефон</option>
				<option value="mobile" <?php if ($this->_tpl_vars['item']['varStaffType'] == 'mobile'): ?>selected="selected"<?php endif; ?>>Мобильный</option>
				<option value="icq"    <?php if ($this->_tpl_vars['item']['varStaffType'] == 'icq'): ?>selected="selected"<?php endif; ?>>ICQ</option>
				<option value="skype"  <?php if ($this->_tpl_vars['item']['varStaffType'] == 'skype'): ?>selected="selected"<?php endif; ?>>Skype</option>
			</select></td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
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
							<?php $_from = $this->_tpl_vars['type_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
								<option value="<?php echo $this->_tpl_vars['item']['intTypeID']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['item']['intTypeID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['relation_type']) : in_array($_tmp, $this->_tpl_vars['relation_type']))): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['varNameType']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
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
								<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option value="<?php echo $this->_tpl_vars['item']['intCountryID']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['item']['intCountryID'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['relation']) : in_array($_tmp, $this->_tpl_vars['relation']))): ?> selected="selected" <?php endif; ?> ><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
								<?php endforeach; endif; unset($_from); ?>
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