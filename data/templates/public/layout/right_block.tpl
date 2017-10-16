           {if $fast_search}
           <!--[if IE]>
		        <iframe src="http://online.newstravel.com.ua/fast_search" style="width: 260px; height: 420px;" frameborder="0" SCROLLING=NO></iframe>
		<![endif]-->
		<!--[if !IE]><!-->
        <iframe src="http://online.newstravel.com.ua/fast_search" style="width: 260px; height: 390px;" frameborder="0" SCROLLING=NO></iframe>
 		<!--<![endif]-->
           {/if}
           {if $catalog_menu}
           <div class="box blueHead whiteBox has2level">
               <h2>{$curMenuName}</h2>
               <div class="innerContent open">
					{foreach from=$catalog_menu[0] item=item}
						{assign var='open_for_sm' value=0}
						{foreach from=$catalog_menu[$item.intMenuID] item=item2}{if $item2.link == $REQUEST_URI}{assign var='open_for_sm' value=1}{/if}{/foreach}
					<p {if $item.link == $REQUEST_URI || $item.isAllwaysOpen == 1 || $open_for_sm == 1}class="thisOpen"{/if} style="cursor:pointer;"><a href="{$item.link}" title="{$item.varName}" {if $item.varColor}style="color:#{$item.varColor}"{/if}>{$item.varTitle}</a></p>
					<div {if $item.link == $REQUEST_URI || $item.isAllwaysOpen == 1 || $open_for_sm == 1}style="display:block"{/if} class="sm_c">
						{foreach from=$catalog_menu[$item.intMenuID] item=item2}
							<a href="{$item2.link}" title="{$item2.varName}" {if $item2.link == $REQUEST_URI}class="act"{/if} {if $item2.varColor}style="color:#{$item2.varColor}"{/if}>{$item2.varTitle}</a><br>
						{/foreach}
					</div>
					{/foreach}
               </div>
           </div>
           {/if}
           {if $info_country_block}
           <div class="box country commonInfo has2level">
                <div class="bg">
                    <h2 class="no0 open">Информация о стране<span></span></h2>
                    <div class="innerContent open">	
                    	{foreach from=$category_info item=cat}
                    		{assign var='open_for_sm' value=0}
							{foreach from=$info_country_block[$cat.intCategoryID] item=item2}{if $item2.link == $REQUEST_URI}{assign var='open_for_sm' value=1}{/if}{/foreach}
                    		<p {if $cat.isAllwaysOpen == 1 || $open_for_sm == 1}class="thisOpen"{/if} style="cursor:pointer;">{$cat.varName}</p>	
                    		<div {if $cat.isAllwaysOpen == 1 || $open_for_sm == 1}style="display:block"{/if}>
	                        {foreach from=$info_country_block[$cat.intCategoryID] item=item}
	                        	<a href="{$item.link}" title="{$item.varName}" {if $item.varColor}style="color:#{$item.varColor}"{/if}>{$item.varName}</a><br>
	                        {/foreach}
	                        </div>
	                    {/foreach}
                    </div>
                </div>
                <div class="bg2"></div>
           </div>
           {/if}
           {if $menu_block}
           <div class="box country blueBox has2level">
                <div class="bg">
                    <h2 class="no0 open">{$title_menu_block}<span></span></h2>
                    <div class="innerContent open">
                        {foreach from=$menu_block item=item}
                        <p {if $item.intResortID == $curResortID || $item.isAllwaysOpen == 1}class="thisOpen"{/if} style="cursor:pointer;"><span class="pic"></span>
                        	<a href="{$item.link}" title="{$item.varName}" {if $item.varColor}style="color:#{$item.varColor}"{/if}>{$item.varName}</a></p>
                        	<div {if $item.intResortID == $curResortID || $item.isAllwaysOpen == 1}style="display:block"{/if}>
								{foreach from=$region_data[$item.intResortID] item=item2}
									<a href="{$item2.link}" title="{$item2.varName}" {if $item2.intRegionID == $curRegionID}class="act"{/if} {if $item2.varColor}style="color:#{$item2.varColor}"{/if}>{$item2.varName}</a><br>
								{/foreach}
							</div>
                        {/foreach}
                    </div>
                </div>
                <div class="bg2"></div>
           </div>
		   {/if}
		   
           	
           	{if $menu_hotel_block}
            <div class="box country hotels">
                <div class="bg">
                    <h2 class="no0 open">{$title_hotel_block}<span></span></h2>
                    <div class="innerContent open">
                        {foreach from=$menu_hotel_block item=item}
                        <p><span class="starTop">{$item.intCountStars}</span><a href="{$item.link}" title="{$item.varName|escape}" {if $item.varColor}style="color:#{$item.varColor}"{/if}>{$item.varName}</a></p>
                        {/foreach}
                    </div>
                </div>
                <div class="bg2"></div>
           	</div>
           	{/if}
           	{if $promoaccii_hotel_page}
            <div class="box country commonInfo">
                <div class="bg">
                    <!--<h2 class="no0 open"><span>Промоакции</span></h2>-->
                    <div class="innerContent open">
                        {foreach from=$promoaccii_hotel_page item=item name=akcii}
                        <a href="{$item.link}" title="{$item.varName}" class="akcent">{$item.varName}</a>
                        	{if !$smarty.foreach.akcii.last}<div class="bordered_bottom_fir_lev">{else}<div>{/if}		
                        	{foreach from=$promo_hotel_list_hotel_page[$item.intPromoID] item=item_1 name=hotel}
                        		{if !$smarty.foreach.hotel.last}<div class="bordered_bottom_sec_lev">{else}<div>{/if}		
	                        	<p>{if $item_1.varLink}<a href="{$item_1.varLink}">{/if}<span class="hotelpromoname">{$item_1.varNameHotel}</span>{if $item_1.varLink}</a>{/if}</p>
                        		{foreach from=$promo_hotel_details_list_hotel_page[$item_1.intHotelPromoID] item=item_2 name=details}
                        			{if !$smarty.foreach.details.last}<div class="bordered_bottom">{else}<div>{/if}	
	                        			<p><span class="colored">{$item_2.varUsloviya}</span></p>
	                        			<p><span class="dates">{$item_2.varDateFrom} - {$item_2.varDateTo}</span></p>
	                        		</div>
                        		{/foreach}	
                        		</div>
	                        {/foreach}
	                        </div>
                        {/foreach}
                    </div>
                </div>
                <div class="bg2"></div>
            </div>
           	{/if}
           	
           
		    {foreach from=$bannersRight item=item}
		    <div class="baner_right">
		   		{include file='bans_img_flash.tpl' url=$item.varLink path=$FILES_URL w=$item.w h=$item.h name=$item.varBannerName}
		    </div>
		    {/foreach}
		    {if $static_zone.right_bottom_zone}
				{include file="static_zone.tpl" zone=$static_zone.right_bottom_zone static_zone_path=$static_zone_path template=bottom_menu}
			{/if}
