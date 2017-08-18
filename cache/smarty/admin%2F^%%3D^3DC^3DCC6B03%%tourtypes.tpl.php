<?php /* Smarty version 2.6.19, created on 2016-11-09 12:23:48
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/tourtypes.tpl */ ?>
<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>

<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript">
<?php echo '
$(document).ready(function(){
	$(\'.sort_ul\').sortable().disableSelection();
	$(\'#btnSaveOrder\').click(function(){
		var result = [];
		var uls = $(\'.sort_ul\');
		for(var i=0; i < uls.length; i++) {
			$("<input>", {
				type: \'hidden\',
				name: \'order[\' + parseInt(uls[i].id, 10) + \']\',
				val: $(uls[i]).sortable(\'toArray\')
			}).appendTo(\'#sort_menu\');
		}

		$(\'#event\').val(\'SaveOrder\');
		$(\'#sort_menu\').submit();
	});
});
'; ?>

</script>

<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("tourtypes.edit.php")'/>

<form action="tourtypes.php" method="POST" id="sort_menu">
	<input type="hidden" name="event" id="event" value=""/>
	<br /><br />
	<div id="manage_menu_view">
		<ul class="sort_ul" id="0_ul">
		<?php $_from = $this->_tpl_vars['tourtypes_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<li id="<?php echo $this->_tpl_vars['item']['intTypeID']; ?>
">
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td><span style="float:left;"><a href="tourtypes.edit.php?intTypeID=<?php echo $this->_tpl_vars['item']['intTypeID']; ?>
" title="<?php echo $this->_tpl_vars['item']['varName']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</a></td>
					<td><span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick='javascript:OnDelete("tourtypes.php?intTypeID=<?php echo $this->_tpl_vars['item']['intTypeID']; ?>
&event=delete", "Вы уверены, что хотите удалить запись с ID=<?php echo $this->_tpl_vars['item']['intTypeID']; ?>
?")'></span></td>
				</tr>
			</table>		
			</li>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
	</div>
	<div style="padding-top: 20px">
		<input type="button" class="iconize" id="btnSaveOrder" rel="82" value="Сохранить порядок" />
		<br /><br />
		<p class="info">
		Для того, чтобы изменить порядок следования списка туров, используйте перетаскивание мышью.<br />
		Чтобы система запомнила текущий порядок - нажмите "Сохранить порядок"
		</p>
	</div>
</form>