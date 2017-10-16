<h1>{$pagetitle}</h1>


<form action="currencies.php" name="editForm" method="POST" id="searchForm">
<input type="hidden" name="event" value="save">
<table class="bordered" width="100%">
	<tr>
		<th>ID</th>
		<th>Название</th>
		<th>Курс</th>
		<th>Обозначение</th>
	</tr>
	{foreach from=$roles item=item key=key}{if is_integer($key)}
	<tr >
		<td>{$item.intCurrencyID}</td>
		<td><input type="text" name="varName[{$item.intCurrencyID}]" value="{$item.varName}"></td>
		<td><input type="text" name="intRate[{$item.intCurrencyID}]" value="{$item.intRate}"></td>
		<td><input type="text" name="varMark[{$item.intCurrencyID}]" value="{$item.varMark}"></td>
	</tr>
	{/if}
	{/foreach}
	<tr>
		<td colspan="4">
		{html_select_date field_order=DMY prefix="varDate" time=$smarty.now start_year="+0" end_year="+10" month_format=%m}
		<input type="button" class="iconize" rel="95" value="Календарь" onclick="displayCalendarSelectBox(document.editForm.varDateYear,document.editForm.varDateMonth,document.editForm.varDateDay,false,false,this);"/>
		<span style="float:right;"><input type="submit" class="iconize" rel="23" value="Сохранить" /></span>
		</td>
	</tr>
</div>
</table>
</form>
<br><hr>
<h2>Архив</h2>
<table class="bordered" width="100%">
	<tr>
		<th>Дата</th>
		{foreach from=$roles item=item}
		{if $item.intCurrencyID!=1}<th>{$item.varName}</th>{/if}
		{/foreach}
		<th width="50">Действия</th>
	</tr>
	<tr>
	{foreach from=$archive item=item key=key name=archivecurr}{if is_integer($key)}
		{if ($aid!=$item.intArchiveID && !$smarty.foreach.archivecurr.first)}
			<td><input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("currencies.php?intArchiveID={$item.intArchiveID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intArchiveID}?")'/></td>
		</tr>
		<tr>
			<td>{$item.varDate|date_format:"%d-%m-%Y"}</td>
		{/if}
		{if !$aid}<td>{$item.varDate|date_format:"%d-%m-%Y"}</td>{/if}
		{assign var=aid value=$item.intArchiveID}
		{foreach from=$roles item=it}
			{if $it.intCurrencyID==$item.intCurrencyID && $item.intCurrencyID!=1}<td>{$item.intRate}</td>{/if}
		{/foreach}
		{if $smarty.foreach.archivecurr.last}<td><input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("currencies.php?intArchiveID={$item.intArchiveID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intArchiveID}?")'/></td>{/if}
	{/if}
	{/foreach}
	</tr>
</table>

