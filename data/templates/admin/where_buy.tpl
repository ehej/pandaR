<script type="text/javascript">
	{literal}
	function setCity(){
	
		area = $('#intAreaID').val();
		if(area){
			$('#intCityID option').css('display','none');
			$('#intCityID option[rel="'+area+'"]').css('display','');
			$('#intCityID option.free').css('display','');
			$('#intCityID option[rel="'+area+'"]:visible:first').attr('selected',true);
		}else{
			$('#intCityID option').css('display','');
		}
	}
	{/literal}
</script>

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("where_buy.edit.php")'/>

<form action="where_buy.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<select name="intAreaID" id="intAreaID" onchange="setCity()" >
		<option value="" class="free">все</option>
	{foreach from=$area_list item=item}
		<option value="{$item.intAreaID}" {if $filter.intAreaID==$item.intAreaID} selected="selected"{/if}>{$item.varName}</option>
	{/foreach}
	</select>
	<select name="intCityID" id="intCityID">
		<option value="" class="free">все</option>
	{foreach from=$city_list item=item}
		<option value="{$item.intCityID}" rel="{$item.intAreaID}" {if $filter.intAreaID!=$item.intAreaID && $filter.intAreaID != ''}style="display:none;"{/if} {if $filter.intCityID==$item.intCityID} selected="selected"{/if}>{$item.varName}</option>
	{/foreach}
	</select>
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varName' text='Название' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varPhone' text='Телефон' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varActivelyTo' text='Активно до' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Действия</th>
	</tr>
	{foreach from=$where_buy_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="where_buy.edit.php?intWhereBuyID={$item.intWhereBuyID}"'>
		<td>{$item.varName}</td>
		<td>{$item.varPhone}</td>
		<td>{$item.varActivelyTo|date_format:"%d.%m.%Y"}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("where_buy.edit.php?intWhereBuyID={$item.intWhereBuyID}")'/>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("where_buy.php?intWhereBuyID={$item.intWhereBuyID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intWhereBuyID}?")'/>
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
{include file="scroller.tpl" pager=$where_buy_list.pager script=1}
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