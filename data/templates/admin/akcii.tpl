<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("akcii.edit.php")'/>

<form action="akcii.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varTitle" id="varTitle" class="titled" value="{$filter.LIKEvarTitle}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varTitle' text='Название' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varAnnotation' text='Имя' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Ссылка</th>
		<th>{include file='sortlink.tpl' field='intActive' text='Отображать' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='intOnlyAuthorized' text='Отображать только авторизированным' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Действия</th>
	</tr>
	{foreach from=$akcii_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="akcii.edit.php?intAkciyID={$item.intAkciyID}"'>
		<td>{$item.varTitle|truncate:70}</td>
		<td>{$item.varAnnotation}</td>
		<td nowrap="nowrap"><a href="{$item.link}">{$item.link}</a></td>
		<td style="text-align: center;">{if $item.intActive=='1'}<span style="color: green;">да</span>{else}<span style="color: red;">нет</span>{/if}</td>
		<td style="text-align: center;">{if $item.intOnlyAuthorized=='1'}<span style="color: green;">да</span>{else}<span style="color: red;">нет</span>{/if}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("akcii.edit.php?intAkciyID={$item.intAkciyID}")'/>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("akcii.php?intAkciyID={$item.intAkciyID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intAkciyID}?")'/>
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
{include file="scroller.tpl" pager=$akcii_list.pager script=1}
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