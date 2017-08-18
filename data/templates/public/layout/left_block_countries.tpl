{if $curCountryID != ''}
	{foreach from=$menuCountries item=item name=menu}
		{if $item.intParentID==0 && $curCountryID==$item.intCountryID && $item.intCountryID}
			<div class="box country">
				<div class="bg">
					<h2 class="no0 open">
					{foreach from=$countries item=i}
						{if $i.intCountryID==$item.intCountryID}
							{if $i.varFlag}<img src="{$FILES_URL}{$i.varFlag}" width="25" height="17">&nbsp;{/if}<a class="countrititle" href="{$i.link}">{$i.varName}</a>
							{assign var="countrylink" value=$i.link}
						{/if}
					{/foreach}</h2>
					<div class="innerContent open">
						<span ><a href="{$countrylink}" title="" {if $it.varColor != ''}style="color:#{$it.varColor}"{/if}>О стране</a>&nbsp;{if $item.chield}|{/if}</span>
						{if !empty($item.chield)}
							{foreach from=$item.chield item=it name=child}
								<span ><a href="{$it.link}" title="" {if $it.varColor != ''}style="color:#{$it.varColor}"{/if}>{$it.varTitle}</a>&nbsp;{if !$smarty.foreach.child.last && !$smarty.foreach.child.first}|{/if}</span>
							{/foreach}
							
							<div class="clear"></div>
						{/if}
					</div>
				</div>
				<div class="bg2"></div>
			</div>
		{/if}
	{/foreach}
	{foreach from=$menuCountries item=item name=menu}
		{if $item.intParentID==0 && $curCountryID!=$item.intCountryID && $item.intCountryID}
			<div class="box country">
				<div class="bg">
					<h2 class="no0 ">
					{foreach from=$countries item=i}
						{if $i.intCountryID==$item.intCountryID}
							{if $i.varFlag}<img src="{$FILES_URL}{$i.varFlag}" width="25" height="17">&nbsp;{/if}<a class="countrititle" href="{$i.link}">{$i.varName}</a>
							{assign var="countrylink" value=$i.link}
						{/if}
					{/foreach}</h2>
					<div class="innerContent">
						<span ><a href="{$countrylink}" title="" {if $it.varColor != ''}style="color:#{$it.varColor}"{/if}>О стране</a>&nbsp;{if $item.chield}|{/if}</span>
						{if !empty($item.chield)}
							{foreach from=$item.chield item=it name=child}
								<span ><a href="{$it.link}" title="" {if $it.varColor != ''}style="color:#{$it.varColor}"{/if}>{$it.varTitle}</a>&nbsp;{if !$smarty.foreach.child.last && !$smarty.foreach.child.first}|{/if}</span>
							{/foreach}
							
							<div class="clear"></div>
						{/if}
					</div>
				</div>
				<div class="bg2"></div>
			</div>
		{/if}
	{/foreach}
{else}
	{foreach from=$menuCountries item=item name=menu}
		{if $item.intCountryID}
		<div class="box country">
			<div class="bg">
				<h2 class="no0 {if $item.intParentID==0 && $curCountryID==$item.intCountryID}{/if}">
				{foreach from=$countries item=i}
					{if $i.intCountryID==$item.intCountryID}
						{if $i.varFlag}<img src="{$FILES_URL}{$i.varFlag}" width="25" height="17">&nbsp;{/if}<a class="countrititle" href="{$i.link}">{$i.varName}</a>
						{assign var="countrylink" value=$i.link}
					{/if}
				{/foreach}</h2>
				<div class="innerContent">
					<span><a href="{$countrylink}" title="" {if $it.varColor != ''}style="color:#{$it.varColor}"{/if}>О стране</a>&nbsp;{if $item.chield}|{/if}</span>
					{if !empty($item.chield)}
						{foreach from=$item.chield item=it name=child}
							<span><a href="{$it.link}" title="" {if $it.varColor != ''}style="color:#{$it.varColor}"{/if}>{$it.varTitle}</a>&nbsp;{if !$smarty.foreach.child.last && !$smarty.foreach.child.first}|{/if}</span>
						{/foreach}
						<div class="clear"></div>
					{/if}
				</div>
			</div>
			<div class="bg2"></div>
		</div>
		{/if}
	{/foreach}
{/if}