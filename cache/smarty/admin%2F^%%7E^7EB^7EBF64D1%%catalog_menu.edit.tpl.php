<?php /* Smarty version 2.6.19, created on 2016-11-02 13:29:43
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/catalog_menu.edit.tpl */ ?>
<?php echo '
<script type="text/javascript" src="/js/colorpicker.js"></script>
<script type="text/javascript">	
	$(document).ready(function(){
		$(\'#varColor\').ColorPicker({
	  		onSubmit: function(hsb, hex, rgb) {
	    		$(\'#varColor\').val(hex);
	  		},
	  		onBeforeShow: function () {
	    		$(this).ColorPickerSetColor(this.value);
	  		},
	  		onChange: function (hsb, hex, rgb) {
	  			$(\'#varColor\').val(hex);
	  		}
	 	})
	.bind(\'keyup\', function(){
	  	$(this).ColorPickerSetColor(this.value);
		});
	});
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
			case \'link\'					: $(\'#link\').show(); $(\'#varUrl\').val(\'\'); break;
			case \'page\'					: $(\'#page\').show(); break;
			case \'news\'					: $(\'#news\').show(); break;
			case \'news_type\'			: $(\'#news_type\').show(); break;
			case \'promoakcii\'			: $(\'#promo\').show(); break;
		}
	}
</script>
'; ?>

<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("catalog_menu.php?<?php if ($this->_tpl_vars['type'] == 'country'): ?>intCountryID<?php else: ?>intResortID<?php endif; ?>=<?php echo $this->_tpl_vars['menu']['intCountryID']; ?>
")'/>
<form action="catalog_menu.edit.php?<?php echo $this->_tpl_vars['QUERY_STRING']; ?>
" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intMenuID" id="intMenuID" value="<?php echo $this->_tpl_vars['menu']['intMenuID']; ?>
" />
<input type="hidden" name="intSortOrder" id="intSortOrder" value="<?php echo $this->_tpl_vars['menu']['intSortOrder']; ?>
" />
<input type="hidden" name="intCountryID" id="intCountryID" value="<?php echo $this->_tpl_vars['menu']['intCountryID']; ?>
" />

<table width="100%" class="container"><tr><td width="50%">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Общие данные</th></tr></thead>
		<tbody>		
			<tr>
				<td>Название</td>
				<td><input type="text" name="varTitle" id="varTitle" value="<?php echo $this->_tpl_vars['menu']['varTitle']; ?>
" style="width: 200px;" /></td>
			</tr>
			<tr>
				<td>Модуль</td>
				<td>
					<select id="varModule" name="varModule" onchange="setTarget(this.value)">
						<?php $_from = $this->_tpl_vars['modules_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<?php if ($this->_tpl_vars['item']['varPage'] != 'documents' && $this->_tpl_vars['item']['varPage'] != 'regions'): ?>
						<option value="<?php echo $this->_tpl_vars['item']['varPage']; ?>
" <?php if ($this->_tpl_vars['menu']['varModule'] == $this->_tpl_vars['item']['varPage']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['varTitle']; ?>
</option>
						<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					</select>					
				</td>
			</tr>	
			<?php if (! $this->_tpl_vars['menu']): ?>
			<tr id="link">
				<td>Ссылка</td>
				<td><input type="text" id="varUrl" name="varUrl" value="" /></td>
			</tr>
			<?php endif; ?>
			<tr id="link" <?php if ($this->_tpl_vars['menu']['varModule'] != 'link'): ?>style="display: none;"<?php endif; ?>>
				<td>Ссылка</td>
				<td><input type="text" id="varUrl" name="varUrl" value="<?php echo $this->_tpl_vars['menu']['varUrl']; ?>
" /></td>
			</tr>		
			<tr id="page" <?php if ($this->_tpl_vars['menu']['varModule'] != 'page'): ?>style="display: none;"<?php endif; ?>>
				<td>Страница</td>
				<td>
					<select id="varIdentifier1" name="varIdentifier1" style="width: 100px;">
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
					<select id="varIdentifier2" name="varIdentifier2" style="width: 100px;">
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
			<tr>
				<td>Отображать</td>
				<td><input  style="float:left;" type="checkbox" id="isVisible" name="isVisible" value="1"<?php if ($this->_tpl_vars['menu']['isVisible'] != '0'): ?> checked="checked"<?php endif; ?> /></td>
			</tr>
		</tbody>
	</table>
	<div>
		<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
	</div>
</td></tr>
</table>