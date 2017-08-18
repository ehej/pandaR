<br />
<div class="country-tours">
{foreach from=$tourtypes item=item name=menu}
		<span><a href="/countries.php?intTypeID={$item.intTypeID}">{$item.varName}</a>&nbsp;{if !$smarty.foreach.menu.last}|{/if}</span>
{/foreach}
</div>