{if $template == 'default'}
	{foreach from=$zone item=item key=key}
		<div class="static_zone_{$item.varPosition}" id="static_zone_{$item.intSZID}">
			{if $item.varText}
				<div class="sz_text">
					{if $item.varLink != ''}
						<a href="{$item.varLink}">{$item.varText}</a>
					{else}	
						{$item.varText}
					{/if}
				</div>
			{/if}
			{if $item.varImage}
				<div class="sz_image">
					{if $item.varLink != ''}
						<a href="{$item.varLink}"><img src="{$static_zone_path}{$item.varImage}"></a>
					{else}	
						<img src="{$static_zone_path}{$item.varImage}">
					{/if}
				</div>
			{/if}
		</div>
	{/foreach}
	<div class="clear"></div>
{/if}
{if $template == 'bottom_menu'}
	{foreach from=$zone item=item key=key}
		<div class="static_zone_{$item.varPosition}" id="static_zone_{$item.intSZID}">
			{$item.varText}
		</div>
	{/foreach}
{/if}
{if $template == 'footer'}
	{foreach from=$zone item=item key=key}
		<div class="static_zone_{$item.varPosition}" id="static_zone_{$item.intSZID}">
			{$item.varText}
		</div>
	{/foreach}
{/if}