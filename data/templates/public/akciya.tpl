{include file="banners.tpl"}
<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	<div class="Title">
        <h1>{$data.varTitle}</h1>
    </div>
	<br>
	<div style="color: black; font-size: 1.2em; font-weight: normal; line-height: 1.4em; overflow: hidden;">{$data.varDescription}</div>
	{include file="galleries.tpl"}
	
	{include file="comments.tpl"}
	
	{include file="contests.tpl"}
</div>