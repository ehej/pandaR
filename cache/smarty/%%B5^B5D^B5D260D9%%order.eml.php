<?php /* Smarty version 2.6.19, created on 2016-11-30 08:07:29
         compiled from order.eml */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'order.eml', 17, false),)), $this); ?>
<br /><br />
<table width="500" border="0" cellspacing="0" cellpadding="0"> 
	<tr> 
        <td><span>Ф.И.О.</span></td> 
        <td><?php echo $this->_tpl_vars['data']['varFIO']; ?>
</td> 
    </tr> 
	<tr> 
		<td><span>Телефон</span></td> 
		<td><?php echo $this->_tpl_vars['data']['varTel']; ?>
</td>
	</tr> 
	<tr> 
        <td><span>E-mail</span></td> 
        <td><?php echo $this->_tpl_vars['data']['varMail']; ?>
</td>
	</tr> 
	<tr> 
        <td><span>Комментарий</span></td>
        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['varComments'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
    </tr> 
    <tr> 
		<td><span>Тур</span></td>
		<td><a href="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
tours.php?intTourID=<?php echo $this->_tpl_vars['data']['intTourID']; ?>
"><?php echo $this->_tpl_vars['data']['varName']; ?>
</a></td>
	</tr> 
	<?php if ($this->_tpl_vars['data']['varDateFrom'] || $this->_tpl_vars['data']['varDateTo']): ?>
	<tr> 
        <td><span>Дата</span></td>
        <td>С <?php echo $this->_tpl_vars['data']['varDateFrom']; ?>
 <?php if ($this->_tpl_vars['data']['varDateTo']): ?>по <?php echo $this->_tpl_vars['data']['varDateTo']; ?>
<?php endif; ?></td>
  	</tr>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['data']['intDays']): ?>
	<tr> 
        <td><span>Дней</span></td>
        <td><?php echo $this->_tpl_vars['data']['intDays']; ?>
</td>
  	</tr>
	<?php endif; ?>
</table>