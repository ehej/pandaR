<h1>{$pagetitle}</h1>


<form action="links.php" method="POST" id="searchForm">
<input type="hidden" name="event" value="save">
<table class="bordered" width="100%">
	<tr>
		<th width="20">Активен</th>
		<th width="20">ID</th>
		<th width="300">Название</th>
		<th>Ссылка</th>
	</tr>
	{foreach from=$data item=item key=key}{if is_integer($key)}
	<tr>
		<td><input type="checkbox" {if $item.intActive}checked{/if} name="links[{$item.intLinkID}][intActive]" value="1"></td>
		<td><input type="hidden" name="links[{$item.intLinkID}][intLinkID]" value="{$item.intLinkID}">{$item.intLinkID}</td>
		<td><input type="text" name="links[{$item.intLinkID}][varName]" value="{$item.varName}" style="width: 97%"></td>
		<td><input type="text" name="links[{$item.intLinkID}][varLink]" value="{$item.varLink}" style="width: 97%"></td>
	</tr>
	{/if}
	{/foreach}
	<tr>
		<td colspan="4">
			<input type="submit" value="Сохранить" class="iconize" rel="82"></td>
	</tr>
</table>
<!-- /Таблица -->
</form>
