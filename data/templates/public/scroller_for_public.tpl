{if $pager}{if $script}<div class="pager"><input type="hidden" name="{$prefix}page" id="{$prefix}page" value="{$pager.current_page}" />
	{if $pager.current_page>1}<a href="javascript:loadPage({$pager.current_page-1},'{$prefix}')" style="color: #0a5095; font-size: 14px; text-decoration: none;" title="Назад">←</a>&nbsp;{/if}
	{foreach from=$pager.page item=page}
	<a href="javascript:loadPage({$page},'{$prefix}')" style="color: #0a5095; font-size: 14px; text-decoration: none;{if $pager.current_page==$page} font-weight: bold; text-decoration: underline; font-size: 16px;{/if}">{$page}</a>&nbsp;
	{/foreach}
	{if $pager.current_page<$pager.last_page}<a href="javascript:loadPage({$pager.current_page+1},'{$prefix}')" style="color: #0a5095; font-size: 14px; text-decoration: none;" title="Вперед">→</a>&nbsp;{/if}</div>
{else}<div class="pager">
	{if $pager.current_page>1}<a href="?{$prefix}p={$pager.current_page-1}{$query|default:''}" style="color: #0a5095; font-size: 14px; text-decoration: none;" title="Назад">←</a>&nbsp;{/if}
	{foreach from=$pager.page item=page}
	<a href="?{$prefix}p={$page}{$query|default:''}" style="color: #0a5095; font-size: 14px; text-decoration: none;{if $pager.current_page==$page} font-weight: bold; text-decoration: underline; font-size: 16px;{/if}">{$page}</a>&nbsp;
	{/foreach}
	{if $pager.current_page<$pager.last_page}<a href="?{$prefix}p={$pager.current_page+1}{$query|default:''}" style="color: #0a5095; font-size: 14px; text-decoration: none;" title="Вперед">→</a>&nbsp;{/if}</div>
{/if}{/if}