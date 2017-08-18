<ul style="list-style-type: none; padding: 0px;">
{foreach from=$wtus_list item=item name=wtus}
	<li style="padding-bottom: 15px;">
		<a href="/pages.php?intPageID={$item.varIdentifier}&intMenuID={$item.intMenuID}" title="{$item.varTitle}" style="color: #2A4D72; font-size: 14px;">{$item.varTitle}</a>
	{if $item.childs}
		<ul style="list-style-type: none; padding: 5px 0px 5px 20px; font-size: 11px;">
		{foreach from=$item.childs item=item}
			<li style="line-height: 25px;">
				<a href="/pages.php?intPageID={$item.varIdentifier}&intMenuID={$item.intMenuID}" style="font-weight: bold; color: #2A4D72; font-size: 12px; text-decoration: none;" title="{$item.varTitle}">{$item.varTitle}</a>
			</li>
		{/foreach}
		</ul>		
	{/if}			
	</li>
{/foreach}
</ul>