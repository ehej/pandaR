<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("countries_catalog.edit.php")'/>

<form action="countries_catalog.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<input type="hidden" name="event" id="event" value=""/>
<div align="right">
	<input type="button" value="Сохранить порядок" class="iconize" rel="82" onclick="saveOrder()"/>
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>
<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th width="300">{include file='sortlink.tpl' field='varName' text='Название страны' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Ссылка</th>
		<th>{include file='sortlink.tpl' field='isActive' text='Активен' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="50">{include file='sortlink.tpl' field='intOrder' text='Порядок' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Действия</th>
	</tr>
	{foreach from=$countries_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='javascript:Go("countries_catalog.edit.php?intCountryID={$item.intCountryID})"'>
		<td>{$item.varName}</td>
		<td nowrap="nowrap"><a href="{$item.link}" target="_blank">{$item.link}</a></td>
		<td>{if $item.isActive == 1}Да{else}Нет{/if}</td>
		<td><input style="width: 40px" name="order[{$item.intCountryID}]" value="{$item.intOrder|default:0}"/></td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("countries_catalog.edit.php?intCountryID={$item.intCountryID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("countries_catalog.php?intCountryID={$item.intCountryID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intCountryID}?")'/>
			<input type="button" class="iconize" rel="52" value="Меню страны" onclick='javascript:Go("catalog_menu.php?intCountryID={$item.intCountryID}")'/>
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
{include file="scroller.tpl" pager=$countries_list.pager script=1}
</form>

<script>
{literal}
function sortByField(field, sorder) {
	$('#sortBy').val(field);
	$('#sortOrder').val(sorder);
	$('#searchForm').submit();
}
function saveOrder() {
	$('#event').val('saveorder');
	$('#searchForm').submit();
}
{/literal}
</script>