<?php /* Smarty version 2.6.19, created on 2016-11-14 12:34:11
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/banners_zones.edit.tpl */ ?>
<?php echo '
<script type="text/javascript">
	function SaveForm() {
		$(\'#event\').val(\'save\');
		$(\'#editForm\').submit();
	}
</script>
'; ?>


<h1><?php echo $this->_tpl_vars['pagetitle']; ?>
</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("banners_zones.php")'/>

<form action="banners_zones.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intBannerZoneID" id="intBannerZoneID" value="<?php echo $this->_tpl_vars['data']['intBannerZoneID']; ?>
" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные баннерной зоны</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 120px;">Название<span class="important">*</span></td>
				<td><input type="text" id="varName" name="varName" value="<?php echo $this->_tpl_vars['data']['varName']; ?>
" size="122" readonly /></td>
			</tr>
			<tr class="banner_sect_1">
				<td >Баннер</td>
				<td>
				<?php if ($this->_tpl_vars['data']['varBanner1Name']): ?>
					<a href ="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['data']['varBanner1Name']; ?>
"><?php echo $this->_tpl_vars['data']['varBanner1RealName']; ?>
</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("banners_zones.edit.php?intBannerZoneID=<?php echo $this->_tpl_vars['data']['intBannerZoneID']; ?>
&varBannerName=<?php echo $this->_tpl_vars['data']['varBanner1Name']; ?>
&intBannerPos=1&event=deleteBanner", "Вы уверены, что хотите удалить данный файл?")'/>
				<?php else: ?>
					<input type="file" name="varBanner1Name" id="varBanner1Name" />
				<?php endif; ?>
				<div style="clear: both;height: 10px;"></div>
				<div style="float: left;margin-right: 5px;"> Ширина <input type="text" name="intWidth1" value="<?php echo $this->_tpl_vars['data']['intWidth1']; ?>
" size="5" /></div>
				<div style="float: left;margin-right: 5px;"> Высота <input type="text" name="intHeight1" value="<?php echo $this->_tpl_vars['data']['intHeight1']; ?>
" size="5" /></div>
				<div style="float: left;"> Ссылка: http:// <input type="text" name="varLink1" value="<?php echo $this->_tpl_vars['data']['varLink1']; ?>
" /></div>
				</td>
			</tr>
					</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>