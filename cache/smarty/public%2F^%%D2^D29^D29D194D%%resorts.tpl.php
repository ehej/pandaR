<?php /* Smarty version 2.6.19, created on 2016-10-27 12:14:30
         compiled from /var/www/pandaH/panda.fm/data/templates/public/resorts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'substr', '/var/www/pandaH/panda.fm/data/templates/public/resorts.tpl', 6, false),array('modifier', 'escape', '/var/www/pandaH/panda.fm/data/templates/public/resorts.tpl', 20, false),array('modifier', 'strip_tags', '/var/www/pandaH/panda.fm/data/templates/public/resorts.tpl', 21, false),array('modifier', 'truncate', '/var/www/pandaH/panda.fm/data/templates/public/resorts.tpl', 21, false),)), $this); ?>
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
	<table class="countryTitle">
		<tr>
			<td valign="top"><h1 class="no5" style="background-image: url('<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['relation']['varImageFlag'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 3) : substr($_tmp, 0, 3)); ?>
/<?php echo $this->_tpl_vars['relation']['varImageFlag']; ?>
')"><?php echo $this->_tpl_vars['data']['country']['varName']; ?>
 - курорты</h1></td>
		</tr>
	</table>
	<h1><?php echo $this->_tpl_vars['curCountry']['varName']; ?>
</h1>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/country_navigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<form action="">
		<table class="tours-table" width="100%">
			<tr class="table-heading">
				<td class="tour-name"  width="150">Название / курорт</td>
				<td class="tour-name">Краткое описание</td>
			</tr>
			<?php $this->assign('i', 1); ?>
			<?php $_from = $this->_tpl_vars['resort_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>		
			<tr <?php if ($this->_tpl_vars['i']%2 == 1): ?>class="odd"<?php endif; ?>>
				<td class="tour-name"><a href="<?php echo $this->_tpl_vars['item']['link']; ?>
"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</strong></a></td>
				<td align="left"><div class="resort_short"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['varShortDescription'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 120) : smarty_modifier_truncate($_tmp, 120)); ?>
</div></td>
			</tr>
			<?php $this->assign('i', $this->_tpl_vars['i']+1); ?>
			<?php endforeach; endif; unset($_from); ?>
		</table>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'scroller_for_public.tpl', 'smarty_include_vars' => array('pager' => $this->_tpl_vars['hotel']['pager'],'script' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</form>
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
<script type="text/javascript">
<?php echo '
$(function() {
	/*
	$(\'.resort_short\').hover(function() {
		$(this).css(\'overflow\', \'inherit\');
		$(this).addClass(\'hovered\');
	}, function() {
		$(this).css(\'overflow\', \'hidden\')
		$(this).removeClass(\'hovered\');
	})
	*/
})
'; ?>

</script>