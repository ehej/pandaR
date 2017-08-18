<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:16
         compiled from layout/managers.tpl */ ?>
<?php if ($this->_tpl_vars['managers']): ?>
<div class="manager-box-tr">
	<div class="manager-box-br">
		<div class="manager-box">
			<h3 class="managers-title">Менеджеры</h3>
			<ul class="managers">
				<li>
				<?php $_from = $this->_tpl_vars['managers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['name']['iteration']++;
?>
				<?php if ($this->_foreach['name']['iteration'] % 2 != 0 && $this->_foreach['name']['iteration'] != 1): ?>
				</li>
				<li>
				<?php endif; ?>
					<br clear="all" />
					<?php if ($this->_tpl_vars['item']['varFoto']): ?><img src="<?php echo $this->_tpl_vars['path']; ?>
<?php echo $this->_tpl_vars['item']['varFoto']; ?>
" alt="" width="70" /><?php endif; ?>
					<strong class="name"><?php echo $this->_tpl_vars['item']['varName']; ?>
</strong>
					<ul>
						<?php $_from = $this->_tpl_vars['item']['contact']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['it']):
?>
						<li> 
							<?php if ($this->_tpl_vars['it']['varStaffType'] == 'phone'): ?><span>тел: </span><?php endif; ?>
							<?php if ($this->_tpl_vars['it']['varStaffType'] == 'email'): ?><span>email: </span><?php endif; ?>
							<?php if ($this->_tpl_vars['it']['varStaffType'] == 'mobile'): ?><span>моб: </span><?php endif; ?>
							<?php if ($this->_tpl_vars['it']['varStaffType'] == 'icq'): ?><span>icq: </span><?php endif; ?>
							<?php if ($this->_tpl_vars['it']['varStaffType'] == 'skype'): ?><span>skype: </span><?php endif; ?>
							<?php echo $this->_tpl_vars['it']['varText']; ?>
<br>
						</li>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
					<br clear="all" />
				<?php endforeach; endif; unset($_from); ?>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php endif; ?>