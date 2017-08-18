			{include file="banners.tpl"}
	        <div class="innerPage">
	        	{include file="layout/bread_crumbs.tpl"}
				{include file="layout/country_navigation.tpl"}
                <br>
                    <h1>Экскурсии</h1>
                {if $excursion_list}
					{if $country}
						<div class="filter tour rounded">
	                    <div class="tl"></div>
	                    <div class="tr"></div>
	                    <div class="bl"></div>
	                    <div class="br"></div>
	                    <div class="info">
	                        <table>
	                            <thead>
	                                <tr>
	                                    <th><input type="text" name="qs" id="qs" class="inText" value="Название экскурсии" onfocus="focused(this,'Название экскурсии')" onblur="blured(this,'Название экскурсии')"></th>
	                                    <th>
	                                        <select name="qss" id="qss" class="inText">
                                        		<option></option>
                                        		{foreach from=$resort_list item=it name=fors}
													<option>{$it.varName}</option>
												{/foreach}
	                                        </select>
	                                    </th>
	                                </tr>
	                            </thead>
	                            <tbody id="allTours">
                            		{foreach from=$excursion_list item=item key=key name=names}
										{if is_integer($key)}
											<tr>
												<td class="first"><a href="{$item.link}" title="">{$item.varName}</a></td>
										 		<td>
													{if isset($relation_list_excursion[$item.intExcursionID].resort)}
														{foreach from=$relation_list_excursion[$item.intExcursionID].resort item=it name=fors}
															{if $smarty.foreach.fors.iteration != 1},  {/if}
															{$resort_list[$it.intDestinationID].varName}
														{/foreach}
														<br>
													{/if}
												</td>
											</tr>
										{/if}
									{/foreach}
	                            </tbody>
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
                         		{foreach from=$excursion_list item=item key=key name=names}
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
	                         <h2>Экскурсий не найдено</h2><br>
	                    </div>
	                </div>
				{/if}
                <div class="clear"></div>
                {include file="galleries.tpl"}
	
				{include file="comments.tpl"}
				
				{include file="contests.tpl"}
            </div>
            
            	
            
            
            
       