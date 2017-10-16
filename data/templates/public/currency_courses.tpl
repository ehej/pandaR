{include file="banners.tpl"}
<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	<div class="Title">
		<h1>Курс валют. Архив</h1>
	</div>	
	<form action="/currency_courses.php" method="post" name="currencyForm" id="currencyForm">
	<table cellpadding="0" cellspacing="0" class="table_hotel">
		<tr>
			<th onclick="$('.htd').toggle();" width="100" style="cursor: pointer;">Фильтр</th>
			<td class="htd">Дата</td>
			<td class="htd"><input type="text" name="varDate" id="varDate" onclick="displayCalendar(this, 'dd.mm.yyyy', this);" value="{$curTime|date_format:'%d.%m.%Y'}" title="Дата" /></td>
			<td class="htd"><input type="submit" value="Показать" /></td>
			<td class="htd" style="display: none;height:31px;">&nbsp;</td>
		</tr>
	</table>
	</form>
	<br /><br />	
	<table class="tours-table" width="100%">
			<tr class="table-heading">
				<td class="tour-name"  width="150">Дата</td>
				<td class="tour-name">Валюта 1</td>
				<td class="tour-name">Валюта 2</td>
			</tr>	
	{foreach from=$kurs item=item name=gtd}
		<tr {if $i%2==1}class="odd"{/if}>
			<td class="tour-name">{$item.tdate|date_format:"%d.%m.%Y"}</td>
			<td class="currencyValue">1 {$item.alias_from}</td>
			<td class="currencyValue">{$item.rate} {$item.alias_to}</td>
		</tr>
	{/foreach}
	</table>
	
	{include file="galleries.tpl"}
	
	{include file="comments.tpl"}
	
	{include file="contests.tpl"}
	
</div>