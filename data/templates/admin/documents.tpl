{if $compability}
<script type="text/javascript" src="{$PROJECT_URL}js/dd-file/classy.js"></script>
<script type="text/javascript" src="{$PROJECT_URL}js/dd-file/util.js"></script>
<script type="text/javascript" src="{$PROJECT_URL}js/dd-file/jquery.template.js"></script>
<script type="text/javascript" src="{$PROJECT_URL}js/dd-file/dragupload.js"></script>
<script type="text/javascript" src="{$PROJECT_URL}js/dd-file/fileline.js"></script>
<script type="text/javascript" src="{$PROJECT_URL}js/dd-file/filemanager.js"></script>
<script type="text/javascript">
{literal}
var FILES_URL = '/data/filestorage/';
$(document).ready(function(){
	new FileManager();
});
{/literal}
</script>
{/if}
<div class="drop-zone" id="dropZone">
	{if !$compability}
		<br /><p style="font-weight: bold;">Использование браузеров FireFox и Google Chrome позволит загружать файлы с помощью drag&amp;drop прямо с рабочего стола</p>
		<div id="areaDocument">
			<label for="fileDocument">Загрузка файлов</label><br />
			<input type="file" name="varFile" id="varFile" />
			<input type="button" class="iconize" rel="12" value="Загрузить" onclick="upload();" />
		</div>
	{else}
		<div class="caption"><h2>Для загрузки файлов, бросьте их тут</h2></div>
	{/if}
</div>
<div class="file-list" id="filesList"></div>