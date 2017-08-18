			{include file="banners.tpl"}
	        <div class="innerPage">
	        	{include file="layout/bread_crumbs.tpl"}
                <br>
                <div class="Title">
			        <h1>{$data.varName}</h1>
			    </div>	
				<br>
				<div style="color: black; font-size: 1.2em; font-weight: normal; line-height: 1.4em; overflow: hidden;">{$data.varContent}</div>
				<div>
                    <table width="100%" style="text-align: center;">
                    	<tr>
                    		<td width="33%">{if $prew}<p><a href="{$prew.link}" >&lt; Предыдущая</a></p>{/if}</td>
                    		<td width="33%">{if $all_cou}<p><a href="{$all_cou.link}" >Все достопримечательности страны</a></p>{/if}</td>
                    		<td width="33%">{if $next}<p><a href="{$next.link}" >Следующая &gt;</a></p>{/if}</td>
                    	</tr>
                    </table>
                </div>
                <div class="clear"></div>
                {include file="galleries.tpl"}
	
				{include file="comments.tpl"}
				
				{include file="contests.tpl"}
            </div>