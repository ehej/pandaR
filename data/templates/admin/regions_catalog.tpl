<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("regions_catalog.edit.php")'/>

<form action="regions_catalog.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<select name="intCountryID" id="intCountryID" onchange='{literal}$("#searchForm").submit();{/literal}'>
		<option></option>
		{foreach from=$countries_list item=item key=key}{if is_integer($key)}
			{if $filter.intCountryID == $key}
			<option value="{$key}" selected="selected">{$item.varName}</option>	
			{else}
			<option value="{$key}">{$item.varName}</option>	
			{/if}
		{/if}{/foreach}
	</select>
	{if $resorts_list}
	<select name="intResortID" id="intResortID" onchange='{literal}$("#searchForm").submit();{/literal}'>
		<option></option>
		{foreach from=$resorts_list item=item key=key}{if is_integer($key)}
			{if $filter.intResortID == $key}
			<option value="{$key}" selected="selected">{$item.varName}</option>	
			{else}
			<option value="{$key}">{$item.varName}</option>	
			{/if}
		{/if}{/foreach}
	</select>
	{/if}
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varName' text='Название региона' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varResortName' text='Название Курорта' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='isActive' text='Активен' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Ссылка</th>
		<th width="100">Действия</th>
	</tr>
	{foreach from=$regions_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='javascript:Go("regions_catalog.edit.php?intRegionID={$item.intRegionID})"'>
		<td>{$item.varName}</td>
		<td>{$item.varResortName}</td>
		<td>{if $item.isActive == 1}Да{else}Нет{/if}</td>
		<td nowrap="nowrap"><a href="{$item.link}" target="_blank">{$item.link}</a></td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("regions_catalog.edit.php?intRegionID={$item.intRegionID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("regions_catalog.php?intRegionID={$item.intRegionID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intRegionID}?")'/></td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<!-- /Таблица -->
{include file="scroller.tpl" pager=$regions_list.pager script=1}
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
