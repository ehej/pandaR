<?php /* Smarty version 2.6.19, created on 2017-08-16 22:44:12
         compiled from F:/OpenServer/domains/panda.fm/data/templates/public/enter.tpl */ ?>
<?php if ($_GET['task'] == 'registration' || $_GET['task'] == 'register' || $_GET['task'] == 'edit'): ?>
<div class="content">
	<h1>Заявка на регистрацию</h1>
	<form class="order-form" method="post" id="order-form" action="/enter.php">
		<input type="hidden" name="event" value="register">
		<fieldset>
			<h4>Все поля обязательны для заполнения</h4><br>
			<!-- /////////////////////////// -->
		<div class="heading-blue">
			<h2 class="title"><span>Информация для регистрации</span></h2>
		</div>
		<div class="form-line">
			<label class="flabel" for="varLogin">Логин</label>
			<input type="text" rel="Логин" id="varLogin" class="text-field-mark " name="varLogin" value="<?php echo $this->_tpl_vars['data']['varLogin']; ?>
">
		</div>
		<div class="form-line">
			<label class="flabel" for="varPassword">Пароль</label>
			<input type="password" rel="Пароль" id="varPassword" class="text-field-mark " name="varPassword" value="<?php echo $this->_tpl_vars['data']['varPassword']; ?>
">
		</div>
		<div class="form-line">
			<label class="flabel" for="varRePassword">Подтвердите пароль</label>
			<input type="password" rel="Подтвердите пароль" id="varRePassword" class="text-field-mark " name="varRePassword" value="<?php echo $this->_tpl_vars['data']['varRePassword']; ?>
">
		</div>
			<!-- /////////////////////////// -->
		<div class="heading-blue">
			<h2 class="title"><span>Информация о агентстве</span></h2>
		</div>
		<div class="form-line">
			<label class="flabel" for="varName">Название агентства</label>
			<input type="text" id="varName" rel="Название агентства" class="text-field-mark " name="varName" value="<?php echo $this->_tpl_vars['data']['varName']; ?>
">
		</div>
		<div class="form-line">
			<label class="flabel" for="varOwnership">Форма собственности</label>
			<input type="text" rel="Форма собственности" id="varOwnership" class="text-field-mark part" name="varOwnership" value="<?php echo $this->_tpl_vars['data']['varOwnership']; ?>
">
			<label class="flabel forpart" for="varEGRPO">Код ЕГРПО</label>
			<input type="text" rel="Код ЕГРПО" id="varEGRPO" name="varEGRPO" class="text-field-mark part" value="<?php echo $this->_tpl_vars['data']['varEGRPO']; ?>
">
		</div>
		<div class="form-line">
			<label class="flabel" for="varUrName">Юридическое название агентства</label>
			<input type="text" id="varUrName" rel="Юридическое название агентства" class="text-field-mark " name="varUrName" value="<?php echo $this->_tpl_vars['data']['varUrName']; ?>
">
		</div>
		<div class="form-line">
			<label class="flabel" for="varBankGuarantee">Банковская гарантия</label>
			<input type="text" id="varBankGuarantee" name="varBankGuarantee" rel="Банковская гарантия" class="text-field-mark " value="<?php echo $this->_tpl_vars['data']['varName']; ?>
">
		</div>
		<div class="form-line">
			<label class="flabel" for="varTels">Телефоны</label>
			<input type="text" id="varTels" rel="Телефоны" class="text-field-mark " name="varTels" value="<?php echo $this->_tpl_vars['data']['varTels']; ?>
">
		</div>
		<div class="form-line">
			<label class="flabel" for="varFax">Факс</label>
			<input type="text" id="varFax" rel="Факс" class="text-field-mark " name="varFax" value="<?php echo $this->_tpl_vars['data']['varFax']; ?>
">
		</div>
		<div class="form-line">
			<label class="flabel" for="varEmail">E-mail</label>
			<input type="text" id="varEmail" rel="E-mail" class="text-field-mark " name="varEmail" value="<?php echo $this->_tpl_vars['data']['varEmail']; ?>
">
		</div>
			<!-- /////////////////////////// -->
		<div class="heading-blue">
			<h2 class="title"><span>Юридический адрес</span></h2>
		</div>
		<div class="form-line">
			<label class="flabel" for="varUrIndex">Индекс</label>
			<input type="text" id="varUrIndex" rel="Индекс" class="text-field-mark part" name="varUrIndex" value="<?php echo $this->_tpl_vars['data']['varUrIndex']; ?>
">
			<label class="flabel forpart" for="varUrCity">Город</label>
			<input type="text" id="varUrCity" rel="Город" name="varUrCity" class="text-field-mark part" value="<?php echo $this->_tpl_vars['data']['varUrCity']; ?>
">
		</div>
		<div class="form-line">
			<label class="flabel" for="varUrAddress">Улица, дом, офис</label>
			<input type="text" id="varUrAddress" rel="Улица, дом, офис" class="text-field-mark " name="varUrAddress" value="<?php echo $this->_tpl_vars['data']['varUrAddress']; ?>
