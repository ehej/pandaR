<div class="innerPage contact">
	{include file="layout/bread_crumbs.tpl"}
	{foreach from=$contacts_office item=item}
		<table class="mainAdress">
			 <tr>
				<td class="big">
					<h2>{$item.varName} {if $item.varMain=='yes'}(главный оффис){/if}</h2>
					{$item.varInfo}
				</td>
			</tr>
		{if $contact_contacts_group[$item.intContactID]}
				<tr>
					<td style="padding: 0;" width="50%">
			{foreach from=$contact_contacts_group[$item.intContactID] item=its name=its}
					<span><span>
						{if $its.varStaffType == 'email'}E-mail: {/if}
						{if $its.varStaffType == 'phone'}Тел: {/if}
						{if $its.varStaffType == 'mobile'}Моб: {/if}
						{if $its.varStaffType == 'icq'}ICQ: {/if}
						{if $its.varStaffType == 'skype'}Skype: {/if}</span>
						{$its.varText}</span><br />
			{/foreach}<br />
					</td>
				</tr>
			{if $item.varTransport|strip_tags|trim != ''}
			<tr>
				<td>
					<strong>Как добраться общественным транспортом:</strong>
					{$item.varTransport}
				</td>
			</tr>
			{/if}
		</table> 
		{/if}
		{if $item.varFoto}
		<div id="map_{$item.intContactID}" style="display: none;">
			<img src="{$FOTO_CONTACTS_URL}{$item.varFoto}" alt=""  class="map">
		</div>
		<a class="button" href="javascript:void(0);" onclick="$('#map_{$item.intContactID}').slideToggle();">
		<span class="showmap">Карта проезда</span></a>&nbsp;&nbsp;&nbsp;
		{/if}<br><br>
	{/foreach}
	
	<div class="managers rounded" id="managers">
		<div class="info">
			{foreach from=$types item=it key=key name=type}
			<div class="item {*if $smarty.foreach.type.iteration == 1}active{/if*}">
				<h2><span>{$it.varNameType}</span><small></small></h2>
				<div class="text">
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
						{foreach from=$relations_type[$key] item=item name=staff}
							{if $staffs[$item].varView=='yes'}
						<td>

								<img src="{$path}{$staffs[$item].varFoto}" alt="" width="110">
								<div>
									<strong class="name">{$staffs[$item].varName}</strong>
									{if $staffs[$item].varPost}<span class="post">{$staffs[$item].varPost}</span>{/if}
									<span class="data">
									{if $staffs[$item].varInfo} {$staffs[$item].varInfo} {/if}
									{foreach from=$contact[$item] item=its}
										{if $its.varStaffType == 'email'}E-mail: {/if} 
											{if $its.varStaffType == 'phone'}Тел: {/if}
											{if $its.varStaffType == 'mobile'}Моб: {/if}
											{if $its.varStaffType == 'icq'}ICQ: {/if}
											{if $its.varStaffType == 'skype'}Skype: {/if}
											{$its.varText}<br>
									{/foreach}
									</span>
								</div>
								<div class="clear"></div>
								<br>
							
							</td>
							{/if}
						{/foreach}
						</tr>
					</table>
				</div>
			</div>
			{/foreach}
		</div>
	</div>
	{include file="galleries.tpl"}

	{include file="comments.tpl"}
	
	{include file="contests.tpl"}
</div><!--//contact-->