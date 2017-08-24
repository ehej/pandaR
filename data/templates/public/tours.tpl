{if !$print}
{include file="layout/bread_crumbs.tpl"}
<h1>{$curCountry.varName}</h1>
{include file="layout/country_navigation.tpl"}
{/if}
{if $smarty.get.intTourID}
	<div>
		<h2 style="color: #4E9F2C;">{$data.varName}</h2>
		{if !$print}
		<a class="order-button" style="float: right;position: relative; bottom: 5px;margin-left: 10px;" href="/order.php?intTourID={$data.intTourID}">Заказать</a>
		<a class="order-button" style="float: right;position: relative; bottom: 5px;" href="?intTourID={$data.intTourID}&event=print">Печать</a>
		{/if}
		<table class="tour_params hovered">
		{if $data.varResortName}
		<tr>
			<td class="param">Курорт(ы):</td><td>{$data.varResortName}</td>
		</tr>
		{/if}
		<tr>
			<td class="param">Период действия цен:</td><td>
			{assign var="end1" value="день"}
			{assign var="end2" value="дня"}
			{assign var="end3" value="дней"}
			
			с {$data.varDateFrom|date_format:"%d.%m.%Y"} по {$data.varDateTo|date_format:"%d.%m.%Y"}{*if $data.intCountDays}, {$data.intCountDays} {$data.intCountDays|declination:$end1:$end2:$end3:"%s"}{/if*}</td>
		</tr>
		{if $data.varStatement}
		<tr>
			<td class="param">Показания:</td><td>{$data.varStatement}</td>
		</tr>
		{/if}
		{if $data.varHeat}
		<tr>
			<td class="param">Заезды:</td><td>{$data.varHeat}</td>
		</tr>
		{/if}
		{if $data.intCountDays || $data.varDays}
		<tr>
			<td class="param">Количество дней:</td><td>{if $data.varDays}{$data.varDays}{else}{$data.intCountDays}{/if}</td>
		</tr>
		{/if}
		{if $data.varFile3 || $data.varFile2 || $data.varFile1}
		<tr>
			<td class="param">Файлы:</td>
			<td>
				<a href="{$FILES_URL}{$data.varFile1}" target="_blank">{$data.varRealFile1Name}</a><br />
				<a href="{$FILES_URL}{$data.varFile2}" target="_blank">{$data.varRealFile2Name}</a><br />
				<a href="{$FILES_URL}{$data.varFile3}" target="_blank">{$data.varRealFile3Name}</a>
			</td>
		</tr>
		{/if}
		</table>
		<br />
		{include file="layout/gallery.tpl"}
		{if $data.hotel}
			<div class="tour_top_description">{$data.hotel.varDescription}</div><br/>
		{else}
			<div class="tour_top_description">{$data.varDescription}</div><br/>
		{/if}
		<div class="tour_bottom_description">{$data.varDescriptionBottom}</div>
		{if $UserData}
		<div class="foragencies">
			<div class="islogon">Вы авторизованы как {$UserData.varName}</div>
			<div class="comission">Комиссия для агентств с этого тура составляет: {$data.varAgencyComission}</div>
			<div class="agencydescription">{$data.varAgencyDescription}</div>
		</div>
		{/if}
	</div>
{else}
	<div class="tours">
	{foreach from=$ctours item=items key=key}
		<div class="heading-blue">
			<h2 class="title"><span>{$key}</span></h2>
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
			{foreach from=$items item=item}		
			<tr {if $i%2==1}class="odd"{/if}>
				<td class="tour-name"><span class="rate">{$item.varCountStars}*</span><a href="/tours-country/{$item.tourCountryUri}/?intTourID={$item.intTourID}"><strong>{$item.varName}</strong> / {$item.varResortName}</a></td>
				<td width="40">{$item.intCountDays} дн.</td>
				<!--td width="150" class="small">с {$item.varDateFrom|date_format:"%d.%m.%Y"} по {$item.varDateTo|date_format:"%d.%m.%Y"}
				</td-->
				<td width="80" align="center">
					{if $item.varTransport}
						{assign var="transport" value=','|explode:$item.varTransport}
						{foreach from=$transport  item=trnsp}
							<img src="/images/{$trnsp}.png" alt="" />
						{/foreach}
					{/if}
				</td>
				<!--td width="70">{$item.varPlaceTypeName}</td-->
				<td width="70">{$item.varFoodTypeName}</td>
				<td width="70" class="price">{$item.intPriceFrom} {$item.varMark}</td>
				<td width="80"><a href="/order.php?intTourID={$item.intTourID}" class="order-button">Заказать</a></td>
			</tr>
			{assign var="i" value=$i+1}
			{/foreach}
		</table>
	{foreachelse}<center>
			<h2>Под запрос, мы индивидуально рассчитаем Вам тур любой сложности 
			537 23 23 </h2></center>
	{/foreach}
	</div>
{/if}