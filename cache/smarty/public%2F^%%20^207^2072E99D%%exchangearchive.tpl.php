<?php /* Smarty version 2.6.19, created on 2016-10-27 13:47:31
         compiled from /var/www/pandaH/panda.fm/data/templates/public/exchangearchive.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '/var/www/pandaH/panda.fm/data/templates/public/exchangearchive.tpl', 18, false),)), $this); ?>

            <div class="innerPage">

				<h1>Архив курса валют</h1>
				<?php $this->assign('i', 1); ?>
				<table class="tours-table" width="100%">
				<tr class="table-heading">
					<td class="tour-name" width="100">Дата</td>
						<?php $_from = $this->_tpl_vars['currency']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<?php if ($this->_tpl_vars['item']['intCurrencyID'] != 1): ?><td  class="tour-name"><?php echo $this->_tpl_vars['item']['varName']; ?>
</td><?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					</tr>
					<tr class="odd">
					<?php $_from = $this->_tpl_vars['archive']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['archivecurr'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['archivecurr']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['archivecurr']['iteration']++;
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
						<?php if (( $this->_tpl_vars['aid'] != $this->_tpl_vars['item']['intArchiveID'] && ! ($this->_foreach['archivecurr']['iteration'] <= 1) )): ?>
						</tr>
						<tr <?php if ($this->_tpl_vars['i']%2 == 1): ?>class="odd"<?php endif; ?>>
							<td style="text-align: left;"  class="tour-name"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</strong></td>
						<?php endif; ?>
						<?php if (! $this->_tpl_vars['aid']): ?>
							<td style="text-align: left;"  class="tour-name"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</strong></td>
						<?php endif; ?>
						<?php $this->assign('i', $this->_tpl_vars['i']+1); ?>
						<?php $this->assign('aid', $this->_tpl_vars['item']['intArchiveID']); ?>
						<?php $_from = $this->_tpl_vars['currency']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['it']):
?>
							<?php if ($this->_tpl_vars['it']['intCurrencyID'] == $this->_tpl_vars['item']['intCurrencyID'] && $this->_tpl_vars['item']['intCurrencyID'] != 1): ?>
								<td  style="text-align: left;"><?php echo $this->_tpl_vars['item']['intRate']; ?>
</td>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?><?php endforeach; endif; unset($_from); ?>
					</tr>
				</table>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'scroller_for_public.tpl', 'smarty_include_vars' => array('pager' => $this->_tpl_vars['archive']['pager'],'script' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>