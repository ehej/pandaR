<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	<h1>{$curCountry.varName}</h1>
	{include file="layout/country_navigation.tpl"}
	<table class="countryTitle">
		<tr>
			<td valign="top">
				{if $data_filter.intResortID}
					<h1>{$FilterName}</h1>
				{else}
					<h1 class="no5" style="background-image: url('{$FILES_URL}{$relation.varImageFlag|substr:0:3}/{$relation.varImageFlag}')">{$Nname}</h1>
				{/if}
			</td>
		</tr>
	</table>
	<form action="">
   <div class="filter hotels rounded">
		<div class="tl"></div>
		<div class="tr"></div>
		<div class="bl"></div>
		<div class="br"></div>
		<div class="info">
			<table class="content-table">
				<tr class="table-heading">
					<td class="rate-col"  width="100">Категория</td>
					<td>Название</td>
					<td width="150">Курорт</td>
					<!--td width="150">Регион</td-->
					<td width="100">Цена, от</td>
				</tr>
			{assign var="i" value=1}
			{foreach from=$hotel item=hotel_item key=key}
				{if is_integer($key)}
				<tr {if $i%2==1}class="odd"{/if}>
					<td class="first"><span class="rate">{$hotel_item.varCountStars}*</span></td>
					<td><a href="{$hotel_item.link}">{$hotel_item.varName|escape|htmlspecialchars_decode}</a></td>
					<td>{$resort[$hotel_item.intResortID].varName}</td>
					<!--td>{$region[$hotel_item.intRegionID].varName}</td-->
					<td class="price">{$hotel_item.varPriceAt} {$hotel_item.varMark}</td>
				</tr>
				{assign var="i" value=$i+1}
				{/if}
			{foreachelse}
				<tr>
					<td colspan="2" align="center">К сожалению, по данному критерию ничего не найдено</td>
				</tr>
			{/foreach}

		</table>
		</div>
	</div>
	{include file='scroller_for_public.tpl' pager=$hotel.pager script=1}
</form>
</div>
{include file="comments.tpl"}
{include file="contests.tpl"}