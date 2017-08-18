<?php /* Smarty version 2.6.19, created on 2016-11-02 13:29:38
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/catalog_menu.tpl */ ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript">
<?php echo '
	$(document).ready(function(){
		$(\'.sort_ul\').sortable().disableSelection();
		$(\'#btnSaveOrder\').click(function(){
			var result = [];
			var uls = $(\'.sort_ul\');
			for(var i=0; i < uls.length; i++) {
				$("<input>", {
					type: \'hidden\',
					name: \'order[\' + parseInt(uls[i].id, 10) + \']\',
					val: $(uls[i]).sortable(\'toArray\')
				}).appendTo(\'#sort_menu\');
			}
			$(\'#sort_menu\').submit();
		});
	});
'; ?>

</script>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("<?php if ($this->_tpl_vars['type'] == 'country'): ?>countries_catalog.php<?php else: ?>resorts_catalog.php<?php endif; ?>")'/>
<input type="button" class="iconize" onclick='document.location.href="catalog_menu.edit.php?intParentID=<?php echo $this->_tpl_vars['intParentID']; ?>
&type=<?php echo $this->_tpl_vars['type']; ?>
"' rel="23" value="Добавить" />
<br /><br />
<div id="manage_menu_view">
	<ul class="sort_ul" id="0_ul">
	<?php $_from = $this->_tpl_vars['menu_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<?php if ($this->_tpl_vars['item']['intParentID'] != 0): ?>
		<li id="<?php echo $this->_tpl_vars['item']['intMenuID']; ?>
">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td><span style="float:left;"><a href="catalog_menu.edit.php?intParentID=<?php echo $this->_tpl_vars['intParentID']; ?>
&type=<?php echo $this->_tpl_vars['type']; ?>
&intMenuID=<?php echo $this->_tpl_vars['item']['intMenuID']; ?>
" title="<?php echo $this->_tpl_vars['item']['varTitle']; ?>
"><?php echo $this->_tpl_vars['item']['varTitle']; ?>
</a></td>
				<td><span class="iconset iconize" style="margin-left: 10px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('catalog_menu.php?<?php if ($this->_tpl_vars['type'] == 'country'): ?>intCountryID<?php else: ?>intResortID<?php endif; ?>=<?php echo $this->_tpl_vars['intParentID']; ?>
&event=Delete&intMenuID=<?php echo $this->_tpl_vars['item']['intMenuID']; ?>
', 'Удалить?')"></span></td>
			</tr>
		</table>					
		<?php if ($this->_tpl_vars['item']['childs']): ?>
			<ul class="sort_ul" id="<?php echo $this->_tpl_vars['item']['intMenuID']; ?>
_ul">
			<?php $_from = $this->_tpl_vars['item']['childs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ite']):
?>
				<li id="<?php echo $this->_tpl_vars['ite']['intMenuID']; ?>
">
				<table cellspacing="0" cellpadding="0" style="margin-left:10px;">
					<tr>
						<td><span style="float:left; padding-left: 20px;"><a href="catalog_menu.edit.php?intParentID=<?php echo $this->_tpl_vars['intParentID']; ?>
&type=<?php echo $this->_tpl_vars['type']; ?>
&intMenuID=<?php echo $this->_tpl_vars['ite']['intMenuID']; ?>
" title="<?php echo $this->_tpl_vars['ite']['varTitle']; ?>
"><?php echo $this->_tpl_vars['ite']['varTitle']; ?>
</a></td>
						<td><span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('catalog_menu.php?<?php if ($this->_tpl_vars['type'] == 'country'): ?>intCountryID<?php else: ?>intResortID<?php endif; ?>=<?php echo $this->_tpl_vars['intParentID']; ?>
&event=Delete&intMenuID=<?php echo $this->_tpl_vars['ite']['intMenuID']; ?>
', 'Удалить?')"></span></td>
					</tr>
				</table>
				<?php if ($this->_tpl_vars['ite']['childs']): ?>
				<ul class="sort_ul" id="<?php echo $this->_tpl_vars['ite']['intMenuID']; ?>
_ul">
				<?php $_from = $this->_tpl_vars['ite']['childs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['it']):
?>
					<li id="<?php echo $this->_tpl_vars['it']['intMenuID']; ?>
">
					<table cellspacing="0" cellpadding="0" style="margin-left:40px;">
						<tr>
							<td><span style="float:left; padding-left: 20px;"><a href="catalog_menu.edit.php?intParentID=<?php echo $this->_tpl_vars['intParentID']; ?>
&type=<?php echo $this->_tpl_vars['type']; ?>
&intMenuID=<?php echo $this->_tpl_vars['it']['intMenuID']; ?>
" title="<?php echo $this->_tpl_vars['it']['varTitle']; ?>
"><?php echo $this->_tpl_vars['it']['varTitle']; ?>
</a></td>
							<td><span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('catalog_menu.php?<?php if ($this->_tpl_vars['type'] == 'country'): ?>intCountryID<?php else: ?>intResortID<?php endif; ?>=<?php echo $this->_tpl_vars['intParentID']; ?>
&event=Delete&intMenuID=<?php echo $this->_tpl_vars['it']['intMenuID']; ?>
', 'Удалить?')"></span></td>
						</tr>
					</table>
					</li>
				<?php endforeach; endif; unset($_from); ?>
				</ul>		
			<?php endif; ?>
				</li>
			<?php endforeach; endif; unset($_from); ?>
			</ul>		
		<?php endif; ?>
		</li>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<div style="padding-top: 20px">
<form action="catalog_menu.php?<?php if ($this->_tpl_vars['type'] == 'country'): ?>intCountryID<?php else: ?>intResortID<?php endif; ?>=<?php echo $this->_tpl_vars['intCountryID']; ?>
&event=saveorder&flagSubmenu=false" method="POST" id="sort_menu">
	<input type="button" class="iconize" id="btnSaveOrder" rel="82" value="Сохранить порядок" />
</form>
<br />
<p class="info">
Для того, чтобы изменить порядок следования пунктов меню, используйте перетаскивание мышью.<br />
Чтобы система запомнила текущий порядок - нажмите "Сохранить порядок"
</p>
</div>