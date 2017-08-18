		{include file="banners.tpl"}
        <div class="innerPage">
        	{include file="layout/bread_crumbs.tpl"}
            <table class="countryTitle">
                <tr>
                    <td valign="top"><h1 class="no5" style="background-image: url('{$FILES_URL}{$data.varImageFlag|substr:0:3}/{$data.varImageFlag}')">{$data.varName}{if $data.varH1Text} - {/if}</h1></td>
                    <td valign="top"><h2>{$data.varH1Text}</h2></td>
                </tr>
            </table>

            <div>
                {$data.varContent}
                <p>&nbsp;</p>
                <p><a href="#" class="scrollTop">Наверх</a></p>
            </div>

            <div class="clear"></div>
	
			{include file="galleries.tpl"}
			
			{include file="comments.tpl"}
			
			{include file="contests.tpl"}
			
		</div>
