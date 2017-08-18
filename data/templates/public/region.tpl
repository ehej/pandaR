			{include file="banners.tpl"}
            <div class="innerPage">
            	{include file="layout/bread_crumbs.tpl"}
					<h1>{$curCountry.varName}</h1>
                <div class="Title">
					<h1>{$data.varName}</h1>
				</div>

				{include file="layout/country_navigation.tpl"}
				<div class="plashka">
					<div class="s1"><div class="s2"><div class="s3">
					{foreach from=$region item=region_item}
						<span><a {if $REQUEST_URI=="/regions/"|cat:$region_item.varUrlAlias}class="cur"{/if} href="{$region_item.link}">{$region_item.varName}</a></span>
					{/foreach}
					</div></div></div>
				</div>
                <div>
				{include file="layout/gallery.tpl"}
                    {$data.varDescription}
                    <p>&nbsp;</p>
                </div>
                
                <div>
                    <p>&nbsp;</p>
                    <p><a href="#" class="scrollTop">Наверх</a></p>
                </div>

                <div class="clear"></div>

            </div>
            

			{include file="galleries.tpl"}
			
			{include file="comments.tpl"}
			
			{include file="contests.tpl"}
