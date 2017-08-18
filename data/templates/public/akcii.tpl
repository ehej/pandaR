			{include file="banners.tpl"}
            <div class="innerPage">
            	{include file="layout/bread_crumbs.tpl"}
                <div class="Title">
                    <h1>Акции</h1>
                </div>
                    

                {foreach from=$akcii item=item key=key}
					{if is_integer($key)}
					<div class="item">
						<div class="box expanded-box">
							<h2>
								<h2><a href="{$item.link}">{$item.varTitle}</a></h2>
								<div class="clear"></div>
							</h2>
							<div>
								<div class="item">
									<p class="date">{$item.varDate|date_format:"%d.%m.%Y"}</p>
									<p>{$item.varAnnotation}</p>
									<p class="readmore"><a href="{$item.link}">Подробнее</a></span></p>
									<br><br>
								</div>
							</div>
						</div>
					</div>
					{/if}
				{/foreach}
                {include file="galleries.tpl"}
	
				{include file="comments.tpl"}
				
				{include file="contests.tpl"}
                
                <div>
                    <p>&nbsp;</p>
                    <p><a href="#" class="scrollTop">Наверх</a></p>
                </div>

                <div class="clear"></div>
			</div>
