<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("spoeditor.edit.php")'/>

<form action="spoeditor.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='intSPOEditorID' text='ID' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varName' text='Название' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varDepartureDate' text='Дата вылета' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varValidUntilDate' text='Действует до' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Действия</th>
	</tr>
	{foreach from=$spo_editor_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="spoeditor.edit.php?intSPOEditorID={$item.intSPOEditorID}"'>
		<td>{$item.intSPOEditorID}</td>
		<td>{$item.varName|strip_tags|truncate:70}</td>
		<td>{$item.varDepartureDate|date_format:"%d.%m.%Y"}</td>
		<td>{$item.varValidUntilDate|date_format:"%d.%m.%Y"}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("spoeditor.edit.php?intSPOEditorID={$item.intSPOEditorID}")'/>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("spoeditor.php?intSPOEditorID={$item.intSPOEditorID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intSPOEditorID}?")'/>
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
{include file="scroller.tpl" pager=$spo_editor_list.pager script=1}
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