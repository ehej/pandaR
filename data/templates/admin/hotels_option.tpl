<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("hotels_option.edit.php")'/>

<form action="hotels_option.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varEmail' text='ID' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varName' text='Название' sortorder=$sortOrder sortby=$sortBy script=true}</th>		
		<th>{include file='sortlink.tpl' field='intOrdering' text='Позиция' sortorder=$sortOrder sortby=$sortBy script=true}</th>		
		<th>Действия</th>
	</tr>
	{foreach from=$option_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="hotels_option.edit.php?intOptionID={$item.intOptionID}"'>
		<td>{$item.intOptionID}</td>
		<td>{$item.varName}</td>
		<td>{$item.intOrdering}</td>
		<td nowrap="nowrap"><input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("hotels_option.edit.php?intOptionID={$item.intOptionID}")'/>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("hotels_option.php?intOptionID={$item.intOptionID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intOptionID}?")'/></td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<!-- /Таблица -->
{include file="scroller.tpl" pager=$option_list.pager script=1}
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