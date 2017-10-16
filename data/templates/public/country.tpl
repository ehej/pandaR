<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	<h1>{$data.varName}</h1>
	{include file="layout/country_navigation.tpl"}
	<table class="countryTitle">
		<tr>
			<td valign="top"><h1 class="no5" style="background-image: url('{$FILES_URL}{$data.varFlag}')">
				{if $data.varName=="Таиланд"}
					Таиланд (Тайланд)
				{elseif $data.varName=="ОАЭ"}
					ОАЭ (Объединенные Арабские Эмираты)
				{else}
					{$data.varName}
				{/if}</h1>
			</td>
		</tr>
	</table>
	<table width="100%">
	<tr>
		{if $gallsImages}
		<td>
			<center>{include file="layout/gallery.tpl"}</center>
		</td>
	<tr>
	</tr>
		{/if}
		<td>
			{$data.varDescription}
		</td>
	</tr>
	</table>

	<div class="clear"></div>
</div>

{include file="comments.tpl"}
{include file="contests.tpl"}