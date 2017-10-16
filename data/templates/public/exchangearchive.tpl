
            <div class="innerPage">

				<h1>Архив курса валют</h1>
				{assign var="i" value=1}
				<table class="tours-table" width="100%">
				<tr class="table-heading">
					<td class="tour-name" width="100">Дата</td>
						{foreach from=$currency item=item}
						{if $item.intCurrencyID!=1}<td  class="tour-name">{$item.varName}</td>{/if}
						{/foreach}
					</tr>
					<tr class="odd">
					{foreach from=$archive item=item key=key name=archivecurr}{if is_integer($key)}
						{if ($aid!=$item.intArchiveID && !$smarty.foreach.archivecurr.first)}
						</tr>
						<tr {if $i%2==1}class="odd"{/if}>
							<td style="text-align: left;"  class="tour-name"><strong>{$item.varDate|date_format:"%d-%m-%Y"}</strong></td>
						{/if}
						{if !$aid}
							<td style="text-align: left;"  class="tour-name"><strong>{$item.varDate|date_format:"%d-%m-%Y"}</strong></td>
						{/if}
						{assign var="i" value=$i+1}
						{assign var=aid value=$item.intArchiveID}
						{foreach from=$currency item=it}
							{if $it.intCurrencyID==$item.intCurrencyID && $item.intCurrencyID!=1}
								<td  style="text-align: left;">{$item.intRate}</td>
							{/if}
						{/foreach}
					{/if}{/foreach}
					</tr>
				</table>
                {include file='scroller_for_public.tpl' pager=$archive.pager script=1}
            </div>
