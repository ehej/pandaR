<table cellpadding="0" cellspacing="0" class="auto_form">
{foreach name=form from=$data item=item key=key}
	<tr class="{if $smarty.foreach.form.iteration %2 == 0}first{else}second{/if}">
		<td class="first_cell">{$item.varName} {if $item.intImportant}<span style="color:#ff0000;font-size: 150%;">*</span>{/if}</td>
		<td class="second_cell"><span style="color:#000;font-size: 80%;">{$item.varDescription}</span><br />
		{$item.html}</td>
	</tr>
{/foreach}
</table>