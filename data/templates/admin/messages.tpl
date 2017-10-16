<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("messages.edit.php")'/>

<form action="messages.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varSubject" id="varSubject" class="titled" value="{$filter.LIKEvarSubject}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varDate' text='Дата рассылки' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varSubject' text='Тема' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Действия</th>
	</tr>
	{foreach from=$messages_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="messages.edit.php?intMessageID={$item.intMessageID}"'>
		<td>{if $item.varDate!='0000-00-00 00:00:00'}{$item.varDate}{else}еще не рассылалось{/if}</td>
		<td>{$item.varSubject}</td>
		<td nowrap="nowrap" width="100">
			<input type="button" class="iconize" rel="50" value="Разослать" onclick='javascript:Go("messages.edit.php?event=send&intMessageID={$item.intMessageID}")'/>
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("messages.edit.php?intMessageID={$item.intMessageID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("messages.php?intMessageID={$item.intMessageID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intMessageID}?")'/></td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<!-- /Таблица -->
{include file="scroller.tpl" pager=$messages_list.pager script=1}
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