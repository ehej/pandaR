<h1>{$pagetitle}</h1>


<form action="placetypes.php" method="POST" id="searchForm">
<input type="hidden" name="event" value="save">
<table class="bordered" width="100%">
<!-- Таблица -->

	<tr>
		<th width="20">ID</th>
		<th>Название</th>
		<th width="80">Действия</th>
	</tr>
	<tr>
		<td colspan="2"><span class="important">*</span><input type="text" name="varName" value="" style="width: 95%"></td>
		<td><input type="submit" class="iconize" rel="23" value="Добавить" o/></td>
	</tr>
	{foreach from=$roles item=item key=key}{if is_integer($key)}
	<tr >
		<td>{$item.intPlaceTypeID}</td>
		<td>{$item.varName}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("placetypes.php?intPlaceTypeID={$item.intPlaceTypeID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intPlaceTypeID}?")'/>
		</td>
	</tr>
	{/if}
	{/foreach}
</table>
<!-- /Таблица -->
</form>
