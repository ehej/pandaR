<h1>{$pagetitle} (всего: {$total_items})</h1>

<form action="applications.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>

<table class="bordered" width="100%">
	<tr>
		<th>{include file='sortlink.tpl' field='intOrderID' text='ID' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varFIO' text='ФИО' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varTel' text='Телефон' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varMail' text='E-mail' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varComments' text='Комментарий' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varTourName' text='Название тура' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varDateFrom' text='Дата с' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varDateTo' text='Дата по' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Действия</th>
	</tr>
	{foreach from=$applications_list item=item key=key}{if is_integer($key)}
	<tr {if $item.varStatus=='confirmed'}Подтверждена{elseif $item.varStatus=='pending'} style="background:#FFCC99;"{elseif $item.varStatus=='denial'} style="background:#FFB6C1;"{/if}>
		<td>{$item.intOrderID}</td>
		<td nowrap>{$item.varFIO}</td>
		<td nowrap>{$item.varTel}</td>
		<td nowrap>{$item.varMail}</td>
		<td nowrap>{$item.varComments|nl2br}</td>
		<td nowrap><a href="tours.edit.php?intTourID={$item.intTourID}">{$item.varTourName}</a></td>
		<td nowrap>{$item.varDateFrom|date_format:"%d.%m.%Y"}</td>
		<td nowrap>{$item.varDateTo|date_format:"%d.%m.%Y"}</td>
		<td nowrap="nowrap">
		<input type="button" class="iconize" rel="83" value="" onclick='OnDelete("applications.php?intOrderID={$item.intOrderID}&event=delete", "Вы уверены, что хотите удалить эту заявку?")'/>
		</td>
	</tr>
	{/if}{foreachelse}
		<tr><td colspan="8" align="center" style="text-align: center">Нет записей</td></tr>
	{/foreach}
</table>
{include file="scroller.tpl" pager=$applications_list.pager script=1}
</form>
{literal}
<script>
function sortByField(field, sorder) {
	$('#sortBy').val(field);
	$('#sortOrder').val(sorder);
	$('#searchForm').submit();
}
</script>
{/literal}