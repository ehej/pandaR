<?php /* Smarty version 2.6.19, created on 2017-07-18 12:39:33
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/messages.edit.tpl */ ?>
<?php echo '
<script type="text/javascript">
function SaveForm() {
	$(\'#event\').val(\'save\');
	$(\'#editForm\').submit();
}
function SendForm() {
	$(\'#event\').val(\'send\');
	$(\'#editForm\').submit();
}
</script>
'; ?>


<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("messages.php")'/>

<form action="messages.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intMessageID" id="intMessageID" value="<?php echo $this->_tpl_vars['data']['intMessageID']; ?>
" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные страницы</th></tr></thead>
		<tbody>
			<tr>
				<td>Тема<span class="important">*</span></td>
				<td><input type="text" id="varSubject" name="varSubject" value="<?php echo $this->_tpl_vars['data']['varSubject']; ?>
" size="122" /></td>
			</tr>
			<tr>
				<td width="140">Содержание</td>
				<td><textarea  class="ckeditor" id="varMessage" name="varMessage" cols="120"><?php echo $this->_tpl_vars['data']['varMessage']; ?>
</textarea></td>
			</tr>
			<tr>
				<td width="140">Добавить файл 1</td>
				<td>
				<?php if ($this->_tpl_vars['data']['varFile1']): ?>
					<a href ="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['data']['varFile1']; ?>
"><?php echo $this->_tpl_vars['data']['varRealFile1Name']; ?>
</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("messages.edit.php?intMessageID=<?php echo $this->_tpl_vars['data']['intMessageID']; ?>
&varFile=<?php echo $this->_tpl_vars['data']['varFile1']; ?>
&intFilePos=1&event=deleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
				<?php else: ?>
					<input type="file" name="varFile1" id="varFile1" />
				<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td width="140">Добавить файл 2</td>
				<td>
				<?php if ($this->_tpl_vars['data']['varFile2']): ?>
					<a href ="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['data']['varFile2']; ?>
"><?php echo $this->_tpl_vars['data']['varRealFile2Name']; ?>
</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("messages.edit.php?intMessageID=<?php echo $this->_tpl_vars['data']['intMessageID']; ?>
&varFile=<?php echo $this->_tpl_vars['data']['varFile2']; ?>
&intFilePos=2&event=deleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
				<?php else: ?>
					<input type="file" name="varFile2" id="varFile2" />
				<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td width="140">Добавить файл 3</td>
				<td>
				<?php if ($this->_tpl_vars['data']['varFile3']): ?>
					<a href ="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['data']['varFile3']; ?>
"><?php echo $this->_tpl_vars['data']['varRealFile3Name']; ?>
</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("messages.edit.php?intMessageID=<?php echo $this->_tpl_vars['data']['intMessageID']; ?>
&varFile=<?php echo $this->_tpl_vars['data']['varFile3']; ?>
&intFilePos=3&event=deleteFile", "Вы уверены, что хотите удалить данный файл?")'/></td>
				<?php else: ?>
					<input type="file" name="varFile3" id="varFile3" />
				<?php endif; ?>
				</td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/> <?php if ($this->_tpl_vars['data']['intMessageID']): ?><input type="submit" class="iconize" rel="82" value="Разослать" onclick='SendForm()'/><?php endif; ?>
</div>
</form>