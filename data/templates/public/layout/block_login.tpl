{literal}
<script type="text/javascript">
	function EnterForm(event) 
	{
		$('#event').val(event);
		$('#enterForm').submit();
	}
</script>
{/literal}
<form action="" method="post" id="enterForm" name="enterForm">
	<input type="hidden" name="event" id="event" value="" />
{if $UserData || $varUser}
<div style="">
	<div style="color: rgb(38, 84, 126); font-size: 12px; font-weight: bold;">Здравствуйте, {$UserData.varName}</div>
	<input type="button" class="order-submit" value="Выход" onclick="EnterForm('logout')" />
</div>
{else}
<div class="autlinks">
	<a href="javascript:void(0)" class="loginlink" onclick="$('.autorlogin').toggle();" style="position: relative; z-index: 1010; background: url('/images/key.png') no-repeat scroll 0pt 50% transparent; color: rgb(35, 130, 2); display: inline;">Авторизация</a><br>
	<a href="/enter.php?task=registration" style="position: relative; z-index: 1; color: rgb(241, 82, 12);position: relative;">Регистрация</a>
</div>
<div class="autorlogin" style="display: none;">
	<div>
		<input type="text" class="loginfiels" name="varLogin" id="varLogin" onblur="if (this.value=='') this.value='Логин'" onfocus="if (this.value=='Логин') this.value=''" value="Логин" />
		<input type="text" class="loginfiels" name="varPassword" onblur="passwordfieldchange(this)" onfocus="passwordfieldchange(this)" value="Пароль" />
		<a href="/enter.php?task=forgot" style="font-size: 10px;">Напомнить пароль</a>
		<div style="margin: 3px 0 0;">
			<input type="button" style="margin: 0;" class="order-submit"  onclick="EnterForm('logon')" value="Войти" />&nbsp;&nbsp;&nbsp;
			<span><input type="checkbox" id="remember" name="remember" value="1"> <label for="remember">Запомнить</label></span>
		</div>
	</div>
</div>
{/if}
</form>