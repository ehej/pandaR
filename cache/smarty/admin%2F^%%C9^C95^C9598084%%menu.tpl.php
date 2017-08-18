<?php /* Smarty version 2.6.19, created on 2016-11-02 13:25:49
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', '/var/www/pandaH/panda.fm/data/templates/admin/menu.tpl', 47, false),array('modifier', 'escape', '/var/www/pandaH/panda.fm/data/templates/admin/menu.tpl', 47, false),)), $this); ?>
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
	$(\'.sort_ul_bottom\').sortable().disableSelection();
	$(\'#btnSaveOrder_bottom\').click(function(){
		var result = [];
		var uls = $(\'.sort_ul_bottom\');
		for(var i=0; i < uls.length; i++) {
			$("<input>", {
				type: \'hidden\',
				name: \'order[\' + parseInt(uls[i].id, 10) + \']\',
				val: $(uls[i]).sortable(\'toArray\')
			}).appendTo(\'#sort_menu_bottom\');
		}
		$(\'#sort_menu_bottom\').submit();
	});
});
'; ?>

</script>
<input type="button" class="iconize" onclick='window.location="menu.edit.php"' rel="23" value="Добавить" />
<br /><br />
<table  width="100%" >
	<tr>
		<td width="50%">
			<h1>Верхнее меню</h1>
			<div id="manage_menu_view">
				<ul class="sort_ul" id="0_ul">
				<?php $_from = $this->_tpl_vars['menu_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
					<li id="<?php echo $this->_tpl_vars['item']['intMenuID']; ?>
">
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td><span style="float:left; font-weight: bold;"><a href="menu.edit.php?intMenuID=<?php echo $this->_tpl_vars['item']['intMenuID']; ?>
" style="<?php if ($this->_tpl_vars['item']['isVisible'] == 0): ?>color:#ccc;<?php endif; ?>" title="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['varTitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['varTitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></td>
							<td>

								<span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu.php?event=delete&intMenuID=<?php echo $this->_tpl_vars['item']['intMenuID']; ?>
', 'Удалить?')"></span>

							</td>
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
									<td><span style="float:left; padding-left: 20px;"><a href="menu.edit.php?event=edit&intMenuID=<?php echo $this->_tpl_vars['ite']['intMenuID']; ?>
" style="<?php if ($this->_tpl_vars['ite']['isVisible'] == 0): ?>color:#ccc;<?php endif; ?>" title="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ite']['varTitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ite']['varTitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></td>
									<td>

										<span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu.php?event=delete&intMenuID=<?php echo $this->_tpl_vars['ite']['intMenuID']; ?>
', 'Удалить?')"></span>
	
									</td>
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
										<td><span style="float:left; padding-left: 20px;"><a href="menu.edit.php?event=edit&intMenuID=<?php echo $this->_tpl_vars['it']['intMenuID']; ?>
" style="<?php if ($this->_tpl_vars['it']['isVisible'] == 0): ?>color:#ccc;<?php endif; ?>" title="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['it']['varTitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['it']['varTitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></td>
										<td>

											<span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu.php?event=delete&intMenuID=<?php echo $this->_tpl_vars['it']['intMenuID']; ?>
', 'Удалить?')"></span>

										</td>
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
				<?php endforeach; endif; unset($_from); ?>
				</ul>
			</div>
			<div style="padding-top: 20px">
			<form action="menu.php?event=saveorder" method="POST" id="sort_menu">
				<input type="button" class="iconize" id="btnSaveOrder" rel="82" value="Сохранить порядок" />
			</form>
			</div>
		</td>
		<td style="display: none;">
			<h1>Нижнее меню</h1>
			<div id="manage_menu_view">
				<ul class="sort_ul_bottom" id="1_ul">
				<?php $_from = $this->_tpl_vars['menu_list_bottom']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
					<li id="<?php echo $this->_tpl_vars['item']['intMenuID']; ?>
">
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td><span style="float:left; font-weight: bold;"><a href="menu.edit.php?intMenuID=<?php echo $this->_tpl_vars['item']['intMenuID']; ?>
" style="<?php if ($this->_tpl_vars['item']['isVisible'] == 0): ?>color:#ccc;<?php endif; ?>" title="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['varTitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['varTitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></td>
							<td>

								<span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu.php?event=delete&intMenuID=<?php echo $this->_tpl_vars['item']['intMenuID']; ?>
', 'Удалить?')"></span>

							</td>
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
									<td><span style="float:left; padding-left: 20px;"><a href="menu.edit.php?event=edit&intMenuID=<?php echo $this->_tpl_vars['ite']['intMenuID']; ?>
" style="<?php if ($this->_tpl_vars['ite']['isVisible'] == 0): ?>color:#ccc;<?php endif; ?>" title="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ite']['varTitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ite']['varTitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></td>
									<td>

										<span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu.php?event=delete&intMenuID=<?php echo $this->_tpl_vars['ite']['intMenuID']; ?>
', 'Удалить?')"></span>

									</td>
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
										<td><span style="float:left; padding-left: 20px;"><a href="menu.edit.php?event=edit&intMenuID=<?php echo $this->_tpl_vars['it']['intMenuID']; ?>
" style="<?php if ($this->_tpl_vars['it']['isVisible'] == 0): ?>color:#ccc;<?php endif; ?>" title="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['it']['varTitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['it']['varTitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></td>
										<td>

											<span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu.php?event=delete&intMenuID=<?php echo $this->_tpl_vars['it']['intMenuID']; ?>
', 'Удалить?')"></span>

										</td>
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
				<?php endforeach; endif; unset($_from); ?>
				</ul>
			</div>
			<div style="padding-top: 20px">
			<form action="menu.php?event=saveorder" method="POST" id="sort_menu_bottom">
				<input type="button" class="iconize" id="btnSaveOrder_bottom" rel="82" value="Сохранить порядок" />
			</form>
			</div>
		
		</td>
	</tr>
</table>	
<div>
<br />
<p class="info">
Для того, чтобы изменить порядок следования пунктов меню, используйте перетаскивание мышью.<br />
Чтобы система запомнила текущий порядок - нажмите "Сохранить порядок"
</p>
</div>