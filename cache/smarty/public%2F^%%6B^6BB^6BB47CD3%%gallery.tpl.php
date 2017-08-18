<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:16
         compiled from layout/gallery.tpl */ ?>
<?php if ($this->_tpl_vars['gallsImages']): ?>
	<div class="gallery-holder">
		<div class="gallery" style="position: relative;">
			<ul id="gallery" class="jcarousel-skin-tango">
				<?php $_from = $this->_tpl_vars['gallsImages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['items']):
?>
						<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
							<li class="rolls">
								<a href="<?php echo $this->_tpl_vars['item']['imageOrigUrl']; ?>
" rel="lytebox[photo]" style="text-decoration:none;">
									<img  width="150" src="<?php echo $this->_tpl_vars['item']['imageOrigUrl']; ?>
" title="<?php echo $this->_tpl_vars['item']['varTitle']; ?>
" alt="<?php echo $this->_tpl_vars['item']['varTitle']; ?>
" border="0"/>
								</a>
							</li>
						<?php endforeach; endif; unset($_from); ?>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
    <br>
	<?php echo '
    <script type="text/javascript">
        $( function() {
            $(\'#mycarousel\').jcarousel({ 
                scroll:1,
				vertical: true
            });
            $(\'#gallery\').jcarousel({
                scroll:2,
				vertical:false
            });
        });
    </script>
	'; ?>

	</div>
<?php endif; ?>