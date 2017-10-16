{include file="banners.tpl"}
<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	<div class="Title">
		<h1>{$data.varTitle}</h1>
		<sup>{$data.varDate|date_format:"%d.%m.%Y"}</sup>
	</div>
	<style type="text/css">
	{literal}
		.ppp_auto p{
			padding: 0;
		}
	{/literal}
	</style>
	<div style="padding: 15px; color: black;" class="ppp_auto">{$data.varDescription}</div>
	
	{include file="galleries.tpl"}
	
	{include file="comments.tpl"}
	
	{include file="contests.tpl"}
</div>