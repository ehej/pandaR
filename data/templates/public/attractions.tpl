			{include file="banners.tpl"}
	        <div class="innerPage">
	        	{include file="layout/bread_crumbs.tpl"}
				{include file="layout/country_navigation.tpl"}
                <br>
                    <h1>Достопримечательности {$Nname}</h1>
                {if $data_list}
					{if $country}
						<div class="excurs rounded">
		                    <div class="tl"></div>
		                    <div class="tr"></div>
		                    <div class="bl"></div>
		                    <div class="br"></div>
		                    <div class="info">
		                        <table>
									<tr>
                            		{foreach from=$data_list item=item key=key name=names}
										{if is_integer($key)}
											{if $smarty.foreach.names.iteration % 2 != 0 && $smarty.foreach.names.iteration != 1}</tr><tr>{/if}
											<td><a href="{$item.link}" title="">{$item.varName}</a></td>
										{/if}
									{/foreach}
									</tr>
		                        </table>
		                    </div>
		                </div>
					{else}
		                <div class="excurs rounded">
		                    <div class="tl"></div>
		                    <div class="tr"></div>
		                    <div class="bl"></div>
		                    <div class="br"></div>
		                    <div class="info">
		                        <table>
									<tr>
                            		{foreach from=$data_list item=item key=key name=names}
										{if is_integer($key)}
											{if $smarty.foreach.names.iteration % 2 != 0 && $smarty.foreach.names.iteration != 1}</tr><tr>{/if}
											<td><a href="{$item.link}" title="">{$item.varName}</a></td>
										{/if}
									{/foreach}
									</tr>
		                        </table>
		                    </div>
		                </div>
					{/if}
				{else}
					<div class="excurs rounded">
		                <div class="tl"></div>
		                <div class="tr"></div>
		                <div class="bl"></div>
		                <div class="br"></div>
		                <div class="info">
		                    <h2>Достопримечательностей не найдено</h2><br>
		                </div>
		            </div>
				{/if}
                <div class="clear"></div>
	
				{include file="comments.tpl"}
				
				{include file="contests.tpl"}
            </div>
            
            	
            
            
            
       