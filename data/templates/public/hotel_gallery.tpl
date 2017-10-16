			{include file="banners.tpl"}
            <div class="innerPage">
            	{include file="layout/bread_crumbs.tpl"}
				{include file="layout/country_navigation.tpl"}
                <div class="Title"><h1>{$data.varName}</h1></div>
                    
                {if $galleries}
                <div class="galleries">
					{foreach from=$galleries item=item}
						{if count($gallsImages[$item.intGalleryID])>0}
							{foreach from=$gallsImages[$item.intGalleryID] item=it name=image}
							   <div style="float: left;width: 221px;">
									<div style=" margin: 10px 2px; width: 217px; height: 170px; background-image: url({$it.imageUrl}); background-repeat: no-repeat; background-position: center center;">
										<a class="lightbox" rel="lytebox[gallery]" id="lb_href_{$it.intImageID}" title="{$it.varTitle}" href="/_watermark.php?img={$it.imageOrigUrl}" style="width: 217px; height: 170px; display: block;" onclick="javascript:$.noop();">&nbsp;</a>
									</div>
									{*<a href="javascript:void(0);" onclick="$('#lb_href_{$it.intImageID}').click();">{$it.varTitle}</a>*}
								</div>
								{if $smarty.foreach.image.iteration % 3 == 0}<div class="clear"></div>{/if}
							{/foreach}
						{/if}
					{/foreach}
				</div>
				{/if}
				<div class="clear"></div>
				<p>&nbsp;</p>
				<p><a href="#" class="scrollTop">Наверх</a></p>
				<div class="clear"></div>
		</div>




	
	