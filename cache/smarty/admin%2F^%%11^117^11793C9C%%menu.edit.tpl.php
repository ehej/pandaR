<?php /* Smarty version 2.6.19, created on 2017-06-26 15:53:33
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/menu.edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/var/www/pandaH/panda.fm/data/templates/admin/menu.edit.tpl', 49, false),)), $this); ?>
<?php echo '<script type="text/javascript">
	function SaveForm() {
		$(\'#event\').val(\'save\');
		$(\'#editForm\').submit();
	}
	function setTarget(value) {
		$(\'#link\').hide(); 
		$(\'#page\').hide(); 
		$(\'#news\').hide(); 
		$(\'#news_type\').hide(); 
		$(\'#promo\').hide();
	
		switch (value) {
			case \'link\'					: $(\'#link\').show(); $(\'#news_type\').hide(); $(\'#promo\').hide(); $(\'#varUrl\').val(\'\'); break;
			case \'page\'					: $(\'#page\').show(); $(\'#news\').hide(); $(\'#news_type\').hide(); $(\'#promo\').hide(); break;
			case \'news\'					: $(\'#news\').show(); $(\'#news_type\').hide(); $(\'#promo\').hide(); break;
			case \'news_type\'			: $(\'#news_type\').show(); $(\'#promo\').hide(); break;
			case \'promoakcii\'			: $(\'#promo\').show(); break;
		}
	}
	
	function change_type_menu(){
		type = $(\'#varTypeMenu option:selected\').val();
		$(\'#intParentID option\').css(\'display\', \'none\');
		$(\'#intParentID option[rel="\'+type+\'"]\').css(\'display\',\'\');
		$(\'#intParentID option[rel="free"]\').css(\'display\',\'\');
	}
	
	$(document).ready(function() {
   		change_type_menu();
 	});

	
</script>
'; ?>

<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("menu.php")'/>
<form action="menu.edit.php" method="POST" enctype="multipart/form-data" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intMenuID" id="intMenuID" value="<?php echo $this->_tpl_vars['menu']['intMenuID']; ?>
" />
<input type="hidden" name="intSortOrder" id="intSortOrder" value="<?php echo $this->_tpl_vars['menu']['intSortOrder']; ?>
" />

<table width="100%" class="container"><tr><td width="50%">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Общие данные</th></tr></thead>
		<tbody>			
			<tr>
				<td width="300">Название<span class="important">*</span></td>
				<td><input type="text" id="varTitle" name="varTitle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['menu']['varTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td>
			</tr>
			<tr>
				<td>Модуль</td>
				<td>
					<select id="varModule" name="varModule" onchange="setTarget(this.value)">
					<?php $_from = $this->_tpl_vars['modules_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<?php if ($this->_tpl_vars['item']['varPage'] != 'adv_country' && $this->_tpl_vars['item']['varPage'] != 'hotels' && $this->_tpl_vars['item']['varPage'] != 'resorts' && $this->_tpl_vars['item']['varPage'] != 'about_country' && $this->_tpl_vars['item']['varPage'] != 'regions'): ?>
						<option value="<?php echo $this->_tpl_vars['item']['varPage']; ?>
" <?php if ($this->_tpl_vars['menu']['varModule'] == $this->_tpl_vars['item']['varPage']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['varTitle']; ?>
</option>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
			
			<tr id="link" <?php if ($this->_tpl_vars['menu']['varModule'] != 'link'): ?>style="display: none;"<?php endif; ?>>
				<td>Ссылка</td>
				<td><input type="text" id="varUrl" name="varUrl" value="<?php echo $this->_tpl_vars['menu']['varUrl']; ?>
" /></td>
			</tr>		
			<tr id="page" <?php if ($this->_tpl_vars['menu']['varModule'] != 'page'): ?>style="display: none;"<?php endif; ?>>
				<td>Страница</td>
				<td>
					<select id="varIdentifier1" name="varIdentifier1" style="width: 250px;">
						<?php $_from = $this->_tpl_vars['pages_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
							<option value="<?php echo $this->_tpl_vars['item']['intPageID']; ?>
"<?php if ($this->_tpl_vars['menu']['varIdentifier'] == $this->_tpl_vars['item']['intPageID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['varTitle']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>	
					</select>			
				</td>
			</tr>
			<tr id="news" <?php if ($this->_tpl_vars['menu']['varModule'] != 'news'): ?>style="display: none;"<?php endif; ?>>
				<td>Новость</td>
				<td>
					<select id="varIdentifier2" name="varIdentifier2" style="width: 250px;">
						<?php $_from = $this->_tpl_vars['news_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
							<option value="<?php echo $this->_tpl_vars['item']['intNewsID']; ?>
"<?php if ($this->_tpl_vars['menu']['varIdentifier'] == $this->_tpl_vars['item']['intNewsID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['varTitle']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>	
					</select>			
				</td>
			</tr>
			<tr id="news_type" <?php if ($this->_tpl_vars['menu']['varModule'] != 'news_type'): ?>style="display: none;"<?php endif; ?>>
				<td>Типы новостей</td>
				<td>
					<select id="varIdentifier3" name="varIdentifier3" style="width: 250px;">
						<?php $_from = $this->_tpl_vars['news_type_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
							<option value="<?php echo $this->_tpl_vars['item']['intNewsTypeID']; ?>
"<?php if ($this->_tpl_vars['menu']['varIdentifier'] == $this->_tpl_vars['item']['intNewsTypeID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['varNameType']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>	
					</select>			
				</td>
			</tr>
			<tr id="promo" <?php if ($this->_tpl_vars['menu']['varModule'] != 'promoakcii'): ?>style="display: none;"<?php endif; ?>>
				<td>Промоакции</td>
				<td>
					<select id="varIdentifier4" name="varIdentifier4" style="width: 250px;">
						<?php $_from = $this->_tpl_vars['promo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
							<option value="<?php echo $this->_tpl_vars['item']['intPromoID']; ?>
"<?php if ($this->_tpl_vars['menu']['varIdentifier'] == $this->_tpl_vars['item']['intPromoID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>	
					</select>			
				</td>
			</tr>
			<tr style="display: none;">
				<td>Относится к меню</td>
				<td>
					<select id="varTypeMenu" name="varTypeMenu" onchange="change_type_menu();">
						<option value="top" <?php if ($this->_tpl_vars['menu']['varTypeMenu'] == 'top'): ?>selected="selected"<?php endif; ?>>Верхнее меню</option>	
						<option value="bottom" <?php if ($this->_tpl_vars['menu']['varTypeMenu'] == 'bottom'): ?>selected="selected"<?php endif; ?>>Нижнее меню</option>	
					</select>				
				</td>
			</tr>
			<tr>
				<td>Добавить изображение</td>
				<td>
				<?php if ($this->_tpl_vars['menu']['varImage']): ?>
					<img src="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['menu']['varImage']; ?>
" width="20" />
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("menu.edit.php?intMenuID=<?php echo $this->_tpl_vars['menu']['intMenuID']; ?>
&varFlag=<?php echo $this->_tpl_vars['menu']['varImage']; ?>
&event=deleteImage", "Вы уверены, что хотите удалить данный файл?")'/>
				<?php else: ?>
					<input type="file" name="varImage" id="varImage" />
				<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td>Родительский пункт меню</td>
				<td>
					<select id="intParentID" name="intParentID">
					<option value="0" rel="free"></option>	
					<?php $_from = $this->_tpl_vars['menu_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<option rel="<?php echo $this->_tpl_vars['item']['varTypeMenu']; ?>
" value="<?php echo $this->_tpl_vars['item']['intMenuID']; ?>
"<?php if ($this->_tpl_vars['item']['intMenuID'] == $this->_tpl_vars['menu']['intParentID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['varTitle']; ?>
</option>						
						<?php if ($this->_tpl_vars['item']['childs']): ?>
							<?php $_from = $this->_tpl_vars['item']['childs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
								<option rel="<?php echo $this->_tpl_vars['item']['varTypeMenu']; ?>
" value="<?php echo $this->_tpl_vars['item']['intMenuID']; ?>
"<?php if ($this->_tpl_vars['item']['intMenuID'] == $this->_tpl_vars['menu']['intParentID']): ?> selected="selected"<?php endif; ?>>&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['item']['varTitle']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>					
						<?php endif; ?>					
					<?php endforeach; endif; unset($_from); ?>
					</select>				
				</td>
			</tr>
			<tr>
				<td>Отображать только авторизированным пользователям</td>
				<td><input  style="float:left;" type="checkbox" id="isAuthorized" name="isAuthorized" value="1"<?php if ($this->_tpl_vars['menu']['isAuthorized'] == '1'): ?> checked="checked"<?php endif; ?> /></td>
			</tr>	
			<tr>
				<td>Отображать</td>
				<td><input  style="float:left;" type="checkbox" id="isVisible" name="isVisible" value="1"<?php if ($this->_tpl_vars['menu']['isVisible'] == '1'): ?> checked="checked"<?php endif; ?> /></td>
			</tr>		
		</tbody>
	</table>
	<div>
		<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
	</div>
</td></tr>
</table>