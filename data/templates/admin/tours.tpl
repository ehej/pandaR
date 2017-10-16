<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("tours.edit.php")'/>

<form action="tours.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
	<tr>
		<th width="10">{include file='sortlink.tpl' field='intTourID' text='ID' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varName' text='Название' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="70">{include file='sortlink.tpl' field='intTypeID' text='Тип' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="70">{include file='sortlink.tpl' field='intCountryID' text='Страна' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="50">{include file='sortlink.tpl' field='varDateFrom' text='Дата начала' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="50">{include file='sortlink.tpl' field='varDateTo' text='Дата окончания' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="30">{include file='sortlink.tpl' field='intPriceFrom' text='Цена от' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="30">{include file='sortlink.tpl' field='isSpecial' text='Спец.' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="30">{include file='sortlink.tpl' field='isVisible' text='Отобр.' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th width="30">{include file='sortlink.tpl' field='isIndex' text='Глав.' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Действия</th>
	</tr>
	{foreach from=$tours_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="tours.edit.php?intTourID={$item.intTourID}"' {if $item.varDateTo < date('Y-m-d')}style="background: #FA8072"{/if} >
		<td>{$item.intTourID}</td>
		<td>{$item.varName}</td>
		<td>{$item.varTypeName}</td>
		<td>{$item.varCountryName}</td>
		<td nowrap="nowrap">{$item.varDateFrom|date_format:"%d-%m-%Y"}</td>
		<td nowrap="nowrap">{$item.varDateTo|date_format:"%d-%m-%Y"}</td>
		<td nowrap="nowrap">{$item.intPriceFrom} {$item.varMark}</td>
		<td>{if $item.isSpecial == '1'}да{else}нет{/if}</td>
		<td>{if $item.isVisible == '1'}да{else}нет{/if}</td>
		<td>{if $item.isIndex == '1'}да{else}нет{/if}</td>
		<td nowrap="nowrap"><input type="button" class="iconize" rel="52" value="" onclick='javascript:Go("tours.edit.php?intTourID={$item.intTourID}")'/>
			<input type="button" class="iconize" rel="83" value="" onclick='javascript:OnDelete("tours.php?intTourID={$item.intTourID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intTourID}?")'/></td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="12" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
{include file="scroller.tpl" pager=$tours_list.pager script=1}
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