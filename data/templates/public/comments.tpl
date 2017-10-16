{if $isShowComments=='yes'}
<div class="title" style="padding: 15px;">Комментарии</div>
<div class="title" style="text-align: right; width: 100%; font-size: 20px;">
	<div align="right" style="margin-bottom: 20px; padding-bottom: 15px;">
	<span style="cursor: pointer;{if $commentFlag=='true'} display: none;{/if}" onclick="javascript:changeShowCommentForm();">Добавить комментарий</span> <div style="height:15px;">&nbsp;</div>
	<div id="commentBlock" style="display: {if $commentData}block{else}none{/if}; font-family: Arial; font-size: 12px;">
		<form method="post" id="userForm" action="">
		<input type="hidden" name="event" value="comment" />
		<table border="0" style="border-collapse: collapse; width: 100%; font-size: 12px; color: #365782;">
			<tr>
				<td>Имя (*)</td>
				<td class="commentBlock"><input type="text" value="{$commentData.varName}" size="20" maxlength="255" name="varName" id="varName" /></td>
			</tr>
			
			<tr>
				<td>Комментарий (*)</td>
				<td class="commentBlock"><textarea id="varComment" name="varComment" cols="30" rows="5">{$commentData.varComment}</textarea></td>
			</tr>
			<tr>
				<td>Введите код (*)</td>
				<td class="commentBlock"><img src="/kcaptcha.php?id={php} echo time();{/php}" alt="captcha" /><br/><br/><input type="text" name="Captcha" value="" id="Captcha" style="text-align:center;width:75px;" /></td>
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
	</div>
	{if $commentFlag=='true'}
	<div style="width: 100%; text-align: center; font-size: 12px; font-family: Arial;">Ваш комментарий будет добавлен после модерации</div>
	{else}
		{if $commentFlag=='false'}
		<div style="width: 100%; text-align: center; font-size: 12px; color: red; padding: 20px 0px; font-family: Arial;">Исправте ошибки заполнения формы</div>
		{/if}
		<table cellpadding="5" cellspacing="" class="currencyTable">
		{foreach from=$comments item=item}
			<tr>
				<td style="border-bottom: 2px solid #0a70d6; padding: 10px;">
					<div style="display: inline;" class="currencyValue">{$item.varName}</div>
					<div style="float: right;" class="currencyDate">{$item.varDate|date_format:"%d.%m.%Y"}</div>
					<div style="font-style: italic; padding: 5px 0px; padding-top: 15px; font-family: Arial; font-size: 12px; color: gray;">{$item.varComment}</div>
				</td>
			</tr>
		{/foreach}
		</table>
	{/if}
	</div>
</div>
{/if}