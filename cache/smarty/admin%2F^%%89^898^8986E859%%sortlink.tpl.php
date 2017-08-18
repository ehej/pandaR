<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:24
         compiled from sortlink.tpl */ ?>
<?php if ($this->_tpl_vars['script']): ?>
<a href="javascript:sortByField('<?php echo $this->_tpl_vars['field']; ?>
','<?php if ($this->_tpl_vars['sortby'] == $this->_tpl_vars['field']): ?><?php if ($this->_tpl_vars['sortorder']): ?>0<?php else: ?>1<?php endif; ?><?php else: ?>0<?php endif; ?>'<?php if ($this->_tpl_vars['prefix']): ?>,'<?php echo $this->_tpl_vars['prefix']; ?>
'<?php endif; ?>);"><?php echo $this->_tpl_vars['text']; ?>
</a>&nbsp;<?php if ($this->_tpl_vars['sortby'] == $this->_tpl_vars['field']): ?><?php if (! $this->_tpl_vars['sortorder']): ?>&uarr;<?php else: ?>&darr;<?php endif; ?><?php endif; ?>
<?php else: ?>
<a href="?<?php echo $this->_tpl_vars['prefix']; ?>
sortBy=<?php echo $this->_tpl_vars['field']; ?>
&<?php echo $this->_tpl_vars['prefix']; ?>
sortOrder=<?php echo $this->_tpl_vars['sortorder']; ?>
"><?php echo $this->_tpl_vars['text']; ?>
</a>&nbsp;<?php if ($this->_tpl_vars['sortby'] == $this->_tpl_vars['field']): ?><?php if ($this->_tpl_vars['sortorder']): ?>&uarr;<?php else: ?>&darr;<?php endif; ?><?php endif; ?>
<?php endif; ?>