">
		</div>
			<!-- /////////////////////////// -->
		<div class="heading-blue">
			<h2 class="title"><span>Фактический адрес</span></h2>
		</div>
		<div class="form-line">
			<label class="flabel" for="varFizIndex">Индекс</label>
			<input type="text" id="varFizIndex" rel="Индекс" name="varFizIndex" class="text-field-mark part" value="<?php echo $this->_tpl_vars['data']['varFizIndex']; ?>
">
			<label class="flabel forpart" for="varFizCity">Город</label>
			<input type="text" id="varFizCity" rel="Город" class="text-field-mark part" name="varFizCity" value="<?php echo $this->_tpl_vars['data']['varFizCity']; ?>
">
		</div>
		<div class="form-line">
			<label class="flabel" for="varFizAddress">Улица, дом, офис</label>
			<input type="text" id="varFizAddress" rel="Улица, дом, офис" class="text-field-mark " name="varFizAddress" value="<?php echo $this->_tpl_vars['data']['varFizAddress']; ?>
">
		</div>
		<div class="form-line">
			<label class="flabel" for="varFIO">ФИО директора</label>
			<input type="text" id="varFIO" rel="ФИО директора" class="text-field-mark " name="varFIO" value="<?php echo $this->_tpl_vars['data']['varFIO']; ?>
">
		</div>
			<!-- /////////////////////////// -->

            <p><input type="button" class="order-submit"  value="Отправить" onclick="inquiryvalidate('#order-form', true)"/></p>
		</fieldset>
	</form>
</div>
<script>
<?php echo '
function RegistrationForm(type) {
    if(inquiryvalidate($(\'#registrationForm\'), false)) {
        $(\'#event\').val(type);
        $(\'#registrationForm\').submit();
    }
}
function HilightElement(e) {
	$(e).css(\'border\', \'1px solid red\');
}
$(document).ready(function(){
'; ?>

<?php $_from = $this->_tpl_vars['hilightFormElements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem'] => $this->_tpl_vars['rule']):
?>
	HilightElement('#<?php echo $this->_tpl_vars['elem']; ?>
');
<?php endforeach; endif; unset($_from); ?>
<?php echo '
});
'; ?>

</script>
<?php elseif ($_GET['task'] == 'forgot'): ?>
<div class="content">
<h1>Напоминание пароля</h1>
<form action="" method="post" class="order-form" id="registrationForm"  name="registrationForm">
	<input type="hidden" name="event" id="event" value="forgot" />
	<div class="heading-blue">
		<h2 class="title"><span>Информация для восстановления</span></h2>
	</div>
	<div class="form-line">
		<label class="flabel" for="varLogin">Ваш Email</label>
		<input type="text" value="" class="text-field-mark "  name="varEmail" id="varEmail">
	</div>
	
	<p><input type="submit" class="order-submit" class="iconize"  value="Отправить" /></p>
</form>
</div>
	<?php else: ?>
		<?php echo '
		<script type="text/javascript">
			function EnterForm(event) {
				$(\'#event\').val(event);
				$(\'#enterForm\').submit();
			}
		</script>
		'; ?>

<?php if ($_GET['type'] == 'hide'): ?>
<h4>Для просмотра запрашиваемой страницы Вам необходимо авторизоваться.</h4>
<?php endif; ?>
		<h3>Вход для агенств</h3>
		<div style=" position: relative; ">
			<div style=" font-size: 14px;">
				<form action="/enter.php" method="post" id="enterForm" name="enterForm">
					<input type="hidden" name="event" id="event" value="" />
					<?php if ($this->_tpl_vars['userData'] || $this->_tpl_vars['varUser']): ?>
					<div style="">
						<div style="color: rgb(38, 84, 126); font-size: 12px; font-weight: bold;">Здравствуйте, <br><?php echo $this->_tpl_vars['varUserData']['varName']; ?>
</div>
						<div style="padding-top: 10px; padding-left: 5px; text-align: left; line-height: 30px;">
														<a style="color: #26547e; font-size: 12px; " href="/enter.php?task=edit">Мои данные</a>
						</div>
						<div style="padding-top: 5px; padding-left: 50px;">
							<input type="button" value="Выход" onclick="EnterForm('exit')" />
						</div>
					</div>
					<?php else: ?>
						<div class="subscribe"><span class="autorisetitle">Login</span> <input type="text" name="varLogin" id="varLogin" onfocus="this.value=''" value="" /></div>
						<div class="subscribe"><span class="autorisetitle">Password</span> <input type="password" name="varPassword" onfocus="this.value=''" value="" /></div>
						<div class="subscribe" style="font-size: 10px;"><a href="/enter.php?task=registration" style="color: #26547e;">Регистрация</a> | <a href="/enter.php?task=forgot" style="color: #26547e;">Напомнить пароль</a></div>
						<div class="subscribe"><input type="button" onclick="EnterForm('enter')" value="Войти" src="/images/button_submit.gif" style="font-size: 18px; text-align: center;  cursor: pointer;" /></div>
					<?php endif; ?>
				</form>
			</div>
		</div>
<?php endif; ?>