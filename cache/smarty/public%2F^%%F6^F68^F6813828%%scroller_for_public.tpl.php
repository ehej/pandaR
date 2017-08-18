<?php /* Smarty version 2.6.19, created on 2016-10-27 12:13:17
         compiled from scroller_for_public.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'scroller_for_public.tpl', 8, false),)), $this); ?>
<?php if ($this->_tpl_vars['pager']): ?><?php if ($this->_tpl_vars['script']): ?><div class="pager"><input type="hidden" name="<?php echo $this->_tpl_vars['prefix']; ?>
page" id="<?php echo $this->_tpl_vars['prefix']; ?>
page" value="<?php echo $this->_tpl_vars['pager']['current_page']; ?>
" />
	<?php if ($this->_tpl_vars['pager']['current_page'] > 1): ?><a href="javascript:loadPage(<?php echo $this->_tpl_vars['pager']['current_page']-1; ?>
,'<?php echo $this->_tpl_vars['prefix']; ?>
')" style="color: #0a5095; font-size: 14px; text-decoration: none;" title="Назад">←</a>&nbsp;<?php endif; ?>
	<?php $_from = $this->_tpl_vars['pager']['page']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
	<a href="javascript:loadPage(<?php echo $this->_tpl_vars['page']; ?>
,'<?php echo $this->_tpl_vars['prefix']; ?>
')" style="color: #0a5095; font-size: 14px; text-decoration: none;<?php if ($this->_tpl_vars['pager']['current_page'] == $this->_tpl_vars['page']): ?> font-weight: bold; text-decoration: underline; font-size: 16px;<?php endif; ?>"><?php echo $this->_tpl_vars['page']; ?>
</a>&nbsp;
	<?php endforeach; endif; unset($_from); ?>
	<?php if ($this->_tpl_vars['pager']['current_page'] < $this->_tpl_vars['pager']['last_page']): ?><a href="javascript:loadPage(<?php echo $this->_tpl_vars['pager']['current_page']+1; ?>
,'<?php echo $this->_tpl_vars['prefix']; ?>
')" style="color: #0a5095; font-size: 14px; text-decoration: none;" title="Вперед">→</a>&nbsp;<?php endif; ?></div>
<?php else: ?><div class="pager">
	<?php if ($this->_tpl_vars['pager']['current_page'] > 1): ?><a href="?<?php echo $this->_tpl_vars['prefix']; ?>
p=<?php echo $this->_tpl_vars['pager']['current_page']-1; ?>
<?php echo ((is_array($_tmp=@$this->_tpl_vars['query'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" style="color: #0a5095; font-size: 14px; text-decoration: none;" title="Назад">←</a>&nbsp;<?php endif; ?>
	<?php $_from = $this->_tpl_vars['pager']['page']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
	<a href="?<?php echo $this->_tpl_vars['prefix']; ?>
p=<?php echo $this->_tpl_vars['page']; ?>
<?php echo ((is_array($_tmp=@$this->_tpl_vars['query'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" style="color: #0a5095; font-size: 14px; text-decoration: none;<?php if ($this->_tpl_vars['pager']['current_page'] == $this->_tpl_vars['page']): ?> font-weight: bold; text-decoration: underline; font-size: 16px;<?php endif; ?>"><?php echo $this->_tpl_vars['page']; ?>
</a>&nbsp;
	<?php endforeach; endif; unset($_from); ?>
	<?php if ($this->_tpl_vars['pager']['current_page'] < $this->_tpl_vars['pager']['last_page']): ?><a href="?<?php echo $this->_tpl_vars['prefix']; ?>
p=<?php echo $this->_tpl_vars['pager']['current_page']+1; ?>
<?php echo ((is_array($_tmp=@$this->_tpl_vars['query'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" style="color: #0a5095; font-size: 14px; text-decoration: none;" title="Вперед">→</a>&nbsp;<?php endif; ?></div>
<?php endif; ?><?php endif; ?>