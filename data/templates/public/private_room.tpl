{literal}
<script type="text/javascript">
	$(document).ready(function(){
		{/literal}
		{foreach from=$hilightFormElements item=rule key=elem}
			HilightElement('#{$elem}');
		{/foreach}
		{literal}	
	});
	
	function HilightElement(e) {
		$(e).css('border', '1px solid red');
	}
</script>
{/literal}
{include file="banners.tpl"}
<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	<div class="title" style="text-align: center;">Авторизация</div>
	
	{if $messages}
		{if $messages.errors}
			{foreach from=$messages.errors item=item}
	<div style="color: red; font-size: 12px; padding: 10px;" align="center">{$item}</div>
			{/foreach}
		{/if}
		{if $messages.success}
			{foreach from=$messages.success item=item}
	<div style="color: green; font-size: 12px; padding: 15px;" align="center">{$item}</div>
			{/foreach}
		{/if}
	{/if}
	
	{if !$messages.success && !$auth}
	<form method="post" action="">
	<input type="hidden" name="event" id="event" value="logon" />
	<table cellpadding="0" cellspacing="0" style="border-collapse: collapse; font-size: 12px; color: #365782; line-height: 40px; margin: 40px auto 0; ">
		<tr>
			<td style="text-align: right; padding-right: 20px;">Логин</td>
			<td style="text-align: left;"><input type="text" id="varLogin" name="varLogin" value="{$varLogin}" /></td>
		</tr>
		<tr>
			<td style="text-align: right; padding-right: 20px;">Пароль</td>
			<td style="text-align: left;"><input type="text" id="varPassword" name="varPassword" value="{$varPassword}" /></td>
		</tr>
		<tr>
			<td style="text-align: right; padding-right: 20px;">&nbsp;</td>
			<td style="text-align: left;"><input type="submit" value="Войти" /></td>
		</tr>
	</table>
	</form>
	{else}
	<div align="center">
		{*<div style="padding: 20px;" align="center">
			<a href="" target="_blank" style="color: #336799; font-size: 12px;">Список заявок</a>
		</div>	
		*}
		<input type="button" value="Выход" align="center" onclick="javascript:document.location.href='private_room.php?event=logout';" />
	</div>
	{/if}
	
	{include file="galleries.tpl"}
	
	{include file="comments.tpl"}
	
	{include file="contests.tpl"}
	
</div>