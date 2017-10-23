<div class="tours">
{foreach from=$ctours item=items key=key}
	<div class="heading-orange">
		<div class="tri"></div><h2 class="title"><span>{$key}</span></h2>
	</div>
	<table class="tours-table" width="100%">
		<tr class="table-heading">
			<td class="tour-name">Название / курорт</td>
			<td>Дней</td>
			<!--td class="time">Период действия цен</td-->
			<td class="transport-icon">Транспорт</td>
			<!--td>Размещение</td-->
			<td>Питание</td>
			<td>Цена</td>
			<td>&nbsp;</td>
		</tr>
		{assign var="i" value=1}
		{foreach from=$items.tour item=item}
		<tr {if $i%2==1}class="odd"{/if}>
			<td class="tour-name"><span class="rate">{$item.varCountStars}*</span> <a href="/tours-country/{$items.tourCountryUri}/?intTourID={$item.intTourID}"><strong>{$item.varName}</strong> / {$item.varResortName}</a></td>
			<td width="40">{$item.intCountDays} дн.</td>
			<!--td width="150" class="small">с {$item.varDateFrom|date_format:'%d.%m.%Y'} по {$item.varDateTo|date_format:'%d.%m.%Y'}</td-->
			<td width="80" align="center">
			{if $item.varTransport}
					{assign var="transport" value=','|explode:$item.varTransport}
					{foreach from=$transport  item=trnsp}
						<img src="/images/{$trnsp}.png" alt="" />
					{/foreach}
				{/if}</td>
			<!--td width="70">{$item.varPlaceTypeName}</td-->
			<td width="70">{$item.varFoodTypeName}</td>
			<td width="70" class="price">{$item.intPriceFrom} {$item.varMark}</td>
			<td width="80"><a href="/order.php?intTourID={$item.intTourID}" class="order-button">Заказать</a></td>
		</tr>
		{assign var="i" value=$i+1}
		{/foreach}
	</table>
{/foreach}
</div>