<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("roles.edit.php")'/>

<form action="roles.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varRoleName" id="varRoleName" class="titled" value="{$filter.LIKEvarRoleName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varRoleName' text='Название роли' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="100">Действия</th>
	</tr>
	{foreach from=$roles_list item=item key=key}{if is_integer($key)}
	{if $item.intRoleID!=$DEFAULT_SUPER_ADMIN_ID}
	<tr onDblClick='window.location="roles.edit.php?intRoleID={$item.intRoleID}"'>
		<td>{$item.varRoleName}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("roles.edit.php?intRoleID={$item.intRoleID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("roles.php?intRoleID={$item.intRoleID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intRoleID}?")'/></td>
	</tr>
	{/if}{/if}
	{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<!-- /Таблица -->
{include file="scroller.tpl" pager=$roles_list.pager script=1}
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