{literal}
<script type="text/javascript">
	function selectAll() {
		if($('#allCheckBoxes').attr('checked')) {
			$('input[type=checkbox].checkboxes').attr('checked', 'checked');
		} else {
			$('input[type=checkbox].checkboxes').attr('checked', '');
		}
	}
	function deleteSelected() {
		txt = "Вы действительно хотите удалить выделенные записи?";
		if (confirm(txt)){
			$('#event').val('deleteItems');
			$('#searchForm').submit();
		}
	}
</script>
{/literal}
<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("special_offers.edit.php")'/>

<form action="special_offers.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<input type="hidden" name="event" id="event" value=""/>
<div align="right">
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th><input type="checkbox" value="" onclick="$('.checkboxes').attr('checked', $(this).attr('checked'))" /></th>
		<th>{include file='sortlink.tpl' field='varName' text='Название СПО' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varDateCreated' text='Дата создания' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varDateValid' text='Действует до' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='isShow' text='Отображать' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varMinPrice' text='Мин. цена' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Действия</th>
	</tr>
	{foreach from=$special_offers_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="special_offers.edit.php?intSpecOffID={$item.intSpecOffID}"'>
		<td><input type="checkbox" class="checkboxes" value="{$item.intSpecOffID}" name="cb[]" id="cb_{$item.intSpecOffID}" /></td>
		<td>{$item.varName|truncate:70}</td>
		<td style="text-align: center;">{$item.varDateCreated|date_format:"%d.%m.%Y"}</td>
		<td style="text-align: center;">{$item.varDateValid|date_format:"%d.%m.%Y"}</td>
		<td style="text-align: center;">{if $item.isShow=='1'}<span style="color: green;">да</span>{else}<span style="color: red;">нет</span>{/if}</td>
		<td style="text-align: center;">{$item.varMinPrice}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("special_offers.edit.php?intSpecOffID={$item.intSpecOffID}")'/>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("special_offers.php?intSpecOffID={$item.intSpecOffID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intSpecOffID}?")'/>
			<input type="button" class="iconize" rel="80" value="Копировать" onclick='javascript:Go("special_offers.edit.php?intSpecOffID={$item.intSpecOffID}&event=copy")'/>
		</td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
	{if $special_offers_list}
	<tr>
		<td colspan="8" align="center" style="text-align: left"><input type="button" value="Удалить выделенные" onclick="deleteSelected();" /></td>
	</tr>
	{/if}
</table>
<!-- /Таблица -->
{include file="scroller.tpl" pager=$special_offers_list.pager script=1}
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