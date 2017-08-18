<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:14
         compiled from documents.tpl */ ?>
<?php if ($this->_tpl_vars['compability']): ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
js/dd-file/classy.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
js/dd-file/util.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
js/dd-file/jquery.template.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
js/dd-file/dragupload.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
js/dd-file/fileline.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
js/dd-file/filemanager.js"></script>
<script type="text/javascript">
<?php echo '
var FILES_URL = \'/data/filestorage/\';
$(document).ready(function(){
	new FileManager();
});
'; ?>

</script>
<?php endif; ?>
<div class="drop-zone" id="dropZone">
	<?php if (! $this->_tpl_vars['compability']): ?>
		<br /><p style="font-weight: bold;">Использование браузеров FireFox и Google Chrome позволит загружать файлы с помощью drag&amp;drop прямо с рабочего стола</p>
		<div id="areaDocument">
			<label for="fileDocument">Загрузка файлов</label><br />
			<input type="file" name="varFile" id="varFile" />
			<input type="button" class="iconize" rel="12" value="Загрузить" onclick="upload();" />
		</div>
	<?php else: ?>
		<div class="caption"><h2>Для загрузки файлов, бросьте их тут</h2></div>
	<?php endif; ?>
</div>
<div class="file-list" id="filesList"></div>