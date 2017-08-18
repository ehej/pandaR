<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:16
         compiled from layout/navigation.tpl */ ?>
<div class="menu">
	<table width="100%"><tr>
		<?php $_from = $this->_tpl_vars['menuArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['menu']['iteration']++;
?>
		<td <?php if ($this->_tpl_vars['REQUEST_URI'] == $this->_tpl_vars['item']['link']): ?>class="activemenu"<?php endif; ?>><a href="<?php if ($this->_tpl_vars['item']['varModule'] == 'tourtypes'): ?><?php echo $this->_tpl_vars['item']['varUrl']; ?>
<?php else: ?><?php echo $this->_tpl_vars['item']['link']; ?>
<?php endif; ?>"><span><?php if ($this->_tpl_vars['item']['varImage']): ?><img src="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['item']['varImage']; ?>
" title="<?php echo $this->_tpl_vars['item']['varTitle']; ?>
" alt="<?php echo $this->_tpl_vars['item']['varTitle']; ?>
"/><?php else: ?><?php echo $this->_tpl_vars['item']['varTitle']; ?>
<?php endif; ?></span></a>
		<?php if ($this->_tpl_vars['item']['varModule'] == 'tourtypes'): ?>
			<ul>
			<?php $_from = $this->_tpl_vars['tourtypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
				<li><a href="/tours-country/tourtype/<?php echo $this->_tpl_vars['item2']['intTypeID']; ?>
"><?php echo $this->_tpl_vars['item2']['varName']; ?>
</a></li>
			<?php endforeach; endif; unset($_from); ?>
			</ul>
		<?php elseif (! empty ( $this->_tpl_vars['item']['chield'] )): ?>
			<ul>
			<?php $_from = $this->_tpl_vars['item']['chield']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
				<li><a href="<?php echo $this->_tpl_vars['item2']['link']; ?>
"><?php echo $this->_tpl_vars['item2']['varTitle']; ?>
</a></li>
			<?php endforeach; endif; unset($_from); ?>
			</ul>
		<?php endif; ?>
		</td>
		<?php endforeach; endif; unset($_from); ?>
	</tr></table>
	<span class="menu-lc"></span>
	<span class="menu-rc"></span>
</div>