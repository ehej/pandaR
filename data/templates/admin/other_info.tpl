<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("other_info.edit.php")'/>

<form action="other_info.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varName' text='Название' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='intCountryID' text='Название страны' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Категория</th>
		<th>Ссылка</th>
		<th>Действия</th>
	</tr>
	{foreach from=$data_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='javascript:Go("other_info.edit.php?intInfoID={$item.intInfoID})"'>
		<td>{$item.varName}</td>
		<td>{$countries_list[$item.intCountryID].varName}</td>
		<td>{$category_list[$item.intCategoryID].varName}</td>
		<td nowrap="nowrap"><a href="{$item.link}" target="_blank">{$item.link}</a></td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("other_info.edit.php?intInfoID={$item.intInfoID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("other_info.php?intInfoID={$item.intInfoID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intInfoID}?")'/></td>
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
