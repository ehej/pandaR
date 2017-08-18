<?php /* Smarty version 2.6.19, created on 2016-12-14 12:09:45
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/users.edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '/var/www/pandaH/panda.fm/data/templates/admin/users.edit.tpl', 23, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
	function SaveForm() {
		$(\'#event\').val(\'save\');
		$(\'#editForm\').submit();
	}
</script>
'; ?>


<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("users.php")'/>

<form action="users.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intUserID" id="intUserID" value="<?php echo $this->_tpl_vars['data']['intUserID']; ?>
" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные пользователя</th></tr></thead>
		<tbody>
			<tr>
				<td width="200">Создан</td>
				<td><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['varCreatedTime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
			</tr>
			<tr>
				<td>Логин</td>
				<td><?php echo $this->_tpl_vars['data']['varLogin']; ?>
</td>
			</tr>
			<tr>
				<td>Пароль</td>
				<td><?php echo $this->_tpl_vars['data']['varPassword']; ?>
</td>
			</tr>
			<tr>
				<td>Email подтверждён</td>
				<td><?php if ($this->_tpl_vars['data']['intValid']): ?>Да<?php else: ?>нет<?php endif; ?></td>
			</tr>
			<tr>
				<td>Название агентства<span class="important">*</span></td>
				<td><input type="text" id="varName" name="varName" value="<?php echo $this->_tpl_vars['data']['varName']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>Форма собственности<span class="important">*</span></td>
				<td><input type="text" id="varOwnership" name="varOwnership" value="<?php echo $this->_tpl_vars['data']['varOwnership']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>Код ЕГРПО<span class="important">*</span></td>
				<td><input type="text" id="varEGRPO" name="varEGRPO" value="<?php echo $this->_tpl_vars['data']['varEGRPO']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>Юридическое название агентства<span class="important">*</span></td>
				<td><input type="text" id="varUrName" name="varUrName" value="<?php echo $this->_tpl_vars['data']['varUrName']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>Банковская гарантия<span class="important">*</span></td>
				<td><input type="text" id="varBankGuarantee" name="varBankGuarantee" value="<?php echo $this->_tpl_vars['data']['varBankGuarantee']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>Телефоны<span class="important">*</span></td>
				<td><input type="text" id="varTels" name="varTels" value="<?php echo $this->_tpl_vars['data']['varTels']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>Факс<span class="important">*</span></td>
				<td><input type="text" id="varFax" name="varFax" value="<?php echo $this->_tpl_vars['data']['varFax']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>E-mail<span class="important">*</span></td>
				<td><input type="text" id="varEmail" name="varEmail" value="<?php echo $this->_tpl_vars['data']['varEmail']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>Юр. Индекс<span class="important">*</span></td>
				<td><input type="text" id="varUrIndex" name="varUrIndex" value="<?php echo $this->_tpl_vars['data']['varUrIndex']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>Юр. Город<span class="important">*</span></td>
				<td><input type="text" id="varUrCity" name="varUrCity" value="<?php echo $this->_tpl_vars['data']['varUrCity']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>Юр. Улица, дом, офис<span class="important">*</span></td>
				<td><input type="text" id="varUrAddress" name="varUrAddress" value="<?php echo $this->_tpl_vars['data']['varUrAddress']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>varFizIndex<span class="important">*</span></td>
				<td><input type="text" id="varFizIndex" name="varFizIndex" value="<?php echo $this->_tpl_vars['data']['varFizIndex']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>Физ. Город<span class="important">*</span></td>
				<td><input type="text" id="varFizCity" name="varFizCity" value="<?php echo $this->_tpl_vars['data']['varFizCity']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>Факт. Индекс<span class="important">*</span></td>
				<td><input type="text" id="varFizCity" name="varFizCity" value="<?php echo $this->_tpl_vars['data']['varFizCity']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>Факт. Улица, дом, офис<span class="important">*</span></td>
				<td><input type="text" id="varFizAddress" name="varFizAddress" value="<?php echo $this->_tpl_vars['data']['varFizAddress']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>ФИО директора<span class="important">*</span></td>
				<td><input type="text" id="varFIO" name="varFIO" value="<?php echo $this->_tpl_vars['data']['varFIO']; ?>
" size="80" /></td>
			</tr>
			<tr>
				<td>Активен</td>
				<td><input  style="float:left;" type="checkbox" id="isActive" name="isActive" value="1"<?php if ($this->_tpl_vars['data']['isActive'] == '1'): ?> checked="checked"<?php endif; ?> /></td>
			</tr>
		</tbody>
	</table>


</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>