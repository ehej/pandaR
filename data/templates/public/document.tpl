			{include file="banners.tpl"}
	        <div class="innerPage">
				{include file="layout/bread_crumbs.tpl"}
                <h1 class="title">Выберите категорию</h1>

                <div class="docs rounded">
                    <div class="tl"></div>
                    <div class="tr"></div>
                    <div class="bl"></div>
                    <div class="br"></div>
                    <div class="info">
                    	
                    {foreach from=$category item=cats key=key name="cats"}
                    	<div class="item {*if $smarty.foreach.cats.iteration == 1}active{/if*}">
                            <h2><span>{$cats.varName}</span></h2>
                            <div class="text">
                            
                            <table>
                            {foreach from=$document[$cats.intCategoryID] item=item key=key name=docs}{if is_integer($key)}
								<tr {if $smarty.foreach.docs.last}class="last"{/if}>
                                    <td><strong><a href="/document.php?event=Doc&intDocumentID={$item.intDocumentID}" title="" target="_blank">{$item.varName}</a></strong>
                                		{$item.varDescription}
                                	</td>
                                    <td class="date">{$item.varDate|date_format:'%d.%m.%Y'}</td>
                                    <td width="45">&nbsp;
                                    	<a href="/document.php?event=Doc&intDocumentID={$item.intDocumentID}" title="" target="_blank"><img src="/images/icon/{$item.varFile}.gif" /></a>
                                    	<a href="/document.php?event=ZipDoc&intDocumentID={$item.intDocumentID}"><img src="/images/icon/zip.gif" /></a>
                                    </td>
                                </tr>
								{/if}
							{/foreach} 
							</table>
                            </div>
                        </div>
                    {/foreach}
                    </div>
                </div>
                {include file="galleries.tpl"}
	
				{include file="comments.tpl"}
				
				{include file="contests.tpl"}
			</div>
