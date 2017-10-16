{literal}
<script type="text/javascript">
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("banners_right.php")'/>

<form action="banners_right.edit.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intBannerRightID" id="intBannerRightID" value="{$data.intBannerRightID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные баннера</th></tr></thead>
		<tbody>
			<tr>
				<td>Файл</td>
				<td>
				{if $data.varBannerName}
					<a href ="{$FILES_URL}{$data.varBannerName}">{$data.varBannerRealName}</a>
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("banners_right.edit.php?intBannerRightID={$data.intBannerRightID}&varBannerName={$data.varBannerName}&event=deleteBanner", "Вы уверены, что хотите удалить данный файл?")'/></td>
				{else}
					<input type="file" name="varBannerName" id="varBannerName" />
				{/if}
				</td>
			</tr>
			<tr>
				<td>Ссылка</td>
				<td>http:// <input type="text" id="varLink" name="varLink" value="{$data.varLink}" /></td>
			</tr>
			<tr>
				<td>Высота</td>
				<td><input type="text" id="h" name="h" value="{$data.h}" /></td>
			</tr>
			<tr>
				<td>Ширина</td>
				<td><input type="text" id="w" name="w" value="{$data.w}" /></td>
			</tr>
			<tr>
				<td>Отображать</td>
				<td><input style="float:left" type="checkbox" id="isShowBanner" name="isShowBanner" value="1"{if $data.isShowBanner=='1'} checked="checked"{/if} /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>