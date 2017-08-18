{include file="banners.tpl"}
<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	<div class="Title">
		<h1>{$curCountry.varName}</h1>
	</div>
	{include file="layout/country_navigation.tpl"}	
	<table width="100%" style="min-width: 800px;">
	<tr>
		{if $gallsImages}
		<td>
			<center>{include file="layout/gallery.tpl"}</center>
			</td>
		<tr>
		</tr>
		{/if}
		<td>
		{if $data.varLogo}<div style="padding: 15px 0px;"><img src="{$FILES_URL}{$data.varLogo}" /></div>{/if}
		<h1>{$data.varName} <span class="hotelstars star{$data.varCountStars}"></span></h1>
		{$data.varDescription}
		</td>
	</tr>
	</table>

	<div class="clear"></div>

	{include file="comments.tpl"}
	{include file="contests.tpl"}
</div>
<div class="clear"></div>