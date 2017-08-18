<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:16
         compiled from layout/bread_crumbs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'layout/bread_crumbs.tpl', 5, false),)), $this); ?>
<?php if ($this->_tpl_vars['breadCrumbs']): ?>
	<div class="breadscrumb">
		<?php $_from = $this->_tpl_vars['breadCrumbs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['breadCrumbs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['breadCrumbs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['breadCrumbs']['iteration']++;
?>
		<?php if ($this->_tpl_vars['item']['thisPage']): ?>
			<span><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 35) : smarty_modifier_truncate($_tmp, 35)); ?>
</span>
		<?php else: ?>
        	<a href="<?php echo $this->_tpl_vars['item']['url']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 35) : smarty_modifier_truncate($_tmp, 35)); ?>
</a>
        <?php endif; ?>
		<?php if (($this->_foreach['breadCrumbs']['iteration'] == $this->_foreach['breadCrumbs']['total']) == false): ?>   &nbsp;&rarr;&nbsp;  <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    </div>
<?php endif; ?>