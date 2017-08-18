{literal}
<script type="text/javascript">
function SaveForm() {
	$('#event').val('save');
}
</script>
{/literal}
<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("document.edit.php")'/>

<form action="document.php" method="POST" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<input type="hidden" name="event" id="event" value="" />

<div align="right">
	<select name="intCategoryID">
		<option value="">все</option>
		{foreach from=$category item=item}
			<option value="{$item.intCategoryID}" {if $item.intCategoryID == $filter.intCategoryID}selected="selected"{/if}>{$item.varName}</option>
		{/foreach}
	</select>
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varName' text='Название' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Категоря</th>
		<th>{include file='sortlink.tpl' field='varUrlAlias' text='Ссылка (Alias)' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='isActive' text='Активен' sortorder=$sortOrder sortby=$sortBy script=true}</th>
        <th>{include file='sortlink.tpl' field='intOrdering' text='Порядок' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Действия</th>
	</tr>
	{foreach from=$document item=item key=key}{if is_integer($key)}
	<tr onDblClick='javascript:Go("document.edit.php?intDocumentID={$item.intDocumentID})"'>
		<td>{$item.varName}</td>
		<td>{$category[$item.intCategoryID].varName}</td>
		<td nowrap="nowrap"><a href="{$item.link}" target="_blank">{$item.varFileNameReal}</a></td>
		<td style="text-align: center;">{if $item.isActive=='1'}<span style="color: green;">да</span>{else}<span style="color: red;">нет</span>{/if}</td>
        <td style="text-align: center;"><input type="text" id="intOrdering" name="intOrdering[{$item.intDocumentID}]" size="4" value="{$item.intOrdering}" /></td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("document.edit.php?intDocumentID={$item.intDocumentID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("document.php?intDocumentID={$item.intDocumentID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intDocumentID}?")'/></td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<input type="submit" onclick="SaveForm()" value="Сохранить порядок" rel="82" class="iconize" style="background-position: 2px -1311px;float:right;">
<!-- /Таблица -->
{include file="scroller.tpl" pager=$document.pager script=1}
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