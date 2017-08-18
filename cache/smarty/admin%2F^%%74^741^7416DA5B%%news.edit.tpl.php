<?php /* Smarty version 2.6.19, created on 2017-06-14 16:06:15
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/news.edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/pandaH/panda.fm/data/templates/admin/news.edit.tpl', 24, false),array('function', 'html_select_date', '/var/www/pandaH/panda.fm/data/templates/admin/news.edit.tpl', 28, false),array('function', 'html_select_time', '/var/www/pandaH/panda.fm/data/templates/admin/news.edit.tpl', 30, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
	function SaveForm() {
		$(\'#event\').val(\'save\');
		$(\'#intGalleryID option\').css(\'display\',\'\'); 
		$(\'#editForm\').submit();
	}
</script>
'; ?>


<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("news.php")'/>

<form action="news.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intNewsID" id="intNewsID" value="<?php echo $this->_tpl_vars['data']['intNewsID']; ?>
" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные новости</th></tr></thead>
		<tbody>
			<tr>
				<td>Название<span class="important">*</span></td>
				<td><input type="text" id="varTitle" name="varTitle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['varTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="122" /></td>
			</tr>
            <tr>
				<td >Дата и время редактирования</td>
				<td>Дата <?php echo smarty_function_html_select_date(array('field_order' => 'DMY','prefix' => 'varDate','time' => $this->_tpl_vars['data']['varDate'],'start_year' => '2010','end_year' => "+5",'month_format' => "%m"), $this);?>

					<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateYear,document.editForm.varDateMonth,document.editForm.varDateDay,false,false,this);"/> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Время <?php echo smarty_function_html_select_time(array('time' => $this->_tpl_vars['data']['varDate'],'prefix' => 'varDate'), $this);?>

               </td>
			</tr>
			<tr>
				<td >Аннотация</td>
				<td><textarea id="varAnnotation" name="varAnnotation" cols="120"><?php echo $this->_tpl_vars['data']['varAnnotation']; ?>
</textarea></td>
			</tr>
			<tr>
				<td >Meta Title</td>
				<td><textarea id="varMetaTitle" name="varMetaTitle" cols="120"><?php echo $this->_tpl_vars['data']['varMetaTitle']; ?>
</textarea></td>
			</tr>
			<tr>
				<td >Meta Keywords</td>
				<td><textarea id="varMetaKeywords" name="varMetaKeywords" cols="120"><?php echo $this->_tpl_vars['data']['varMetaKeywords']; ?>
</textarea></td>
			</tr>
			<tr>
				<td >Meta description</td>
				<td><textarea id="varMetaDescription" name="varMetaDescription" cols="120"><?php echo $this->_tpl_vars['data']['varMetaDescription']; ?>
</textarea></td>
			</tr>
			<tr>
				<td >Баннерная зона</td>
				<td>
					<select name="intBannerZoneID[]" multiple="multiple" style="width: 100%;">
						<?php $_from = $this->_tpl_vars['banners_main_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<option value="<?php echo $this->_tpl_vars['item']['intBannerZoneID']; ?>
"<?php $_from = $this->_tpl_vars['banners_to_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['it']):
?><?php if ($this->_tpl_vars['item']['intBannerZoneID'] == $this->_tpl_vars['it']['intBannerZoneID']): ?> selected="selected"<?php endif; ?><?php endforeach; endif; unset($_from); ?>><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td >Фотогалерея</td>
				<td>
					Фильтр галереи: <input type="text" id="find" onkeyup="finds(this.value, 'intGalleryID');"> 
					<select name="intGalleryID[]" id="intGalleryID" multiple="multiple" style="width: 100%;">
						<?php $_from = $this->_tpl_vars['galeries_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<option value="<?php echo $this->_tpl_vars['item']['intGalleryID']; ?>
"<?php $_from = $this->_tpl_vars['galleries_to_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['it']):
?><?php if ($this->_tpl_vars['item']['intGalleryID'] == $this->_tpl_vars['it']['intGalleryID']): ?> selected="selected"<?php endif; ?><?php endforeach; endif; unset($_from); ?>><?php echo $this->_tpl_vars['item']['varTitle']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">Описание</td>
			</tr>			
			<tr>
				<td colspan="2"><textarea  class="ckeditor" id="varDescription" name="varDescription" cols="120"><?php echo $this->_tpl_vars['data']['varDescription']; ?>
</textarea></td>
			</tr>
			<tr>
				<td>Отображать на Главной</td>
				<td><input style="float:left" type="checkbox" id="intShowHome" name="intShowHome" value="1"<?php if ($this->_tpl_vars['data']['intShowHome'] == '1' || ! $this->_tpl_vars['data']['intNewsID']): ?> checked="checked"<?php endif; ?> /></td>
			</tr>
			<tr>
				<td >Активна</td>
				<td><input style="float:left" type="checkbox" id="intActive" name="intActive" value="1"<?php if ($this->_tpl_vars['data']['intActive'] == '1' || ! $this->_tpl_vars['data']['intNewsID']): ?> checked="checked"<?php endif; ?> /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>