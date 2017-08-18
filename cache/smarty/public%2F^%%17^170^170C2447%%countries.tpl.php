<?php /* Smarty version 2.6.19, created on 2016-10-27 16:00:36
         compiled from /var/www/pandaH/panda.fm/data/templates/public/countries.tpl */ ?>
<div class="innerPage">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/bread_crumbs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/country_navigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>  	
		<div class="country-img">
			<a href="<?php echo $this->_tpl_vars['item']['link']; ?>
"><img class="no5" src='<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['item']['varFlag']; ?>
' style="width:150px"></span>
			<br>
			<h2><?php echo $this->_tpl_vars['item']['varName']; ?>
</h2></a>
		</div>
	   <?php endforeach; endif; unset($_from); ?>
	
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
    <div class="clear"></div>
</div>