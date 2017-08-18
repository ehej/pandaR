<div class="menu">
	<table width="100%"><tr>
		{foreach from=$menuArr item=item key=key name=menu}
		<td {if $REQUEST_URI==$item.link}class="activemenu"{/if}><a href="{if $item.varModule=='tourtypes'}{$item.varUrl}{else}{$item.link}{/if}"><span>{if $item.varImage}<img src="{$FILES_URL}{$item.varImage}" title="{$item.varTitle}" alt="{$item.varTitle}"/>{else}{$item.varTitle}{/if}</span></a>
		{if $item.varModule=='tourtypes'}
			<ul>
			{foreach from=$tourtypes item=item2}
				<li><a href="/tours-country/tourtype/{$item2.intTypeID}">{$item2.varName}</a></li>
			{/foreach}
			</ul>
		{elseif !empty($item.chield)}
			<ul>
			{foreach from=$item.chield item=item2}
				<li><a href="{$item2.link}">{$item2.varTitle}</a></li>
			{/foreach}
			</ul>
		{/if}
		</td>
		{/foreach}
	</tr></table>
	<span class="menu-lc"></span>
	<span class="menu-rc"></span>
</div>