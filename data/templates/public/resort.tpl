{include file="banners.tpl"}
<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	<h1>{$curCountry.varName}</h1>
	{include file="layout/country_navigation.tpl"}
	<div>
	<table width="100%" style="min-width: 800px;">
	<tr>
		<td>			
			{if $gallsImages}
			<center>{include file="layout/gallery.tpl"}</center>
			{/if}
			<h2 class="title">{$data.varName}</h2>
			{$data.varDescription}
		</td>
	</tr>
	</table>
	</div>

	<div class="clear"></div>

</div>
{include file="comments.tpl"}
{include file="contests.tpl"}