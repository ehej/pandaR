{if $curCountryID && $curCountryID>0}
<table width="100%" class="country-menu"><tr>
	{foreach from=$menuCountries item=item}
	{if $item.intCountryID==$curCountryID}
		<td class="{if $REQUEST_URI=='/countries/'|cat:$curCountry.varUrlAlias}current{/if}">
			<a href="/countries/{$curCountry.varUrlAlias}"><span>О стране</span></a>
			{if $REQUEST_URI=="/countries/"|cat:$curCountry.varUrlAlias}<span class="arrow"></span>{/if}
		</td>
		{foreach from=$item.chield item=it}
			<td class="{if $REQUEST_URI==$it.link || $ModuleMenu==$it.varModule}current{/if}">
				<a href="{$it.link}"><span>{$it.varTitle}</span></a>
				{if $REQUEST_URI==$it.link || $ModuleMenu==$it.varModule}<span class="arrow"></span>{/if}
			</td>
		{/foreach}
	{/if}
	{/foreach}
</tr></table>
{/if}