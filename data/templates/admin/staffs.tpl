<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("staffs.edit.php")'/>

<form action="staffs.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varLogin" id="varLogin" class="titled" value="{$filter.LIKEvarLogin}" title="Login" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='intStaffID' text='ID' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varName' text='Ф. И. О.' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Категория</th>
		<th>Контакты</th>
		<th>Страны</th>
		<th>{include file='sortlink.tpl' field='varView' text='Опубликовано' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="100">Действия</th>
	</tr>
	{foreach name=staffs from=$staffs_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="staffs.edit.php?intStaffID={$item.intStaffID}"'>
		<td>{$item.intStaffID}</td>
		<td>{$item.varName}</td>
		<td>{$types_staff[$item.intStaffID]}</td>
		<td>{$contacts[$item.intStaffID]}</td>
		<td>{$countries_staff[$item.intStaffID]}</td>
		<td>{if $item.varView=='yes'}Да{else}Нет{/if}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("staffs.edit.php?intStaffID={$item.intStaffID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("staffs.php?intStaffID={$item.intStaffID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intStaffID}?")'/></td>
	</tr>
	{/if}{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<!-- /Таблица -->
{include file="scroller.tpl" pager=$staffs_list.pager script=1}
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