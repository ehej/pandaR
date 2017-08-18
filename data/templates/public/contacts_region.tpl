			{include file="banners.tpl"}
            <div class="innerPage contact">
                {include file="layout/bread_crumbs.tpl"}
                <h1 class="title">Выберите город</h1>
                <div class="region rounded">
                    <div class="tl"></div>
                    <div class="tr"></div>
                    <div class="bl"></div>
                    <div class="br"></div>
                    <div class="info">
                    	{foreach from=$contacts_office item=item name=conts}
                    		<div class="item {if $smarty.foreach.conts.iteration == 1}active{/if}">
	                            <h2><span>{$item.varName}</span></h2>
	                            <div class="text">
	                                 <table>
	                                    <tr><td colspan="2" class="big">{$item.varInfo}</td></tr>
	                                    
	                                    {if $contact_contacts_group[$item.intContactID]}
						                     <tr>
	                						{foreach from=$contact_contacts_group[$item.intContactID] item=its name=its}
	                							{if $smarty.foreach.its.iteration % 2 != 0 && $smarty.foreach.its.iteration != 1}</tr><tr>{/if}
							                    <td style="padding: 0;" width="50%"><p><span>{if $its.varStaffType == 'email'}E-mail: {/if}
							                        {if $its.varStaffType == 'phone'}Тел: {/if}
							                        {if $its.varStaffType == 'mobile'}Моб: {/if}
							                        {if $its.varStaffType == 'icq'}ICQ: {/if}
							                        {if $its.varStaffType == 'skype'}skype: {/if}</span>
							                        {$its.varText}</p>
							                    </td>
							                {/foreach}
	                						</tr>  
						                {/if}
	                                     <tr>
	                                         <td colspan="2" align="center">
	                                             <br>
	                                             	{if $item.varFoto}
									                <div id="map_{$item.intContactID}" style="display: none;"><img src="{$FOTO_CONTACTS_URL}{$item.varFoto}" alt=""></div>
									                <a class="button" href="javascript:void(0);" onclick="$('#map_{$item.intContactID}').slideToggle();"><span>Карта проезда</span></a>&nbsp;&nbsp;&nbsp;
									                {/if}

	                                         </td>
	                                     </tr>
	                                </table>
	                                
	                            </div>
	                        </div>
						{/foreach}
                   
                    </div>
                </div>
                {include file="galleries.tpl"}
	
				{include file="comments.tpl"}
				
				{include file="contests.tpl"}
            </div><!--//contact-->