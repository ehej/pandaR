{literal}
<script type="text/javascript">
	function HilightElement(e) {
		$(e).css('border', '1px solid red');
	}
	$(document).ready(function(){
	{/literal}
	{foreach from=$hilightFormElements item=rule key=elem}
		HilightElement('#{$elem}');
	{/foreach}
	{literal}	
	});
</script>
{/literal}
{include file="banners.tpl"}
<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	<div class="Title">
		<h1>Обратная связь</h1>
	</div>
	{if $flag=='true'}
	<div style="width: 100%; text-align: center; font-size: 12px;">Сообщение было успешно доставлено</div>
	{else}
		{if $flag=='false'}
		<div style="width: 100%; text-align: center; font-size: 12px; color: red; padding: 20px 0px;">Исправте ошибки заполнения формы</div>
		{/if}
	<form action="/feedback.php" method="post" name="feedbackForm" id="feedbackForm">
		<input type="hidden" name="event" id="event" value="feedback" />
		<table cellpadding="0" cellspacing="0" class="auto_form" style="width: 100%; text-align: left;">
			<tr>
				<td class="feedbackTdLeft">Ф.И.О.</td>
				<td class="feedbackTdRight">
					<input type="text" name="varFIO" id="varFIO" value="{$data.varFIO}" />
				</td>
			</tr>
			<tr>
				<td class="feedbackTdLeft">Телефон</td>
				<td class="feedbackTdRight">
					<input type="text" name="varPhone" id="varPhone" value="{$data.varPhone}" />
				</td>
			</tr>
			<tr>
				<td class="feedbackTdLeft">E-mail</td>
				<td class="feedbackTdRight">
					<input type="text" name="varEmail" id="varEmail" value="{$data.varEmail}" />
				</td>
			</tr>
			<tr>
				<td class="feedbackTdLeft">Название агентства</td>
				<td class="feedbackTdRight">
					<input type="text" name="varName" id="varName" value="{$data.varName}" />
				</td>
			</tr>
			<tr>
				<td class="feedbackTdLeft">Город</td>
				<td class="feedbackTdRight">
					<input type="text" name="varCity" id="varCity" value="{$data.varCity}" />
				</td>
			</tr>
			<tr>
				<td class="feedbackTdLeft">Текст жалобы/предложения </td>
				<td class="feedbackTdRight">
					<textarea rows="5" cols="47" name="varText" id="varText">{$data.varText}</textarea>
				</td>
			</tr>
			<tr>
				<td class="feedbackTdLeft">Введите код</td>
				<td class="feedbackTdRight">
					<img src="/kcaptcha.php?id={php} echo time();{/php}" alt="captcha" /><br/><br/>
					<input type="text" name="Captcha" value="" id="Captcha" style="text-align:center; width:75px;" />
				</td>
			</tr>
			<tr>
				<td class="feedbackTdLeft">&nbsp;</td>
				<td class="feedbackTdRight">
					<input type="submit" value="Отправить" />
				</td>
			</tr>
		</table>
	</form>
	{/if}
	
	{include file="galleries.tpl"}
	
	{include file="comments.tpl"}
	
	{include file="contests.tpl"}
</div>