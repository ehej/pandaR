			{include file="banners.tpl"}
	        <div class="innerPage">
	        	{include file="layout/bread_crumbs.tpl"}
	        	<div class="Title">
					<h1>{$data.varName}</h1>
				</div>
				<div class="countryTitle">
					<h2>{$data.varHead}</h2>
				</div>
	      
	            <div>
	                <table cellpadding="0" cellspacing="0" class="table_hotel">
					{foreach from=$promo_hotel_list item=itemp key=key}
						{if is_integer($key) && count($promo_hotel_details_list[$itemp.intHotelPromoID])>0}
						<tr>
							<th colspan="3">{if $itemp.varLink}<a href="{$itemp.varLink}">{/if}{$itemp.varNameHotel}{if $itemp.varLink}</a>{/if}</th>
						</tr>
						<tr>
						{foreach from=$promo_hotel_details_list[$itemp.intHotelPromoID] item=item key=key name=details}
							{if !$smarty.foreach.details.first}</tr><tr>{/if}
							<td>{$item.varUsloviya}</td>
							<td>{$item.varTextAdd}</td>
							<td class="dates">период заезда <br /><span>{$item.varDateFrom|date_format:'%d.%m.%Y'} - {$item.varDateTo|date_format:'%d.%m.%Y'}</span></td>
						{/foreach}
						</tr>
						{/if}
					{/foreach}
					</table>
					<br>	                
	            </div>
	            <table class="countryTitle">
	            	<tr>
	                    <td><h2>{$data.varFoot}</h2></td>
	                </tr>
	            </table>
	            {include file="galleries.tpl"}
	
				{include file="comments.tpl"}
				
				{include file="contests.tpl"}
				<p>&nbsp;</p>
	            <p><a href="#" class="scrollTop">Наверх</a></p>
	            <div class="clear"></div>
	        </div>