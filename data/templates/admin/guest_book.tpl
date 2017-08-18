<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("guest_book.edit.php")'/>

<form action="guest_book.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varLogin" id="varLogin" class="titled" value="{$filter.LIKEvarLogin}" title="Login" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varDate' text='Дата' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varName' text='Имя' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varEmail' text='E-mail' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varSite' text='WWW' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Текст</th>
		<th>Действия</th>
	</tr>
	{foreach name=guest_book from=$data_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="guest_book.edit.php?intGBID={$item.intGBID}"'>
		<td nowrap="nowrap">{$item.varDate|date_format:'%d.%m.%Y %H:%M'}</td>
		<td>{$item.varName}</td>
		<td>{$item.varEmail}</td>
		<td>{$item.varSite}</td>
		<td>{$item.varText|strip_tags|mb_substr:0:50:'UTF8'}{if $item.varText|mb_strlen:'UTF8' > 50}...{/if}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("guest_book.edit.php?intGBID={$item.intGBID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("guest_book.php?intGBID={$item.intGBID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intGBID}?")'/></td>
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