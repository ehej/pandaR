{if $galleries}
<div class="galleries">
	{foreach from=$galleries item=item}
		{if count($gallsImages[$item.intGalleryID])>0}
			<div class="clear"></div>
			<div><h2>{$item.varTitle}</h2></div>
			<div class="clear"></div>
			{foreach from=$gallsImages[$item.intGalleryID] item=it name=image}
				<div style="float: left;width: 221px;">
					<div style=" margin: 10px 2px; width: 217px; height: 170px; background-image: url({$it.imageUrl}); background-repeat: no-repeat; background-position: center center;">
						<a class="lightbox" rel="lytebox[gallery]" id="lb_href_{$it.intImageID}" title="{$it.varTitle}" href="/_watermark.php?img={$it.imageOrigUrl}" style="width: 217px; height: 170px; display: block;" onclick="javascript:$.noop();">&nbsp;</a>
					</div>
					<a href="javascript:void(0);" onclick="$('#lb_href_{$it.intImageID}').click();">{$it.varTitle}</a>
				</div>
				{if $smarty.foreach.image.iteration % 8 == 0}<div class="clear"></div>{/if}
			{/foreach}
		{/if}
	{/foreach}
</div>
{/if}
