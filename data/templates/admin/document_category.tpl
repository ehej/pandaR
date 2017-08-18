{literal}
<script type="text/javascript">
function SaveForm() {
	$('#event').val('save');
}
</script>
{/literal}
<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("document_category.edit.php")'/>

<form action="document_category.php" method="POST" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<input type="hidden" name="event" id="event" value="" />
<div align="right">
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varName' text='Название категории' sortorder=$sortOrder sortby=$sortBy script=true}</th>
        <th>{include file='sortlink.tpl' field='intOrdering' text='Порядок' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Действия</th>
	</tr>
	{foreach from=$category item=item key=key}{if is_integer($key)}
	<tr onDblClick='javascript:Go("document_category.edit.php?intCategoryID={$item.intCategoryID})"'>
		<td>{$item.varName}</td>
        <td style="text-align: center;"><input type="text" id="intOrdering" name="intOrdering[{$item.intCategoryID}]" size="4" value="{$item.intOrdering}" /></td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("document_category.edit.php?intCategoryID={$item.intCategoryID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("document_category.php?intCategoryID={$item.intCategoryID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intCategoryID}?")'/></td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
{include file="scroller.tpl" pager=$category.pager script=1}
<!-- /Таблица -->
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