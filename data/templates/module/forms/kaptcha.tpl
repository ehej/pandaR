<table>
	<tr>
		<td style="border: 0;"><img src="/kcaptcha.php?name=form_{$data.intFormID}_field_{$data.intFieldID}&{php}echo rand(100000,999999){/php}"></td>
		<td style="border: 0;">&nbsp;</td>
		<td style="border: 0;"><input 
				type="text" 
				name="form_{$data.intFormID}_field_{$data.intFieldID}"  
				id="form_{$data.intFormID}_field_{$data.intFieldID}"  
				style="
					{if $data.intSizeW}width: {$data.intSizeW}px;{/if}
					{if $data.intSizeH} height: {$data.intSizeH}px;{/if}
					"
				class="required"	 
				{$data.varAttribute}
				{if $data.intMaxLenght != 0}maxlength="{$data.intMaxLenght}"{/if}
				>
		</td>
	</tr>
</table>