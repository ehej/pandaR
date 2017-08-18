			{include file="banners.tpl"}
	        <div class="innerPage">
	        	{include file="layout/bread_crumbs.tpl"}
					<div class="Title">
						<h1>Гостевая книга</h1>
					</div>
					<div>
						<table class="table_hotel" cellpadding="0" cellspacing="0">
							{foreach from=$data item=item key=key}
								{if is_integer($key)}
								<tr>
									<td style="text-align: left;">
										<div style="display: inline; float: left; font-weight:bold;" class="currencyValue">{$item.varName}</div>
										<div style="display: inline; float: right; margin-right: 5px;">{$item.varDate|date_format:"%d.%m.%Y %H:%M"}</div>
										<div class="clear"></div>
										<div style="font-weight: bold; padding: 5px 0px 5px; padding-top: 15px;">{$item.varText}</div>
										{if $item.varAnswer}
										<div style="font-style: italic; padding: 5px 0px 5px 25px;">
											Ответ: {$item.varAnswer}
										</div>
										{/if}
									</td>
								</tr>
								{/if}
							{/foreach}
							{if $data.pager}
							<tr>
								<td colspan="2">{include file="scroller_for_public.tpl" pager=$data.pager script=1}</td> 
							</tr>
							{/if}
						</table>
						<form action="/guest-book" method="post">
						<input type="hidden" name="event" value="Add">
					   	<table border="0" style="border-collapse: collapse; width: 100%; font-size: 12px; color: #365782;">
							<tr>
								<td>Имя (*)</td>
								<td><input type="text" value="{$GBData.varName}" size="20" maxlength="255" name="varName" id="varName" /></td>
							</tr>
							<tr>
								<td>E-mail</td>
								<td><input type="text" value="{$GBData.varEmail}" size="20" maxlength="255" name="varEmail" id="varEmail" /></td>
							</tr>
							<tr>
								<td>WWW</td>
								<td><input type="text" value="{$GBData.varSite}" size="20" maxlength="255" name="varSite" id="varSite" /></td>
							</tr>
							
							<tr>
								<td>Комментарий (*)</td>
								<td><textarea id="varText" name="varText" cols="30" rows="5">{$GBData.varText}</textarea></td>
							</tr>
							<tr>
								<td>Введите код (*)</td>
								<td><img src="/kcaptcha.php?id={php} echo time();{/php}" alt="captcha" /><br/><br/><input type="text" name="Captcha" value="" id="Captcha" style="text-align:center;width:75px;" /></td>
							</tr>
							<tr>
								<td></td>
								<td class="commentBlock"><input type="submit" value="Отправить" name ="Submit" id="Submit" /></td>
							</tr>
							<tr>
								<td></td>
								<td class="commentBlock">«*» - поля обязательные для заполнения<br/><br/></td>
							</tr>
						</table>	
						</form>
		                <p>&nbsp;</p>
		                <p><a href="#" class="scrollTop">Наверх</a></p>
		            </div>

		            <div class="clear"></div>
		   </div>