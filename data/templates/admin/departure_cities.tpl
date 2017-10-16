<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("departure_cities.edit.php")'/>

<form action="departure_cities.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varName' text='Город вылета' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='intRegionID' text='Регион' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Действия</th>
	</tr>
	{foreach from=$departure_cities_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='javascript:Go("departure_cities.edit.php?intDepadtureCityID={$item.intDepadtureCityID})"'>
		<td>{$item.varName}</td>
		<td>
			{foreach from=$regions_list item=it}
				{if $it.intRegionID==$item.intRegionID}{$it.varName}{/if}
			{/foreach}
		</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("departure_cities.edit.php?intDepadtureCityID={$item.intDepadtureCityID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("departure_cities.php?intDepadtureCityID={$item.intDepadtureCityID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intDepadtureCityID}?")'/></td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
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
{/literal}
</script>