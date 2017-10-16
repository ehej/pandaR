{if $breadCrumbs}
	<div class="breadscrumb">
		{foreach from=$breadCrumbs item=item name=breadCrumbs}
		{if $item.thisPage}
			<span>{$item.title|truncate:35}</span>
		{else}
        	<a href="{$item.url}">{$item.title|truncate:35}</a>
        {/if}
		{if $smarty.foreach.breadCrumbs.last==false}   &nbsp;&rarr;&nbsp;  {/if}
        {/foreach}
    </div>
{/if}