<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:16
         compiled from layout/country_navigation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'layout/country_navigation.tpl', 5, false),)), $this); ?>
<?php if ($this->_tpl_vars['curCountryID'] && $this->_tpl_vars['curCountryID'] > 0): ?>
<table width="100%" class="country-menu"><tr>
	<?php $_from = $this->_tpl_vars['menuCountries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<?php if ($this->_tpl_vars['item']['intCountryID'] == $this->_tpl_vars['curCountryID']): ?>
		<td class="<?php if ($this->_tpl_vars['REQUEST_URI'] == ((is_array($_tmp='/countries/')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['curCountry']['varUrlAlias']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['curCountry']['varUrlAlias']))): ?>current<?php endif; ?>">
			<a href="/countries/<?php echo $this->_tpl_vars['curCountry']['varUrlAlias']; ?>
"><span>О стране</span></a>
			<?php if ($this->_tpl_vars['REQUEST_URI'] == ((is_array($_tmp="/countries/")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['curCountry']['varUrlAlias']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['curCountry']['varUrlAlias']))): ?><span class="arrow"></span><?php endif; ?>
		</td>
		<?php $_from = $this->_tpl_vars['item']['chield']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['it']):
?>
			<td class="<?php if ($this->_tpl_vars['REQUEST_URI'] == $this->_tpl_vars['it']['link'] || $this->_tpl_vars['ModuleMenu'] == $this->_tpl_vars['it']['varModule']): ?>current<?php endif; ?>">
				<a href="<?php echo $this->_tpl_vars['it']['link']; ?>
"><span><?php echo $this->_tpl_vars['it']['varTitle']; ?>
</span></a>
				<?php if ($this->_tpl_vars['REQUEST_URI'] == $this->_tpl_vars['it']['link'] || $this->_tpl_vars['ModuleMenu'] == $this->_tpl_vars['it']['varModule']): ?><span class="arrow"></span><?php endif; ?>
			</td>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
</tr></table>
<?php endif; ?>