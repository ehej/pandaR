{if $special_offers}
{foreach from=$special_offers key=key item=item}
	
<div class="item expanded">
	<h1>
	{foreach from=$countries item=it}{if $key==$it.varName}{assign var=id value=$it.intCountryID}{/if}{/foreach}
		<a href="/countries.php?intCountryID={$id}" style="text-decoration: none; color: #0A5095;">{$key}</a>
		<span>&nbsp;</span>
	</h1>
	<div>
	{foreach from=$item item=it name=spos}
		<div class="box expanded-box">
			<h2>
				<span>
				{foreach from=$promotion_types item=i}
					{if $it.intPromotionTypeID==$i.intPromotionTypeID}{$i.varName}{/if}
				{/foreach}
				</span> 
				<a href="/">Все предложения и цены &raquo;</a>
			</h2>
			<div>
				<table>
					<tr>
						<td class="date">{$it.varDateCreated|date_format:"%d.%m"}</td>
						<td class="place">
							{if $it.varFile}<a href="{$FILES_URL}{$it.varFile}">{$it.varName}</a><br/>{else}{$it.varName}{/if}
							(c {$it.varDateFrom|date_format:"%d.%m.%Y"} по {$it.varDateTo|date_format:"%d.%m.%Y"})
						</td>
						<td class="description">
							{$it.varDescription}
							Продолжительность тура: {$it.varDuration} ночей
						</td>
						<td style="width: 120px;">
							<a href='javascript:showInfoTour("{$it.trHotels}", "{$it.trService}", "onLine{$smarty.foreach.spos.iteration}", "{$it.varFile}", "{$it.varDateCreated|date_format:"%d.%m"}", "{$it.varName}", "(c {$it.varDateFrom|date_format:"%d.%m.%Y"} по {$it.varDateTo|date_format:"%d.%m.%Y"})", "{$it.varDescription}", "Продолжительность тура: {$it.varDuration} ночей"); $.noop();'><img src="{$PROJECT_URL}images/info.gif" /></a>&nbsp;
							{if $it.varFile}<a href="{$FILES_URL}{$it.varFile}"><img src="{$PROJECT_URL}images/ic_excel.gif" /></a>&nbsp;{/if}
							<a id="onLine{$smarty.foreach.spos.iteration}" href="http://online.mibs.kiev.ua/Extra/QuotedDynamic.aspx?country={foreach from=$countries item=ite}{if $key==$ite.varName}{$ite.intMTCountryID}{/if}{/foreach}&tour={$it.intSpecOffIDMT}&dateFrom={$it.varDateFromMT|date_format:"%Y-%m-%d"}&dateTo={$it.varDateToMT|date_format:"%Y-%m-%d"}" style="font-weight: bold; color: #0A5095;">On-Line</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
		{/foreach}
	</div>
</div>
{/foreach}
{else}
<div align="center" style="color: #0A5095; font-size: 12px;">По Вашему запросу спецпредложений не найдено</div>
{/if}