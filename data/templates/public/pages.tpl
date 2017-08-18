			{include file="banners.tpl"}
            <div class="innerPage">
            	{include file="layout/bread_crumbs.tpl"}
            	<div class="Title">
					<h1>{if $data.varTitle=="Таиланд"}
							Тайланд
						{else}
							{$data.varTitle}
						{/if}</h1>
				</div>
				{if $data.varAnnotation}
                <div>
                    <h2>{$data.varAnnotation}</h2>
                </div>
                {/if}
                
		{if $gallsImages}
			<center>{include file="layout/gallery.tpl"}</center>
		{/if}
                <div>
                    {$data.varDescription}
                    <p>&nbsp;</p>
                    <p><a href="#" class="scrollTop">Наверх</a></p>
                </div>
				
				{include file="seminary.tpl"}

                <div class="clear"></div>
	
				{include file="comments.tpl"}
				
				{include file="contests.tpl"}
			</div>