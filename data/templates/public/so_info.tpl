{include file="banners.tpl"}
<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	{if $data}
	<div class="Title">
		<h1>{$data.varName}</h1>
	</div>
	<div style="padding: 15px; color: gray; font-size: 14px; font-style: italic;"> 
		Страна: {foreach from=$countries item=item}{if $item.intCountryID==$data.intCountryID}{$item.varName}{/if}{/foreach}<br />
		</div>
	<div style="color: black; font-size: 1.2em; font-weight: normal; line-height: 1.4em; overflow: hidden;">{$data.varInfoByLink}</div>
	{/if}
	
	{include file="galleries.tpl"}
	
	{include file="comments.tpl"}
	
	{include file="contests.tpl"}
</div>