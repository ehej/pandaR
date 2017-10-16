			{include file="banners.tpl"}
	        <div class="innerPage">
	        	{include file="layout/bread_crumbs.tpl"}
	        	<div class="Title">
					<h1>{$data.varName}</h1>
				</div>
                <div>
                	{if isset($resort_list)}
						<div><b>Экскурсия доступна на таких курортах:</b>
						{foreach from=$resort_list item=it name=fors}
							{if $smarty.foreach.fors.iteration != 1}, {/if}
							{$it.varName}
						{/foreach}
						<br><br>
						</div>
					{/if}
                
                    {$data.varDescription}
                    <div>
                    	<table width="100%" style="text-align: center;">
                    		<tr>
                    			<td width="33%">{if $prew}<p><a href="{$prew.link}" >&lt; Предыдущая</a></p>{/if}</td>
                    			<td width="33%">{if $all_cou}<p><a href="{$all_cou.link}" >Все экскурсии страны</a></p>{/if}</td>
                    			<td width="33%">{if $next}<p><a href="{$next.link}" >Следующая &gt;</a></p>{/if}</td>
                    		</tr>
                    	</table>
                    </div>
                    <p><a href="#" class="scrollTop">Наверх</a></p>
                </div>

                <div class="clear"></div>
				{include file="galleries.tpl"}
	
				{include file="comments.tpl"}
				
				{include file="contests.tpl"}

            </div>

