<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:16
         compiled from layout/slider.tpl */ ?>
<div class="slider">
	<div class="slider-content">
		<?php $_from = $this->_tpl_vars['generalgallery']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<div class="slide">
			<a href="<?php echo $this->_tpl_vars['item']['varLink']; ?>
">
				<img src="<?php echo $this->_tpl_vars['bannerpath']; ?>
<?php echo $this->_tpl_vars['item']['varImage']; ?>
"  alt="" />
				<?php if ($this->_tpl_vars['item']['varDescription']): ?>
				<div class="slide-description">
					<div class="desc-title"><?php echo $this->_tpl_vars['item']['varDescription']; ?>
</div>
				</div>
				<?php endif; ?>
			</a>
		</div>
		<?php endforeach; endif; unset($_from); ?>
	</div>
	<ul class="slider-menu">
	<?php $_from = $this->_tpl_vars['generalgallery']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
		<li>
			<a href="#<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</a>
			<div class="menu_arrow"></div>
		</li>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
	<span class="slider-lc"></span>
	<span class="slider-rc"></span>
</div> 
<!--end slider -->
