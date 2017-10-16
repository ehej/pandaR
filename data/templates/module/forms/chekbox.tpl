{foreach name=form from=$data.varValues item=item key=key}
<label>
	<input 
		name="form_{$data.intFormID}_field_{$data.intFieldID}[{$smarty.foreach.foo.iteration}]" 
		id="form_{$data.intFormID}_field_{$data.intFieldID}_{$smarty.foreach.form.iteration}" 
		type="checkbox" 
		{if $data_active}
			{if in_array($item.key, $data_active)}checked="checked"{/if}
		{else}
			{if $item.key == $data.varDefaultValue}checked="checked"{/if}
		{/if}
		value="{$item.key}"  
	>{$item.value}</label>
{/foreach}