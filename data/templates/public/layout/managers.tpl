{if $managers}
<div class="manager-box-tr">
	<div class="manager-box-br">
		<div class="manager-box">
			<h3 class="managers-title">Менеджеры</h3>
			<ul class="managers">
				<li>
				{foreach from=$managers item=item name=name}
				{if $smarty.foreach.name.iteration % 2 != 0 && $smarty.foreach.name.iteration != 1}
				</li>
				<li>
				{/if}
					<br clear="all" />
					{if $item.varFoto}<img src="{$path}{$item.varFoto}" alt="" width="70" />{/if}
					<strong class="name">{$item.varName}</strong>
					<ul>
						{foreach from=$item.contact item=it}
						<li> 
							{if $it.varStaffType == 'phone'}<span>тел: </span>{/if}
							{if $it.varStaffType == 'email'}<span>email: </span>{/if}
							{if $it.varStaffType == 'mobile'}<span>моб: </span>{/if}
							{if $it.varStaffType == 'icq'}<span>icq: </span>{/if}
							{if $it.varStaffType == 'skype'}<span>skype: </span>{/if}
							{$it.varText}<br>
						</li>
						{/foreach}
					</ul>
					<br clear="all" />
				{/foreach}
				</li>
			</ul>
		</div>
	</div>
</div>
{/if}