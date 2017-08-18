{literal}
<script type="text/javascript">
	$(document).ready(function(){
		sortable();
	});
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
	function setImageTitle(id) {
		var tmp = prompt('Введите подпиь к картинке:', $('#editImg_' + id).attr('title'));
		if (tmp != '' && tmp != null) {
			$.post('gallerys.edit.php?event=setImageTitle', {	intImageID: id, varTitle: tmp	}, function(data) {
				if (data) {
					$('#editImg_' + id).attr('title', data); 
				}
			});
		}	
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("gallerys.php")'/>

<form action="gallerys.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intGalleryID" id="intGalleryID" value="{$data.intGalleryID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные фотогалереи</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Название<span class="important">*</span></td>
				<td><input type="text" id="varTitle" name="varTitle" value="{$data.varTitle}" size="122" /></td>
			</tr>
			<tr style="display: none;">
				<td width="140">Размер превью</td>
				<td>
					ширина <input type="text" id="intPreviewWidth" name="intPreviewWidth" value="150" style="width: 20px;" />
					высота <input type="text" id="intPreviewHeight" name="intPreviewHeight" value="150" style="width: 20px;" />
				</td>
			</tr>
			<tr style="display: none;">
				<td width="140">Кол-во изображений в ряде</td>
				<td><input type="text" id="intCountImgInRow" name="intCountImgInRow" value="5" style="width: 20px;" /></td>
			</tr>
{if $data.intGalleryID}			
			<tr class="bordered">
				<th colspan="2">Фотографии</th>			
			</tr>
{/if}
		</tbody>
	</table>
{if $data.intGalleryID}		
	{include file="documents.tpl" pager=$documents script=1}
	<div id="imagesListsortable">
	{assign var="height" value="`$data.intPreviewHeight-20`"}
	{assign var="width" value="`$data.intPreviewWidth-20`"}	
	{foreach from=$images_list item=item name=images_list}
		<div class="imageArea" id="{$item.intImageID}" style="background: url({$item.imageUrl}) no-repeat; width: {$data.intPreviewWidth}px; height: {$data.intPreviewHeight}px; position: relative;">
			<a class="lightbox" rel="lytebox[gallery]" title="{$item.varTitle}" href="{$item.imageOrigUrl}" onclick="javascript:$.noop();">
				<div style="height:{$height}px; clear:both; color: white; padding-left: 1px; text-shadow:1px 1px 0 black;">{$item.varRealFileName}</div>
				<div style="height:1px;width:{$width}px;float:left;"></div>
				<img />
			</a>
			<div style="position: absolute; right: 5px; bottom: 5px;">
			<a id="editImg_{$item.intImageID}" href="javascript:setImageTitle({$item.intImageID});" title="{$item.varTitle}"><img src="/img/edit.gif" alt="Редактировать" /></a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:deleteImage({$item.intImageID},'{$item.varRealFileName}');" title="Удалить изображение {$item.varRealFileName}"><img src="/img/delete-icon.png" alt="Удалить" /></a>
			</div>
		</div>
	{/foreach}
	</div>
{/if}	
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>