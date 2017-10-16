{literal}
<script type="text/javascript">
function SaveForm() {
	$('#event').val('save');
}
</script>
{/literal}
<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("static_zone.edit.php")'/>

<form action="static_zone.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<input type="hidden" name="event" id="event" value="" />
<div align="right">
	<input type="text" name="varText" id="varText" class="titled" value="{$filter.LIKEvarText}" title="Поиск по тексту" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varPosition' text='Позиция' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varText' text='Текст' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varOrdering' text='Вес' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="100">Действия</th>
	</tr>
	{foreach name=admins from=$static_zone item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="static_zone.edit.php?intSZID={$item.intSZID}"'>
		<td>{$position[$item.varPosition]}</td>
		<td>{$item.varText|strip_tags|mb_substr:0:150:'UTF8'}</td>
		<td style="text-align: center;"><input type="text" name="intOrdering[{$item.intSZID}]" size="4" value="{$item.intOrdering}" /></td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("static_zone.edit.php?intSZID={$item.intSZID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("static_zone.php?intSZID={$item.intSZID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intSZID}?")'/></td>
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
<input type="submit" onclick="SaveForm()" value="Сохранить порядок" rel="82" class="iconize" style="background-position: 2px -1311px;float:right;">
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