{literal}
<script type="text/javascript" src="/fckeditor/fckeditor.js?v=1.0"></script>
<script type="text/javascript" src="/ckfinder/ckfinder.js?v=1.0"></script>
<script type="text/javascript">
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("news_type.php")'/>

<form action="news_type.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intNewsTypeID" id="intNewsTypeID" value="{$data.intNewsTypeID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные категории новостей</th></tr></thead>
		<tbody>
			<tr>
				<td width="140">Название</td>
				<td><input type="text" id="varNameType" name="varNameType" value="{$data.varNameType}" size="122" /></td>
			</tr>
			<tr>
				<td>Ссылка (Alias)</td>
				<td><input type="text" id="varUrlAlias" name="varUrlAlias" value="{$data.varUrlAlias}" size="122" /></td>
			</tr>
			<tr>
				<td>Вес</td>
				<td><input type="text" id="intOrdering" name="intOrdering" value="{$data.intOrdering}" size="122" /></td>
			</tr>
			<tr>
				<td>Активна</td>
				<td><input style="float:left" type="checkbox" id="isActive" name="isActive" value="Yes" {if $data.isActive=='Yes'} checked="checked"{/if} /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>