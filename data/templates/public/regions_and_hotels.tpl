{literal}
<style type="text/css">
<!--
	a:link {}
	a:visited {text-decoration: underline;}
	a:active {text-decoration: underline;}
	a:hover {text-decoration: underline;}
	a {text-decoration: none;}
	
	.inCenter .sliders .box table a:hover {
		text-decoration: underline;
	}
-->
</style>
{/literal}
{include file="banners.tpl"}
<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	<div class="item expanded">
		<div class="Title">
			<h1><a href="/countries.php?intCountryID={$data.country.intCountryID}" style="text-decoration: none; color: #0A5095;">{$data.country.varName}</a></h1>
		</div>
		<div>
		{foreach from=$data item=item key=key}
			{if is_integer($key) && $item.hotels}
			<div class="box expanded-box">
				<h2>
					<div style="display: inline; color: white; font-weight: bold; cursor: pointer; float: left; margin: 0px 0px 0px 15px;" onclick="javascript:document.location.href='/region.php?intRegionID={$item.intRegionID}';">{$item.varName}</div><span>&nbsp;</span>
					<a href="/region.php?intRegionID={$item.intRegionID}">Описание региона »</a>
				</h2>
				<div>
					<ul style="list-style-image: url(/../../../images/dot.gif);">
						<table><tr><td style="vertical-align: top;">
							<table>
							{foreach from=$item.hotels item=it name=hotels1}
								{if $smarty.foreach.hotels1.iteration<=$smarty.foreach.hotels1.total/2}
									<tr><td><li style=""><a href="/hotel.php?intHotelID={$it.intHotelID}" style="color: #0A5095; font-size: 12px;">{$it.varName}</a></li></td>
									<td style="width: 20px; color: #0A5095; font-size: 12px;">{if $it.intCountStars!=0}{$it.intCountStars}*{/if}</td>
									</tr>							
								{/if}
							{/foreach}
							</table>
							</td>
							<td style="vertical-align: top;">
							<table>
							{foreach from=$item.hotels item=it name=hotels2}
								{if $smarty.foreach.hotels2.iteration>$smarty.foreach.hotels2.total/2}
									<tr><td><li><a href="/hotel.php?intHotelID={$it.intHotelID}" style="color: #0A5095; font-size: 12px;">{$it.varName}</a></li></td>
									<td style="width: 20px; color: #0A5095; font-size: 12px;">{if $it.intCountStars!=0}{$it.intCountStars}*{/if}</td></tr>							
								{/if}
							{/foreach}
							</table>
						</td></tr></table>
					</ul>
				</div>
			</div>
			{/if}
		{/foreach}
		</div>
	</div>
	
	{include file="galleries.tpl"}
	
	{include file="comments.tpl"}
	
	{include file="contests.tpl"}
	
</div>