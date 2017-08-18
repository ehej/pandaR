{foreach from=$menuCountries item=item name=menu}
	{if $item.intParentID==0}
		<div class="item {if $item.isCharter==1}expanded{/if}  {if $item.intSortOrder % 2 == 0}first{else}second{/if} block ">
			<h2 style="font-size: 26px;">
				<a href="/countries.php?intCountryID={$item.intCountryID}" style="text-decoration: none; color: #0A5095;">
				{foreach from=$countries item=i name=abz}
					{if $i.intCountryID==$item.intCountryID}
						{if $i.varFlag!=''}<img alt="{$i.varName}" src="{$FILES_URL}{$i.varFlag}" width="18" height="13">{/if}&nbsp;{$i.varName}
					{/if}
				{/foreach}
				</a><span class="tmp" style="width: 13px; margin-left: 0px;">&nbsp;&nbsp;</span>
			</h2>
				<div class="box expanded-box">
					<div class="descriptions" style="padding: 10px; padding-left: 0px;">
						{if $item.submenu}
						{foreach from=$item.submenu item=it name=submenu}
							<span style="white-space: nowrap;float: left;">
							{if $it.varModule=='page'}
								<a href="/pages.php?intPageID={$it.varIdentifier}" style=" color: {if $it.varColor!=''}#{$it.varColor}{else}gray{/if};" >
							{elseif $it.varModule=='news'}
								<a href="/news.php?intNewsID={$it.varIdentifier}" style=" color: {if $it.varColor!=''}#{$it.varColor}{else}gray{/if};" >
							{elseif $it.varModule=='regions'}
								<a href="/regions.php?intCountryID={$it.intCountryID}" style=" color: {if $it.varColor!=''}#{$it.varColor}{else}gray{/if};" >
							{elseif $it.varModule=='hotels'}
								<a href="/hotels.php?intCountryID={$it.intCountryID}" style=" color: {if $it.varColor!=''}#{$it.varColor}{else}gray{/if};" >
							{elseif $it.varModule=='about_country'}
								<a href="/about_country.php?intCountryID={$it.intCountryID}" style=" color: {if $it.varColor!=''}#{$it.varColor}{else}gray{/if};" >
							{elseif $it.varModule=='so'}
								<a href="/so.php?intCountryID={$it.intCountryID}" style=" color: {if $it.varColor!=''}#{$it.varColor}{else}gray{/if};" >			
							{elseif $it.varModule=='resort'}
								<a href="/resorts.php?intCountryID={$it.intCountryID}" style=" color: {if $it.varColor!=''}#{$it.varColor}{else}gray{/if};">
							{elseif $it.varModule=='adv_country'}
								<a href="/adv_country.php?intCountryID={$it.intCountryID}" style=" color: {if $it.varColor!=''}#{$it.varColor}{else}gray{/if};">
							{elseif $it.varModule=='subscribes'}
								<a href="/subscribes.php" style=" color: {if $it.varColor!=''}#{$it.varColor}{else}gray{/if};">
							{elseif $it.varModule=='unsubscribes'}
								<a href="/unsubscribes.php" style=" color: {if $it.varColor!=''}#{$it.varColor}{else}gray{/if};">
							{else}
								<a href="/{$it.varUrl}" style=" color: {if $it.varColor!=''}#{$it.varColor}{else}gray{/if};" >
							{/if}
							{$it.varTitle}
								</a>
							{$smarty.foreach.sub.total}
							{if !$smarty.foreach.submenu.last} | {/if}	
							</span>
						{/foreach}
						{/if}
					</div>
				</div>
		</div>	
	{/if}
{/foreach}