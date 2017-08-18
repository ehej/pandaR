<?php /* Smarty version 2.6.19, created on 2016-11-14 15:13:15
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/modulespages.edit.tpl */ ?>
<?php echo '
<script type="text/javascript">
function SaveForm() {
	$(\'#event\').val(\'save\');
	$(\'#intGalleryID option\').css(\'display\',\'\'); 
	$(\'#editForm\').submit();
}
</script>
'; ?>


<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("modulespages.php")'/>

<form action="modulespages.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intModulePageID" id="intModulePageID" value="<?php echo $this->_tpl_vars['data']['intModulePageID']; ?>
" />
<input type="hidden" name="varPage" id="varPage" value="<?php echo $this->_tpl_vars['data']['varPage']; ?>
" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные страницы</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Название</td>
				<td><?php echo $this->_tpl_vars['data']['varTitle']; ?>
</td>
			</tr>
			<tr>
				<td>Meta Title</td>
				<td><textarea id="varMetaTitle" name="varMetaTitle" cols="120"><?php echo $this->_tpl_vars['data']['varMetaTitle']; ?>
</textarea></td>
			</tr>
			<tr>
				<td>Meta Keywords</td>
				<td><textarea id="varMetaKeywords" name="varMetaKeywords" cols="120"><?php echo $this->_tpl_vars['data']['varMetaKeywords']; ?>
</textarea></td>
			</tr>
			<tr>
				<td>Meta description</td>
				<td><textarea id="varMetaDescription" name="varMetaDescription" cols="120"><?php echo $this->_tpl_vars['data']['varMetaDescription']; ?>
</textarea></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>