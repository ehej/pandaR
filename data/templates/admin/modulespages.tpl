<h1>{$pagetitle}</h1>

<form action="modulespages.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varTitle" id="varTitle" class="titled" value="{$filter.LIKEvarTitle}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varTitle' text='Название' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="100">Действия</th>
	</tr>
	{foreach from=$modulespages_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="modulespages.edit.php?intModulePageID={$item.intModulePageID}"'>
		<td>{$item.varTitle|truncate:70}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("modulespages.edit.php?intModulePageID={$item.intModulePageID}")'/>
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
{include file="scroller.tpl" pager=$modulespages_list.pager script=1}
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