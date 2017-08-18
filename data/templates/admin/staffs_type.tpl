<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("staffs_type.edit.php")'/>

<form action="staffs_type.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varTitle" id="varTitle" class="titled" value="{$filter.LIKEvarTitle}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='intType' text='ID' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varNameType' text='Название' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='intOrdering' text='Вес' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='intActive' text='Отображать' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="100">Действия</th>
	</tr>
	{foreach from=$type_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="staffs_type.edit.php?intTypeID={$item.intTypeID}"'>
		<td>{$item.intTypeID}</td>
		<td>{$item.varNameType|truncate:70}</td>
		<td>{$item.intOrdering}</td>
		<td style="text-align: center;">{if $item.isActive=='Yes'}<span style="color: green;">да</span>{else}<span style="color: red;">нет</span>{/if}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("staffs_type.edit.php?intTypeID={$item.intTypeID}")'/>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("staffs_type.php?intTypeID={$item.intTypeID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intTypeID}?")'/>
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
{include file="scroller.tpl" pager=$type_list.pager script=1}
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