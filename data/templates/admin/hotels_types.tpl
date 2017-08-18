<h1>{$pagetitle}</h1>

<div id="autocompleteHotelsDiv" style="display: none;">{$autocompleteHotels}</div>

<form action="hotels_types.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varName' text='Название категории отеля' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Действия</th>
	</tr>
	{foreach from=$hotels_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="hotels_types.edit.php?intHotelTypeID={$item.intHotelTypeID}"'>
		<td>{$item.varName}</td>
		<td nowrap="nowrap" style="text-align:center;"><input type="button" class="iconize without_text" rel="52" value="" title="Редактировать" onclick='javascript:Go("hotels_types.edit.php?intHotelTypeID={$item.intHotelTypeID}")'/>
			<input type="button" class="iconize without_text" rel="83" value="" title="Удалить" onclick='javascript:OnDelete("hotels_types.php?intHotelTypeID={$item.intHotelTypeID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intHotelTypeID}?")'/></td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="2" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<!-- /Таблица -->
{include file="scroller.tpl" pager=$hotels_list.pager script=1}
</form>

<script>
{literal}
function sortByField(field, sorder) {
	$('#sortBy').val(field);
	$('#sortOrder').val(sorder);
	$('#searchForm').submit();
}
$(document).ready(function() {
	setAutocomleteList('autocompleteHotelsDiv', 'FvarName', 'intHotelTypeID', '{/literal}{$filter.intHotelTypeID|default:'0'}{literal}');
});
{/literal}
</script>