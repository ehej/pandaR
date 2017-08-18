<?php /* Smarty version 2.6.19, created on 2016-10-27 12:14:54
         compiled from /var/www/pandaH/panda.fm/data/templates/public/country.tpl */ ?>
<div class="innerPage">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/bread_crumbs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<h1><?php echo $this->_tpl_vars['data']['varName']; ?>
</h1>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/country_navigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<table class="countryTitle">
		<tr>
			<td valign="top"><h1 class="no5" style="background-image: url('<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['data']['varFlag']; ?>
')">
				<?php if ($this->_tpl_vars['data']['varName'] == "Таиланд"): ?>
					Таиланд (Тайланд)
				<?php elseif ($this->_tpl_vars['data']['varName'] == "ОАЭ"): ?>
					ОАЭ (Объединенные Арабские Эмираты)
				<?php else: ?>
					<?php echo $this->_tpl_vars['data']['varName']; ?>

				<?php endif; ?></h1>
			</td>
		</tr>
	</table>
	<table width="100%">
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
			<?php echo $this->_tpl_vars['data']['varDescription']; ?>

		</td>
	</tr>
	</table>

	<div class="clear"></div>
</div>

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