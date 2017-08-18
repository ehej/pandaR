			{include file="banners.tpl"}
	        <div class="innerPage">
	        	{include file="layout/bread_crumbs.tpl"}
                <table class="countryTitle">
                    <tr>
                        <td valign="top"><h1 class="no5" style="background-image: url('{$FILES_URL}{$relation.varImageFlag|substr:0:3}/{$relation.varImageFlag}')">{$data.varName}</h1></td>
                        <td><h2></h2></td>
                    </tr>
                </table>

                <div>
                    {$data.varDescription}
                    <p>&nbsp;</p>
                    {include file="galleries.tpl"}
	
					{include file="comments.tpl"}
					
					{include file="contests.tpl"}
                    <p><a href="#" class="scrollTop">Наверх</a></p>
                </div>

                <div class="clear"></div>

            </div>