<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("admins.edit.php")'/>

<form action="admins.php" method="GET" id="searchForm">
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
		<th>{include file='sortlink.tpl' field='varFIO' text='Ф. И. О.' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='intRoleID' text='Роль' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="100">Действия</th>
	</tr>
	{foreach name=admins from=$admins_list item=item key=key}{if is_integer($key)}
	{if $item.intAdminID!=$DEFAULT_SUPER_ADMIN_ID}
	<tr onDblClick='window.location="admins.edit.php?intAdminID={$item.intAdminID}"'>
		<td>{$item.varLogin}</td>
		<td>{$item.varFIO}</td>
		<td>
			{foreach name=roles from=$roles_list item=it}
				{if $it.intRoleID==$item.intRoleID}{$it.varRoleName}{/if}
			{/foreach}
		</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("admins.edit.php?intAdminID={$item.intAdminID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("admins.php?intAdminID={$item.intAdminID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intAdminID}?")'/></td>
	</tr>
	{/if}
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