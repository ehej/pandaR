<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("forms.edit.php")'/>

<form action="forms.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название формы" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='intFormID' text='ID' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varName' text='Название' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varIdentificator' text='Идентификатор' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varView' text='Активно' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Код для вставки</th>
		<th>Действия</th>
	</tr>
	{foreach name=form from=$form_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="forms.edit.php?intFormID={$item.intFormID}"'>
		<td>{$item.intFormID}</td>
		<td>{$item.varName}</td>
		<td>{$item.varIdentificator}</td>		
		<td>{if $item.isActive=='0'}Да{else}Нет{/if}</td>
		<td>{literal}{{/literal}form name={$item.varIdentificator}{literal}}{/literal}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("forms.edit.php?intFormID={$item.intFormID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("forms.php?intFormID={$item.intFormID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intFormID}?")'/></td>
	</tr>
	{/if}{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<!-- /Таблица -->
{include file="scroller.tpl" pager=$form_list.pager script=1}
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
