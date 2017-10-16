<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("excursions.edit.php")'/>

<form action="excursions.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<select name="intCountryID" id="intCountryID" onchange='{literal}$("#searchForm").submit();{/literal}'>
		<option></option>
		{foreach from=$country_list_allsd item=item key=key}{if is_integer($key)}
			{if $filter.intCountryID == $item.intCountryID}
			<option value="{$item.intCountryID}" selected="selected">{$item.varName}</option>	
			{else}
			<option value="{$item.intCountryID}">{$item.varName}</option>	
			{/if}
		{/if}{/foreach}
	</select>
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varName' text='Название' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Связи</th>
		<th>{include file='sortlink.tpl' field='isActive' text='Активен' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Ссылка</th>
		<th>Действия</th>
	</tr>
	{foreach from=$excursion_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='javascript:Go("excursions.edit.php?intExcursionID={$item.intExcursionID})"'>
		<td>{$item.varName}</td>
		<td>
			{if isset($relation_list.country)}
				Страны:
				{foreach from=$relation_list_excursion[$item.intExcursionID].country item=it name=fors}
					{if $smarty.foreach.fors.iteration != 1}, {/if}
					{$country_list[$it.intDestinationID].varName}
				{/foreach}
				<br>
			{/if}
			{if isset($relation_list.resort)}
				Куроты:
				{foreach from=$relation_list_excursion[$item.intExcursionID].resort item=it name=fors}
					{if $smarty.foreach.fors.iteration != 1}, {/if}
					{$resort_list[$it.intDestinationID].varName}
				{/foreach}
				<br>
			{/if}
			{if isset($relation_list.region)}
				Регионы:
				{foreach from=$relation_list_excursion[$item.intExcursionID].region item=it name=fors}
					{if $smarty.foreach.fors.iteration != 1}, {/if}
					{$region_list[$it.intDestinationID].varName}
				{/foreach}
				<br>
			{/if}
		
		
		</td>
		<td>{if $item.isActive == 1}Да{else}Нет{/if}</td>
		<td nowrap="nowrap"><a href="{$item.link}" target="_blank">{$item.link}</a></td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("excursions.edit.php?intExcursionID={$item.intExcursionID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("excursions.php?intExcursionID={$item.intExcursionID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intExcursionID}?")'/></td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<!-- /Таблица -->
{include file="scroller.tpl" pager=$excursion_list.pager script=1}
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
