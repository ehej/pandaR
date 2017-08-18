			{include file="banners.tpl"}
	        <div class="innerPage">
	        	{include file="layout/bread_crumbs.tpl"}
				<form action="/news/" method="get" name="newsArchiveForm" id="newsArchiveForm">
					<div class="Title">
						<h1>Новости</h1>
					</div>
					<br>
					<div>
						<table width="100%" class="table_hotel" cellpadding="0" cellspacing="0">
							{foreach from=$data item=item key=key}
								{if is_integer($key)}
								<tr>
									<td style="text-align: left;">
											<h2 class="title">
												<span style="font-weight: bold;">{$item.varTitle}</span>
											</h2>
										<div style="font-style: italic; ">{$item.varAnnotation}</div>
										<div style="font-weight: bold; padding: 5px 0px;">
											<a href="{$item.link}" style="text-decoration: none; color: #0a5095;font-weight: bold;">Подробнее...</a>
										</div>
										<br clear="all" />
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