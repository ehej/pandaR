<select 
	name="form_{$data.intFormID}_field_{$data.intFieldID}" 
	id="form_{$data.intFormID}_field_{$data.intFieldID}" 
	{$data.varAttribute}
	style="
		{if $data.intSizeW}width: {$data.intSizeW}px;{/if}
		{if $data.intSizeH} height: {$data.intSizeH}px;{/if}
		"
	>
	{if $data.intImportant == 0}
		<option value=""></option>
	{/if}
	{foreach name=form from=$data.varValues item=item key=key}
		<option value="{$item.key}" 
			{if $data_active}
				{if $item.key == $data_active}selected="selected"{/if}
			{else}
				{if $item.key == $data.varDefaultValue}selected="selected"{/if}
			{/if}
		>{$item.value}</option>
	{/foreach}
</select>