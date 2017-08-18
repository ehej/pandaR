<?php /* Smarty version 2.6.19, created on 2016-10-27 12:13:17
         compiled from /var/www/pandaH/panda.fm/data/templates/public/hotels.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'substr', '/var/www/pandaH/panda.fm/data/templates/public/hotels.tpl', 11, false),array('modifier', 'escape', '/var/www/pandaH/panda.fm/data/templates/public/hotels.tpl', 36, false),array('modifier', 'htmlspecialchars_decode', '/var/www/pandaH/panda.fm/data/templates/public/hotels.tpl', 36, false),)), $this); ?>
<div class="innerPage">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/bread_crumbs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<h1><?php echo $this->_tpl_vars['curCountry']['varName']; ?>
</h1>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/country_navigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<table class="countryTitle">
		<tr>
			<td valign="top">
				<?php if ($this->_tpl_vars['data_filter']['intResortID']): ?>
					<h1><?php echo $this->_tpl_vars['FilterName']; ?>
</h1>
				<?php else: ?>
					<h1 class="no5" style="background-image: url('<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['relation']['varImageFlag'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 3) : substr($_tmp, 0, 3)); ?>
/<?php echo $this->_tpl_vars['relation']['varImageFlag']; ?>
')"><?php echo $this->_tpl_vars['Nname']; ?>
</h1>
				<?php endif; ?>
			</td>
		</tr>
	</table>
	<form action="">
   <div class="filter hotels rounded">
		<div class="tl"></div>
		<div class="tr"></div>
		<div class="bl"></div>
		<div class="br"></div>
		<div class="info">
			<table class="content-table">
				<tr class="table-heading">
					<td class="rate-col"  width="100">Категория</td>
					<td>Название</td>
					<td width="150">Курорт</td>
					<!--td width="150">Регион</td-->
					<td width="100">Цена, от</td>
				</tr>
			<?php $this->assign('i', 1); ?>
			<?php $_from = $this->_tpl_vars['hotel']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['hotel_item']):
?>
				<?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
				<tr <?php if ($this->_tpl_vars['i']%2 == 1): ?>class="odd"<?php endif; ?>>
					<td class="first"><span class="rate"><?php echo $this->_tpl_vars['hotel_item']['varCountStars']; ?>
*</span></td>
					<td><a href="<?php echo $this->_tpl_vars['hotel_item']['link']; ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['hotel_item']['varName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('htmlspecialchars_decode', true, $_tmp) : htmlspecialchars_decode($_tmp)); ?>
</a></td>
					<td><?php echo $this->_tpl_vars['resort'][$this->_tpl_vars['hotel_item']['intResortID']]['varName']; ?>
</td>
					<!--td><?php echo $this->_tpl_vars['region'][$this->_tpl_vars['hotel_item']['intRegionID']]['varName']; ?>
</td-->
					<td class="price"><?php echo $this->_tpl_vars['hotel_item']['varPriceAt']; ?>
 <?php echo $this->_tpl_vars['hotel_item']['varMark']; ?>
</td>
				</tr>
				<?php $this->assign('i', $this->_tpl_vars['i']+1); ?>
				<?php endif; ?>
			<?php endforeach; else: ?>
				<tr>
					<td colspan="2" align="center">К сожалению, по данному критерию ничего не найдено</td>
				</tr>
			<?php endif; unset($_from); ?>

		</table>
		</div>
	</div>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'scroller_for_public.tpl', 'smarty_include_vars' => array('pager' => $this->_tpl_vars['hotel']['pager'],'script' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
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