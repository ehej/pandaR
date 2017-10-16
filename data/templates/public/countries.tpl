<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	{include file="layout/country_navigation.tpl"}
    {foreach from=$data item=item}  	
		<div class="country-img">
			<a href="{$item.link}"><img class="no5" src='{$FILES_URL}{$item.varFlag}' style="width:150px"></span>
			<br>
			<h2>{$item.varName}</h2></a>
		</div>
	   {/foreach}
	
	{include file="comments.tpl"}
	{include file="contests.tpl"}
    <div class="clear"></div>
</div>