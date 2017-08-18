<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("contacts.edit.php")'/>

<form action="contacts.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varLogin" id="varLogin" class="titled" value="{$filter.LIKEvarLogin}" title="Login" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='intContactID' text='ID' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varName' text='Ф. И. О.' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Контакты</th>
		<th>{include file='sortlink.tpl' field='varView' text='Опубликовано' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="100">Действия</th>
	</tr>
	{foreach name=contacts from=$contacts_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="contacts.edit.php?intContactID={$item.intContactID}"'>
		<td>{$item.intContactID}</td>
		<td>{$item.varName}</td>
		<td>{$contacts[$item.intContactID]}</td>
		<td>{if $item.varView=='yes'}Да{else}Нет{/if}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("contacts.edit.php?intContactID={$item.intContactID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("contacts.php?intContactID={$item.intContactID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intContactID}?")'/></td>
	</tr>
	{/if}{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<!-- /Таблица -->
{include file="scroller.tpl" pager=$contacts_list.pager script=1}
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