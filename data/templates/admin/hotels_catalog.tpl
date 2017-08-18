<h1>{$pagetitle}</h1>
{literal}
<script type="text/javascript">
function SaveForm() {
	$('#event').val('save');
}
</script>
{/literal}
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("hotels_catalog.edit.php")'/>

<form action="hotels_catalog.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<input type="hidden" name="event" id="event" value="" />
<div align="right">
	<select name="intCountryID" id="intCountryID" onchange='{literal}$("#searchForm").submit();{/literal}'  style="width: 150px;">
		<option></option>
		{foreach from=$countries_list item=item key=key}{if is_integer($key)}
			{if $filter.intCountryID == $key}
			<option value="{$key}" selected="selected">{$item.varName}</option>	
			{else}
			<option value="{$key}">{$item.varName}</option>	
			{/if}
		{/if}{/foreach}
	</select>
	{if $resorts_list_filter}
	<select name="intResortID" id="intResortID" onchange='{literal}$("#searchForm").submit();{/literal}' style="width: 150px;">
		<option></option>
		{foreach from=$resorts_list_filter item=item key=key}{if is_integer($key)}
			{if $filter.intResortID == $key}
			<option value="{$key}" selected="selected">{$item.varName}</option>	
			{else}
			<option value="{$key}">{$item.varName}</option>	
			{/if}
		{/if}{/foreach}
	</select>
	{/if}
	{if $regions_list_filter}
	<select name="intRegionID" id="intRegionID" onchange='{literal}$("#searchForm").submit();{/literal}' style="width: 150px;">
		<option></option>
		{foreach from=$regions_list_filter item=item key=key}{if is_integer($key)}
			{if $filter.intRegionID == $key}
			<option value="{$key}" selected="selected">{$item.varName}</option>	
			{else}
			<option value="{$key}">{$item.varName}</option>	
			{/if}
		{/if}{/foreach}
	</select>
	{/if}
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
	<input type="button" value="Отменить фильтры" class="iconize" rel="4" onclick='Go("hotels_catalog.php")' name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varName' text='Название отеля' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='nameResort' text='Курорт' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='nameCountry' text='Страна' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='isActive' text='Активен' sortorder=$sortOrder sortby=$sortBy script=true}</th>
        <th>Ссылка</th>
		<th>Действия</th>
	</tr>
	{foreach from=$hotels_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='javascript:Go("hotels_catalog.edit.php?intHotelID={$item.intHotelID}")'>
		<td>{$item.varName}</td>
		<td>{$resorts_list[$item.intResortID].varName}</td>
		<td>{$countries_list[$item.intCountryID].varName}</td>
		<td>{if $item.isActive == 1}<span style="color: green;">да</span>{else}<span style="color: red;">нет</span>{/if}</td>
		<td nowrap="nowrap"><a href="{$item.link}" target="_blank">{$item.link}</a></td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("hotels_catalog.edit.php?intHotelID={$item.intHotelID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("hotels_catalog.php?intHotelID={$item.intHotelID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intHotelID}?")'/></td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<!-- /Таблица -->
    {*<input type="submit" onclick="SaveForm()" value="Сохранить" rel="82" class="iconize" style="background-position: 2px -1311px;float:right;">*}
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
