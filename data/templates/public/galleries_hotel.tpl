{if $galleries}
	{foreach from=$galleries item=item}
		{foreach from=$gallsImages[$item.intGalleryID] item=it name=image}
				<a href="javascript:void(0);" onclick="$('#lb_href_{$it.intImageID}').click();">{$it.varTitle}</a>
				<div style="float: left; margin: 5px; width: 200px; height: 145px; background-image: url({$it.imageUrl}); background-repeat: no-repeat; background-position: center center;">
					<a class="lightbox" rel="lytebox[gallery]" id="lb_href_{$it.intImageID}" title="{$it.varTitle}" href="/_watermark.php?img={$it.imageOrigUrl}" style="width: 200px; height: 145px; display: block;" onclick="javascript:$.noop();">&nbsp;</a>
				</div>
		{/foreach}
	{/foreach}
	<br>
    <a href="{$gallery_link}" title="" class="button"><span>Все фото отеля</span></a>
{/if}