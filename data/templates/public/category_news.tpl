			{include file="banners.tpl"}
	        <div class="innerPage">
	        	{include file="layout/bread_crumbs.tpl"}
				<form action="{$category_now.link}/" method="get" name="newsArchiveForm" id="newsArchiveForm">
		            <div class="Title">
				        <h1>{$category_now.varName}</h1>
				    </div>	
		            <div style="text-align: center;">
						{foreach from=$dataType item=item key=key name=names}
							{if is_integer($key)}
								{if $smarty.foreach.names.iteration != 1} | {/if}<a href="{$item.link}" {if $category_now.intNewsTypeID == $item.intNewsTypeID}class="act"{/if}>{$item.varNameType}</a>
							{/if}
						{/foreach}
					</div>
					<br>
					<div>
						<table class="table_hotel" cellpadding="0" cellspacing="0">
							<tr>
								<th colspan="2">
						            <table cellpadding="0" cellspacing="0" style="border-collapse: collapse; border: none; width: 100%;">
										<tr>
											<td style="padding: 10px; color: #0a5095; font-size: 14px; vertical-align: middle;">Дата с </td>
											<td style="padding: 10px;"><input type="text" name="varDateFrom" id="varDateFrom" class="datepicker" value="{$sfilter.FROMvarDate|date_format:'%d.%m.%Y'}" title="Дата с" /></td>
											<td style="padding: 10px; color: #0a5095; font-size: 14px; vertical-align: middle;">по </td>
											<td style="padding: 10px;"><input type="text" name="varDateTo" id="varDateTo"  class="datepicker" value="{$sfilter.TOvarDate|date_format:'%d.%m.%Y'}" title="Дата по" /></td>
											<td style="padding: 10px;"><input type="submit" value="Показать" name="sbutton" /></td>
										</tr>
									</table>
								</th>
							</tr>
							{foreach from=$data item=item key=key}
								{if is_integer($key)}
								<tr>
									<td style="text-align: left;">
										<div style="display: inline;" class="currencyValue">{$item.varTitle}</div>
										<div style="font-style: italic; padding: 5px 0px; padding-top: 15px;">{$item.varAnnotation}</div>
										<div style="font-weight: bold; padding: 5px 0px;">
											<a href="{$item.link}" style="text-decoration: none; color: #0a5095;">Подробнее...</a>
										</div>
									</td>
									<td>{$item.varDate|date_format:"%d.%m.%Y"}</td>
								</tr>
								{/if}
							{/foreach}
							<tr>
								<td colspan="2">{include file="scroller_for_public.tpl" pager=$data.pager script=1}</td> 
							</tr>
						</table>
						
		                <p>&nbsp;</p>
		                <p><a href="#" class="scrollTop">Наверх</a></p>
		            </div>

		            <div class="clear"></div>
				</form>
				{include file="galleries.tpl"}
		
				{include file="comments.tpl"}
				
				{include file="contests.tpl"}
		</div>