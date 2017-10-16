{literal}
<script type="text/javascript">
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>

<form action="settings.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intSettingsID" id="intSettingsID" value="{$data.intSettingsID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
        <thead><tr><th colspan="2"></th></tr></thead>
		<tbody>
			<tr>
				<td >Колличество новостей на главной</td>
				<td><input type="text" id="intNewsAnnouncementCount" name="intNewsAnnouncementCount" value="{$data.intNewsAnnouncementCount}" size="12" /></td>
			</tr>
            <tr>
				<td >Колличество новостей на странице</td>
				<td><input type="text" id="intNewsPageCount" name="intNewsPageCount" value="{$data.intNewsPageCount}" size="12" /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>