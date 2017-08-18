{literal}
<script type="text/javascript">	
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}
<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("bottom_links.php")'/>
<form action="bottom_links.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intBottomLinkID" id="intBottomLinkID" value="{$data.intBottomLinkID}" />
<input type="hidden" name="intSortOrder" id="intSortOrder" value="{$data.intSortOrder}" />

<table width="100%" class="container"><tr><td width="50%">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Общие данные</th></tr></thead>
		<tbody>			
			<tr>
				<td>Якорь</td>
				<td><input type="text" name="varTitle" id="varTitle" value="{$data.varTitle}" /></td>
			</tr>
			<tr>
				<td>Ссылка</td>
				<td>http://&nbsp;&nbsp;<input type="text" name="varURL" id="varURL" value="{$data.varURL}" /></td>
			</tr>
		</tbody>
	</table>
	<div>
		<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
	</div>
</td></tr>
</table>