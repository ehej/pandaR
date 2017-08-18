<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:14
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/gallerys.edit.tpl */ ?>
<?php echo '
<script type="text/javascript">
	$(document).ready(function(){
		sortable();
	});
	function SaveForm() {
		$(\'#event\').val(\'save\');
		$(\'#editForm\').submit();
	}
	function setImageTitle(id) {
		var tmp = prompt(\'Введите подпиь к картинке:\', $(\'#editImg_\' + id).attr(\'title\'));
		if (tmp != \'\' && tmp != null) {
			$.post(\'gallerys.edit.php?event=setImageTitle\', {	intImageID: id, varTitle: tmp	}, function(data) {
				if (data) {
					$(\'#editImg_\' + id).attr(\'title\', data); 
				}
			});
		}	
	}
</script>
'; ?>


<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("gallerys.php")'/>

<form action="gallerys.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intGalleryID" id="intGalleryID" value="<?php echo $this->_tpl_vars['data']['intGalleryID']; ?>
" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные фотогалереи</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 300px;">Название<span class="important">*</span></td>
				<td><input type="text" id="varTitle" name="varTitle" value="<?php echo $this->_tpl_vars['data']['varTitle']; ?>
" size="122" /></td>
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
<?php if ($this->_tpl_vars['data']['intGalleryID']): ?>			
			<tr class="bordered">
				<th colspan="2">Фотографии</th>			
			</tr>
<?php endif; ?>
		</tbody>
	</table>
<?php if ($this->_tpl_vars['data']['intGalleryID']): ?>		
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "documents.tpl", 'smarty_include_vars' => array('pager' => $this->_tpl_vars['documents'],'script' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div id="imagesListsortable">
	<?php $this->assign('height', ($this->_tpl_vars['data']['intPreviewHeight']-20)); ?>
	<?php $this->assign('width', ($this->_tpl_vars['data']['intPreviewWidth']-20)); ?>	
	<?php $_from = $this->_tpl_vars['images_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['images_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['images_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['images_list']['iteration']++;
?>
		<div class="imageArea" id="<?php echo $this->_tpl_vars['item']['intImageID']; ?>
" style="background: url(<?php echo $this->_tpl_vars['item']['imageUrl']; ?>
) no-repeat; width: <?php echo $this->_tpl_vars['data']['intPreviewWidth']; ?>
px; height: <?php echo $this->_tpl_vars['data']['intPreviewHeight']; ?>
px; position: relative;">
			<a class="lightbox" rel="lytebox[gallery]" title="<?php echo $this->_tpl_vars['item']['varTitle']; ?>
" href="<?php echo $this->_tpl_vars['item']['imageOrigUrl']; ?>
" onclick="javascript:$.noop();">
				<div style="height:<?php echo $this->_tpl_vars['height']; ?>
px; clear:both; color: white; padding-left: 1px; text-shadow:1px 1px 0 black;"><?php echo $this->_tpl_vars['item']['varRealFileName']; ?>
</div>
				<div style="height:1px;width:<?php echo $this->_tpl_vars['width']; ?>
px;float:left;"></div>
				<img />
			</a>
			<div style="position: absolute; right: 5px; bottom: 5px;">
			<a id="editImg_<?php echo $this->_tpl_vars['item']['intImageID']; ?>
" href="javascript:setImageTitle(<?php echo $this->_tpl_vars['item']['intImageID']; ?>
);" title="<?php echo $this->_tpl_vars['item']['varTitle']; ?>
"><img src="/img/edit.gif" alt="Редактировать" /></a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:deleteImage(<?php echo $this->_tpl_vars['item']['intImageID']; ?>
,'<?php echo $this->_tpl_vars['item']['varRealFileName']; ?>
');" title="Удалить изображение <?php echo $this->_tpl_vars['item']['varRealFileName']; ?>
"><img src="/img/delete-icon.png" alt="Удалить" /></a>
			</div>
		</div>
	<?php endforeach; endif; unset($_from); ?>
	</div>
<?php endif; ?>	
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>