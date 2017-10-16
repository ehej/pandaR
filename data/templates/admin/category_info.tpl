{literal}
<script type="text/javascript">
function SaveForm() {
	$('#event').val('save');
}
</script>
{/literal}
<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("category_info.edit.php")'/>

<form action="category_info.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<input type="hidden" name="event" id="event" value="" />
<div align="right">
	<input type="text" name="varTitle" id="varTitle" class="titled" value="{$filter.LIKEvarTitle}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='intNewsType' text='ID' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varNameType' text='Название' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='intOrdering' text='Вес' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='intActive' text='Отображать в меню' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='isAllwaysOpen' text='Всегда открыта' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Действия</th>
	</tr>
	{foreach from=$data_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="category_info.edit.php?intCategoryID={$item.intCategoryID}"'>
		<td>{$item.intCategoryID}</td>
		<td>{$item.varName|truncate:70}</td>
		<td style="text-align: center;"><input type="text" name="intOrdering[{$item.intCategoryID}]" size="4" value="{$item.intOrdering}" /></td>
		<td style="text-align: center;">{if $item.isActive=='Yes'}<span style="color: green;">да</span>{else}<span style="color: red;">нет</span>{/if}</td>
		<td style="text-align: center;">{if $item.isAllwaysOpen==1}<span style="color: green;">да</span>{else}<span style="color: red;">нет</span>{/if}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("category_info.edit.php?intCategoryID={$item.intCategoryID}")'/>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("category_info.php?intCategoryID={$item.intCategoryID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intCategoryID}?")'/>
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
{include file="scroller.tpl" pager=$data_list.pager script=1}
<input type="submit" onclick="SaveForm()" value="Сохранить порядок" rel="82" class="iconize" style="background-position: 2px -1311px;float:right;">
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