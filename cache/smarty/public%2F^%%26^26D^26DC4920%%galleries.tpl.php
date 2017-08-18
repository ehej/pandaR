<?php /* Smarty version 2.6.19, created on 2016-10-27 15:24:39
         compiled from galleries.tpl */ ?>
<?php if ($this->_tpl_vars['galleries']): ?>
<div class="galleries">
	<?php $_from = $this->_tpl_vars['galleries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<?php if (count ( $this->_tpl_vars['gallsImages'][$this->_tpl_vars['item']['intGalleryID']] ) > 0): ?>
			<div class="clear"></div>
			<div><h2><?php echo $this->_tpl_vars['item']['varTitle']; ?>
</h2></div>
			<div class="clear"></div>
			<?php $_from = $this->_tpl_vars['gallsImages'][$this->_tpl_vars['item']['intGalleryID']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['image'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['image']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['it']):
        $this->_foreach['image']['iteration']++;
?>
				<div style="float: left;width: 221px;">
					<div style=" margin: 10px 2px; width: 217px; height: 170px; background-image: url(<?php echo $this->_tpl_vars['it']['imageUrl']; ?>
); background-repeat: no-repeat; background-position: center center;">
						<a class="lightbox" rel="lytebox[gallery]" id="lb_href_<?php echo $this->_tpl_vars['it']['intImageID']; ?>
" title="<?php echo $this->_tpl_vars['it']['varTitle']; ?>
" href="/_watermark.php?img=<?php echo $this->_tpl_vars['it']['imageOrigUrl']; ?>
" style="width: 217px; height: 170px; display: block;" onclick="javascript:$.noop();">&nbsp;</a>
					</div>
					<a href="javascript:void(0);" onclick="$('#lb_href_<?php echo $this->_tpl_vars['it']['intImageID']; ?>
').click();"><?php echo $this->_tpl_vars['it']['varTitle']; ?>
</a>
				</div>
				<?php if ($this->_foreach['image']['iteration'] % 8 == 0): ?><div class="clear"></div><?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>