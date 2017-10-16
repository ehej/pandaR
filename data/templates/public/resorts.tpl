{include file="banners.tpl"}
<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	<table class="countryTitle">
		<tr>
			<td valign="top"><h1 class="no5" style="background-image: url('{$FILES_URL}{$relation.varImageFlag|substr:0:3}/{$relation.varImageFlag}')">{$data.country.varName} - курорты</h1></td>
		</tr>
	</table>
	<h1>{$curCountry.varName}</h1>
	{include file="layout/country_navigation.tpl"}
	<form action="">
		<table class="tours-table" width="100%">
			<tr class="table-heading">
				<td class="tour-name"  width="150">Название / курорт</td>
				<td class="tour-name">Краткое описание</td>
			</tr>
			{assign var="i" value=1}
			{foreach from=$resort_data item=item}		
			<tr {if $i%2==1}class="odd"{/if}>
				<td class="tour-name"><a href="{$item.link}"><strong>{$item.varName|escape}</strong></a></td>
				<td align="left"><div class="resort_short">{$item.varShortDescription|strip_tags|truncate:120}</div></td>
			</tr>
			{assign var="i" value=$i+1}
			{/foreach}
		</table>
	{include file='scroller_for_public.tpl' pager=$hotel.pager script=1}
	</form>
	<div class="clear"></div>
</div>
{include file="comments.tpl"}	
{include file="contests.tpl"}
<script type="text/javascript">
{literal}
$(function() {
	/*
	$('.resort_short').hover(function() {
		$(this).css('overflow', 'inherit');
		$(this).addClass('hovered');
	}, function() {
		$(this).css('overflow', 'hidden')
		$(this).removeClass('hovered');
	})
	*/
})
{/literal}
</script>