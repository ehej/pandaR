			{include file="banners.tpl"}
            <div class="innerPage">
            	{include file="layout/bread_crumbs.tpl"}
                <table class="countryTitle">
                    <tr>
                        <td valign="top"><h1 class="no5" style="background-image: url('{$FILES_URL}{$relation.varImageFlag|substr:0:3}/{$relation.varImageFlag}')">{$data.country.varName} - регионы</h1></td>
                    </tr>
                </table>

                <div>
					<h1>{$curCountry.varName}</h1>
				{include file="layout/country_navigation.tpl"}
				<div class="plashka">
					<div class="s1"><div class="s2"><div class="s3">
					{foreach from=$region item=resort_item}
						<span><a href="{$resort_item.link}">{$resort_item.varName}</a></span>
					{/foreach}
					</div></div></div>
				</div>
                    
                    
                    <p>&nbsp;</p>
                    <p><a href="#" class="scrollTop">Наверх</a></p>
                </div>

                <div class="clear"></div>

            </div>

			{include file="galleries.tpl"}
			
			{include file="comments.tpl"}
			
			{include file="contests.tpl"}

