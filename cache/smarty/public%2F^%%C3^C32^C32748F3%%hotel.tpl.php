<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:31
         compiled from /var/www/pandaH/panda.fm/data/templates/public/hotel.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "banners.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="innerPage">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/bread_crumbs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div class="Title">
		<h1><?php echo $this->_tpl_vars['curCountry']['varName']; ?>
</h1>
	</div>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/country_navigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
	<table width="100%" style="min-width: 800px;">
	<tr>
		<?php if ($this->_tpl_vars['gallsImages']): ?>
		<td>
			<center><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/gallery.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></center>
			</td>
		<tr>
		</tr>
		<?php endif; ?>
		<td>
		<?php if ($this->_tpl_vars['data']['varLogo']): ?><div style="padding: 15px 0px;"><img src="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['data']['varLogo']; ?>
" /></div><?php endif; ?>
		<h1><?php echo $this->_tpl_vars['data']['varName']; ?>
 <span class="hotelstars star<?php echo $this->_tpl_vars['data']['varCountStars']; ?>
"></span></h1>
		<?php echo $this->_tpl_vars['data']['varDescription']; ?>

		</td>
	</tr>
	</table>

	<div class="clear"></div>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "comments.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "contests.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div class="clear"></div>