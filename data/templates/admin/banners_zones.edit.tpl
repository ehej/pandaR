{literal}
<script type="text/javascript">
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("banners_zones.php")'/>

<form action="banners_zones.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intBannerZoneID" id="intBannerZoneID" value="{$data.intBannerZoneID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные баннерной зоны</th></tr></thead>
		<tbody>
			<tr>
				<td style="width: 120px;">Название<span class="important">*</span></td>
				<td><input type="text" id="varName" name="varName" value="{$data.varName}" size="122" readonly /></td>
			</tr>
			<tr class="banner_sect_1">
				<td >Баннер</td>
				<td>
				{if $data.varBanner1Name}
					<a href ="{$FILES_URL}{$data.varBanner1Name}">{$data.varBanner1RealName}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("banners_zones.edit.php?intBannerZoneID={$data.intBannerZoneID}&varBannerName={$data.varBanner1Name}&intBannerPos=1&event=deleteBanner", "Вы уверены, что хотите удалить данный файл?")'/>
				{else}
					<input type="file" name="varBanner1Name" id="varBanner1Name" />
				{/if}
				<div style="clear: both;height: 10px;"></div>
				<div style="float: left;margin-right: 5px;"> Ширина <input type="text" name="intWidth1" value="{$data.intWidth1}" size="5" /></div>
				<div style="float: left;margin-right: 5px;"> Высота <input type="text" name="intHeight1" value="{$data.intHeight1}" size="5" /></div>
				<div style="float: left;"> Ссылка: http:// <input type="text" name="varLink1" value="{$data.varLink1}" /></div>
				</td>
			</tr>
			{*<!--tr class="banner_sect_1">
				<td >Баннер 2</td>
				<td>
				{if $data.varBanner2Name}
					<a href ="{$FILES_URL}{$data.varBanner2Name}">{$data.varBanner2RealName}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("banners_zones.edit.php?intBannerZoneID={$data.intBannerZoneID}&varBannerName={$data.varBanner2Name}&intBannerPos=2&event=deleteBanner", "Вы уверены, что хотите удалить данный файл?")'/>
				{else}
					<input type="file" name="varBanner2Name" id="varBanner2Name" />
				{/if}
				<div style="clear: both;height: 10px;"></div>
				<div style="float: left;margin-right: 5px;"> Ширина <input type="text" name="intWidth2" value="{$data.intWidth2}" size="5" /></div>
				<div style="float: left;margin-right: 5px;"> Высота <input type="text" name="intHeight2" value="{$data.intHeight2}" size="5" /></div>
				<div style="float: left;">Ссылка: http:// <input type="text" name="varLink2" value="{$data.varLink2}" /></div>
				</td>
			</tr>
			<tr class="banner_sect_1">
				<td >Баннер 3</td>
				<td>
				{if $data.varBanner3Name}
					<a href ="{$FILES_URL}{$data.varBanner3Name}">{$data.varBanner3RealName}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("banners_zones.edit.php?intBannerZoneID={$data.intBannerZoneID}&varBannerName={$data.varBanner3Name}&intBannerPos=3&event=deleteBanner", "Вы уверены, что хотите удалить данный файл?")'/>
				{else}
					<input type="file" name="varBanner3Name" id="varBanner3Name" />
				{/if}
				<div style="clear: both;height: 10px;"></div>
				<div style="float: left;margin-right: 5px;"> Ширина <input type="text" name="intWidth3" value="{$data.intWidth3}" size="5" /></div>
				<div style="float: left;margin-right: 5px;"> Высота <input type="text" name="intHeight3" value="{$data.intHeight3}" size="5" /></div>
				<div style="float: left;">Ссылка: http:// <input type="text" name="varLink3" value="{$data.varLink3}" /></div>
				</td>
			</tr>
			<tr class="banner_sect_1">
				<td >Баннер 4</td>
				<td>
				{if $data.varBanner4Name}
					<a href ="{$FILES_URL}{$data.varBanner4Name}">{$data.varBanner4RealName}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("banners_zones.edit.php?intBannerZoneID={$data.intBannerZoneID}&varBannerName={$data.varBanner4Name}&intBannerPos=4&event=deleteBanner", "Вы уверены, что хотите удалить данный файл?")'/>
				{else}
					<input type="file" name="varBanner4Name" id="varBanner4Name" />
				{/if}
				<div style="clear: both;height: 10px;"></div>
				<div style="float: left;margin-right: 5px;"> Ширина <input type="text" name="intWidth4" value="{$data.intWidth4}" size="5" /></div>
				<div style="float: left;margin-right: 5px;"> Высота <input type="text" name="intHeight4" value="{$data.intHeight4}" size="5" /></div>
				<div style="float: left;">Ссылка: http:// <input type="text" name="varLink4" value="{$data.varLink4}" /></div>
				</td>
			</tr-->*}
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>