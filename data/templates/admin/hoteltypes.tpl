<h1>{$pagetitle}</h1>
<form action="hoteltypes.php" method="POST" id="searchForm">
<input type="hidden" name="event" value="save">
<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th width="20">ID</th>
		<th>Название</th>
		<th width="80">Действия</th>
	</tr>
	<tr>
		<td colspan="2"><input type="text" name="varName" value="" style="width: 98%;"></td>
		<td><input type="submit" class="iconize" rel="23" value="Добавить" o/></td>
	</tr>
	{foreach from=$roles item=item key=key}{if is_integer($key)}
	<tr >
		<td>{$item.intHotelTypeID}</td>
		<td>{$item.varName}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("hoteltypes.php?intHotelTypeID={$item.intHotelTypeID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intHotelTypeID}?")'/>
		</td>
	</tr>
	{/if}
	{/foreach}
</table>
<!-- /Таблица -->
</form>
