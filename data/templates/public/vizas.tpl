
{if $smarty.get.intTourID}
<div>
	<h2>{$data.varName}</h2><br>
	<div>{$data.varDescription}</div>
</div>
{else}
<div class="tours">
{foreach from=$ctours item=items key=key}
	<div class="heading-orange">
		<h2 class="title"><span>{$key}</span></h2>
	</div>
	<table class="tours-table" width="100%">
		<tr class="table-heading">
			<td class="tour-name">Название / курорт</td>
			<td>Дней</td>
			<td class="time">Период действия цен</td>
			<td class="transport-icon">&nbsp;</td>
			<td>Размещение</td>
			<td>Питание</td>
			<td>Цена</td>
			<td>&nbsp;</td>
		</tr>
		{foreach from=$items item=item}
		<tr>
			<td class="tour-name"><span class="rate">{$item.varCountStars}*</span> <a href="tours.php?intTourID={$item.intTourID}"><strong>{$item.varName}</strong> / {$item.varResortName}</a></td>
			<td width="40">{$item.intCountDays} нч.</td>
			<td width="150" class="small">с {$item.varDateFrom} по {$item.varDateTo}</td>
			<td width="40"><img src="images/{$item.varTransport}.png" width="21" height="19" alt="" /></td>
			<td width="70">{$item.varPlaceTypeName}</td>
			<td width="70">{$item.varFoodTypeName}</td>
			<td width="70" class="price">{$item.intPriceFrom} {$item.varMark}</td>
			<td width="80"><a href="order.php?intTourID={$item.intTourID}" class="order-button">Заказать</a></td>
		</tr>
		{/foreach}
	</table>
{foreachelse}
		<h2>Ещё нет туров в этом разделе</h2>
{/foreach}
</div>
{/if}