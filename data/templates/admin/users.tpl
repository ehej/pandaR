<h1>{$pagetitle}</h1>
{*<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("users.edit.php")'/>*}

<form action="users.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varLogin" id="varLogin" class="titled" value="{$filter.LIKEvarLogin}" title="Login" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varLogin' text='Login' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varName' text='Название компании' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varFIO' text='Ф. И. О.' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="100">Действия</th>
	</tr>
	{foreach name=users from=$users_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="users.edit.php?intUserID={$item.intUserID}"'>
		<td>{$item.varLogin}</td>
		<td>{$item.varName}</td>
		<td>{$item.varFIO}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("users.edit.php?intUserID={$item.intUserID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("users.php?intUserID={$item.intUserID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intUserID}?")'/></td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<!-- /Таблица -->
{include file="scroller.tpl" pager=$users_list.pager script=1}
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