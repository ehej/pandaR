<input 
	type="password" 
	value="" 
	name="form_{$data.intFormID}_field_{$data.intFieldID}"  
	id="form_{$data.intFormID}_field_{$data.intFieldID}"  
	style="
		{if $data.intSizeW}width: {$data.intSizeW}px;{/if}
		{if $data.intSizeH} height: {$data.intSizeH}px;{/if}
		"
	class="
		{if $data.intImportant == 1} required {/if} 
		{if $data.varCheck == 'email'} email {/if}
		{if $data.varCheck == 'date'} date {/if}
		{if $data.varCheck == 'empty' && $data.intImportant != 1} required {/if}
		"	 
	{$data.varAttribute}
	{if $data.intMaxLenght != 0}maxlength="{$data.intMaxLenght}"{/if}
>