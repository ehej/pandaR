<?php /* Smarty version 2.6.19, created on 2016-11-11 13:15:58
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/links.tpl */ ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>


<form action="links.php" method="POST" id="searchForm">
<input type="hidden" name="event" value="save">
<table class="bordered" width="100%">
	<tr>
		<th width="20">Активен</th>
		<th width="20">ID</th>
		<th width="300">Название</th>
		<th>Ссылка</th>
	</tr>
	<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
	<tr>
		<td><input type="checkbox" <?php if ($this->_tpl_vars['item']['intActive']): ?>checked<?php endif; ?> name="links[<?php echo $this->_tpl_vars['item']['intLinkID']; ?>
][intActive]" value="1"></td>
		<td><input type="hidden" name="links[<?php echo $this->_tpl_vars['item']['intLinkID']; ?>
][intLinkID]" value="<?php echo $this->_tpl_vars['item']['intLinkID']; ?>
"><?php echo $this->_tpl_vars['item']['intLinkID']; ?>
</td>
		<td><input type="text" name="links[<?php echo $this->_tpl_vars['item']['intLinkID']; ?>
][varName]" value="<?php echo $this->_tpl_vars['item']['varName']; ?>
" style="width: 97%"></td>
		<td><input type="text" name="links[<?php echo $this->_tpl_vars['item']['intLinkID']; ?>
][varLink]" value="<?php echo $this->_tpl_vars['item']['varLink']; ?>
" style="width: 97%"></td>
	</tr>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<tr>
		<td colspan="4">
			<input type="submit" value="Сохранить" class="iconize" rel="82"></td>
	</tr>
</table>
<!-- /Таблица -->
</form>