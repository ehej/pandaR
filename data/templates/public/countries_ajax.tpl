{if $special_offers}
{foreach from=$special_offers key=key item=item}
<div class="item expanded">
	<h1><span>{$key}</span></h1>
	<div>
	{foreach from=$item item=it}
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
							<a href="/">{$it.varName}</a><br/>
							(c {$it.varDateFrom|date_format:"%d.%m.%Y"} по {$it.varDateTo|date_format:"%d.%m.%Y"})
						</td>
						<td class="description">
							{$it.varDescription}
							Продолжительность тура: {$it.varDuration} ночей
						</td>
						<td style="width: 120px;">
							<a href="#"><img src="{$PROJECT_URL}images/info.gif" /></a>&nbsp;
							{if $it.varFile}<a href="{$FILES_URL}{$it.varFile}"><img src="{$PROJECT_URL}images/ic_excel.gif" /></a>&nbsp;{/if}
							<a href="#" style="font-weight: bold; color: #0A5095;">On-Line</a>
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