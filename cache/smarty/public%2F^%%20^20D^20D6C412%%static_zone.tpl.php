<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:16
         compiled from static_zone.tpl */ ?>
<?php if ($this->_tpl_vars['template'] == 'default'): ?>
	<?php $_from = $this->_tpl_vars['zone']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
		<div class="static_zone_<?php echo $this->_tpl_vars['item']['varPosition']; ?>
" id="static_zone_<?php echo $this->_tpl_vars['item']['intSZID']; ?>
">
			<?php if ($this->_tpl_vars['item']['varText']): ?>
				<div class="sz_text">
					<?php if ($this->_tpl_vars['item']['varLink'] != ''): ?>
						<a href="<?php echo $this->_tpl_vars['item']['varLink']; ?>
"><?php echo $this->_tpl_vars['item']['varText']; ?>
</a>
					<?php else: ?>	
						<?php echo $this->_tpl_vars['item']['varText']; ?>

					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['item']['varImage']): ?>
				<div class="sz_image">
					<?php if ($this->_tpl_vars['item']['varLink'] != ''): ?>
						<a href="<?php echo $this->_tpl_vars['item']['varLink']; ?>
"><img src="<?php echo $this->_tpl_vars['static_zone_path']; ?>
<?php echo $this->_tpl_vars['item']['varImage']; ?>
"></a>
					<?php else: ?>	
						<img src="<?php echo $this->_tpl_vars['static_zone_path']; ?>
<?php echo $this->_tpl_vars['item']['varImage']; ?>
">
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endforeach; endif; unset($_from); ?>
	<div class="clear"></div>
<?php endif; ?>
<?php if ($this->_tpl_vars['template'] == 'bottom_menu'): ?>
	<?php $_from = $this->_tpl_vars['zone']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
		<div class="static_zone_<?php echo $this->_tpl_vars['item']['varPosition']; ?>
" id="static_zone_<?php echo $this->_tpl_vars['item']['intSZID']; ?>
">
			<?php echo $this->_tpl_vars['item']['varText']; ?>

		</div>
	<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['template'] == 'footer'): ?>
	<?php $_from = $this->_tpl_vars['zone']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
		<div class="static_zone_<?php echo $this->_tpl_vars['item']['varPosition']; ?>
" id="static_zone_<?php echo $this->_tpl_vars['item']['intSZID']; ?>
">
			<?php echo $this->_tpl_vars['item']['varText']; ?>

		</div>
	<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>