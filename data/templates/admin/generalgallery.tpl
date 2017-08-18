<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("generalgallery.edit.php")'/>

<form action="generalgallery.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varName' text='Название' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varLink' text='Ссылка' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='intOrder' text='Вес' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='intPublish' text='Включен' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="100">Действия</th>
	</tr>
	{foreach name=admins from=$banner_zone item=item key=key}{if is_integer($key)}
	<tr >
		<td>{$item.varName}</td>
		<td>{$item.varLink}</td>
		<td>{$item.intOrder}</td>
		<td>{if $item.intPublish == 1}Да{else}Нет{/if}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("generalgallery.edit.php?intGeneralGalleryID={$item.intGeneralGalleryID}")'/>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("generalgallery.php?intGeneralGalleryID={$item.intGeneralGalleryID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intGeneralGalleryID}?")'/></td>
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