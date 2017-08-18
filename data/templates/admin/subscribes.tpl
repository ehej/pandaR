<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("subscribes.edit.php")'/>

<form action="subscribes.php" method="GET" id="searchForm">
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varEmail" id="varTitle" class="titled" value="{$filter.LIKEvarEmail}" title="E-mail" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered" width="100%">
<!-- Таблица -->
	<tr>
		<th>{include file='sortlink.tpl' field='varDateAdd' text='Дата добавления' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varEmail' text='E-mail' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='isActive' text='Активен' sortorder=$sortOrder sortby=$sortBy script=true}</th>		
		<th width="100">Действия</th>
	</tr>
	{foreach from=$subscribes_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="subscribes.edit.php?intSubscribeID={$item.intSubscribeID}"'>
		<td>{$item.varDateAdd|date_format:'%d.%m.%Y %H:%M'}</td>
		<td>{$item.varEmail}</td>
		<td>{if $item.isActive == 1}Да{else}Нет{/if}</td>
		<td nowrap="nowrap"><input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("subscribes.edit.php?intSubscribeID={$item.intSubscribeID}")'/>
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("subscribes.php?intSubscribeID={$item.intSubscribeID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intSubscribesID}?")'/></td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="8" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<!-- /Таблица -->
{include file="scroller.tpl" pager=$subscribes_list.pager script=1}
</form>
{*<table width="100%">
	<tr>
		<td>
			<form action="subscribes.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="event" value="ImportData">
				<input type="file" name="importFile" >
				<input type="submit" value="Импорт">
			</form>
			<small>Формат файла<br>
			
			E-mail;Имя;Телефон;Компания;Страна;Должность;Дата добавления<br>
			E-mail2;Имя2;Телефон2;Компания2;Страна2;Должность2;Дата добавления2<br>
			</small>
		</td>
		<td align="right">
			<a href="subscribes.php?event=ExportData">Экспортировать</a>
		</td>
	</tr>
</table>*}
<script>
{literal}
function sortByField(field, sorder) {
	$('#sortBy').val(field);
	$('#sortOrder').val(sorder);
	$('#searchForm').submit();
}
{/literal}
</script>