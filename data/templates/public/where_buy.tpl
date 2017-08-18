                {include file="banners.tpl"}
	            <div class="innerPage">
					{include file="layout/bread_crumbs.tpl"}
					<div class="Title">
						<h1>Где купить</h1>
					</div>
					<div>
						<form action="/gde-kupit-tour" method="get" name="whereBuyForm" id="whereBuyForm">
						<table cellpadding="0" cellspacing="0" >
							<tr>
								{*<th style="padding:30px 20px 10px 0; color: #0a5095; font-size: 14px; vertical-align: middle;">Направление <br>
									<select name="intCountryID" id="intCountryID" onchange="$('#whereBuyForm').submit();">
										<option value="">все</option>
									{foreach from=$countries item=item}
										<option value="{$item.intCountryID}"{if $intCountryID==$item.intCountryID} selected="selected"{/if}>{$item.varName}</option>
									{/foreach}
									</select>
								</th>*}
								<th style="padding:30px 20px 10px 0; color: #0a5095; font-size: 14px; vertical-align: middle;" nowrap="nowrap"> Область<br>
									<select name="intAreaID" id="intAreaID" onchange="$('#intCityID option').removeAttr('selected');$('#whereBuyForm').submit();">
										<option value="">Выберите область</option>
									{foreach from=$area_list item=item}
										<option value="{$item.intAreaID}"{if $intAreaID==$item.intAreaID} selected="selected"{/if}>{$item.varName}</option>
									{/foreach}
									</select>
								</th>
								<th style="padding:30px 20px 10px 0; color: #0a5095; font-size: 14px; vertical-align: middle;" nowrap="nowrap"> Город<br>
									<select name="intCityID" id="intCityID" onchange="$('#whereBuyForm').submit();">
										<option value="">Выберите город</option>
									{foreach from=$city_list item=item}
										{if $intAreaID==$item.intAreaID && $intAreaID != ''}<option value="{$item.intCityID}" {if $intCityID==$item.intCityID} selected="selected"{/if}>{$item.varName}</option>{/if}
									{/foreach}
									</select>
								</th>
							</tr>
						</table>

						
						{if $data}
						<table class="table_hotel" cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
									<th>Название агентства</th>
									<th>Адрес</th>
									<th>Контактный телефон</th>
								</tr>
								{foreach from=$data item=item key=key}
								{if is_integer($key)}
								<tr>
									<td>{$item.varName}</td>
									<td>{$item.varDetail}</td>
									<td>{$item.varPhone}</td>
								</tr>				
								{/if}					
								{/foreach}
							{if $data.pager}
							<tr>
								<td colspan="3">{include file="scroller_for_public.tpl" pager=$data.pager script=1}</td> 
							</tr>
							{/if}
							</tbody>
						</table>
						{else}
						<div style="width: 100%; text-align: center; font-size: 12px;">По Вашему запросу ничего не найдено, либо не заданы параметры поиска</div>
						{/if}
						</form>
					    
					    	{include file="galleries.tpl"}
	
							{include file="comments.tpl"}
							
							{include file="contests.tpl"}
					    
	                    <p>&nbsp;</p>
	                    <p><a href="#" class="scrollTop">Наверх</a></p>
	                </div>

	                <div class="clear"></div>

	            </div>

