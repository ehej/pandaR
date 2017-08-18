<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("contests.edit.php")'/>

<form action="contests.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varTitle" id="varTitle" class="titled" value="{$filter.LIKEvarTitle}" title="Название" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varTitle' text='Название' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Ссылка</th>
		<th>Действия</th>
	</tr>
	{foreach from=$contests_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="gallerys.edit.php?intGalleryID={$item.intGalleryID}"'>
		<td>{$item.varTitle|truncate:70}</td>
		<td nowrap="nowrap">
			{foreach from=$pages item=it}
				{if $it.intContestID==$item.intContestID}
			<a href="{$PROJECT_URL}pages.php?intPageID={$it.intPageID}" target="_blank">{$PROJECT_URL}pages.php?intPageID={$it.intPageID}</a>, <br />
				{/if}
			{/foreach}
			{foreach from=$news item=it}
				{if $it.intContestID==$item.intContestID}
			<a href="{$PROJECT_URL}news.php?intNewsID={$it.intNewsID}" target="_blank">{$PROJECT_URL}news.php?intNewsID={$it.intNewsID}</a>, <br />
				{/if}
			{/foreach}
			{foreach from=$modules_pages item=it name=mod_pages}
				{if $it.intContestID==$item.intContestID}
			<a href="{$PROJECT_URL}{$it.varPage}.php" target="_blank">{$PROJECT_URL}{$it.varPage}.php</a>{if $smarty.foreach.mod_pages.last!=true}, <br />{/if} 
				{/if}
			{/foreach}
		</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("contests.edit.php?intContestID={$item.intContestID}")'/>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("contests.php?intContestID={$item.intContestID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intContestID}?")'/>
		</td>
	</tr>
	{/if}
	{foreachelse}
	<tr><td colspan="8" align="center" style="text-align: center">Нет записей</td></tr>
	{/foreach}
</table>
<!-- /Таблица -->
{include file="scroller.tpl" pager=$contests_list.pager script=1}
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