<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("resorts_catalog.edit.php")'/>

<form action="resorts_catalog.php" method="GET" id="searchForm">
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
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varName' text='Название курорта' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varCountryName' text='Название страны' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='isActive' text='Активен' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Ссылка</th>
		<th>Действия</th>
	</tr>
	{foreach from=$resorts_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='javascript:Go("resorts_catalog.edit.php?intResortID={$item.intResortID})"'>
		<td>{$item.varName}</td>
		<td>{$countries_list[$item.intCountryID].varName}</td>
		<td>{if $item.isActive == 1}Да{else}Нет{/if}</td>
		<td nowrap="nowrap"><a href="{$item.link}" target="_blank">{$item.link}</a></td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("resorts_catalog.edit.php?intResortID={$item.intResortID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("resorts_catalog.php?intResortID={$item.intResortID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intResortID}?")'/>
			{*<input type="button" class="iconize" rel="52" value="Меню курорта" onclick='javascript:Go("catalog_menu.php?intResortID={$item.intResortID}")'/> *}
		</td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<!-- /Таблица -->
{include file="scroller.tpl" pager=$resorts_list.pager script=1}
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