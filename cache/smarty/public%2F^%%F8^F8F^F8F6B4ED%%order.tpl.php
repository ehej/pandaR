<?php /* Smarty version 2.6.19, created on 2016-10-27 12:12:49
         compiled from /var/www/pandaH/panda.fm/data/templates/public/order.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '/var/www/pandaH/panda.fm/data/templates/public/order.tpl', 43, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
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
</script>
'; ?>

<div class="content">
	<h1>Заявка на тур "<?php echo $this->_tpl_vars['data']['varName']; ?>
"</h1>
	<form class="order-form" method="post" id="order-form" action="/order.php">
		<input type="hidden" name="event" value="order">
		<input type="hidden" name="intTourID" value="<?php echo $this->_tpl_vars['data']['intTourID']; ?>
">
		<fieldset>
		<div class="heading-blue">
			<h2 class="title"><span>Информация о туре</span></h2>
		</div>
			<div class="form-line">
				<label class="flabel" for="varTourName">Тур</label>
				<input type="text" id="varTourName" readonly="" class="text-field-mark " value="<?php echo $this->_tpl_vars['data']['varName']; ?>
">
			</div>
			<div class="form-line">
				<label class="flabel" for="varCountryName">Страна</label>
				<input type="text" id="varCountryName" readonly="" class="text-field-mark " value="<?php echo $this->_tpl_vars['data']['varCountryName']; ?>
">
			</div>
			<div class="form-line">
				<label class="flabel" for="varTourTypeName">Вид тура</label>
				<input type="text" id="varTourTypeName" readonly="" class="text-field-mark " value="<?php echo $this->_tpl_vars['data']['varTypeName']; ?>
">
			</div>
			<div class="form-line">
				<label class="flabel" for="varResortName">Отель/курорт</label>
				<input type="text" readonly="" id="varResortName" class="text-field-mark " value="<?php echo $this->_tpl_vars['data']['varResortName']; ?>
">
			</div>
			<div class="form-line">
				<label class="flabel" for="">Даты тура c</label>
				<div class="datapicker">
					<input type="text" name="varDateFrom" class="text-field date CHECKIN_BEG dp-applied" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['varDateFrom'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
">
					<img width="13" height="13" alt="" src="images/calendar.png">
				</div>
				<label class="fleft" for=""> по</label>
				<div class="datapicker">
					<input type="text" name="varDateTo" class="text-field date CHECKIN_BEG dp-applied" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['varDateTo'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
">
					<img width="13" height="13" alt="" src="images/calendar.png">
				</div>
			</div>
			<div class="form-line">
				<label class="flabel" for="intDays">Количество дней</label>
				<input type="text" readonly="" id="intDays" class="text-field-mark " value="<?php echo $this->_tpl_vars['data']['intCountDays']; ?>
">
			</div>
			<div class="form-line">
				<label class="flabel" for="varTransportName">Транспорт</label>
				<input type="text" readonly="" id="varTransportName" class="text-field-mark " value="<?php echo $this->_tpl_vars['data']['varTransport']; ?>
">
			</div>
			<div class="form-line">
				<label class="flabel" for="varPlaceName">Размещение</label>
				<input type="text" readonly="" id="varPlaceName" class="text-field-mark " value="<?php echo $this->_tpl_vars['data']['varPlaceTypeName']; ?>
">
			</div>
			<div class="form-line">
				<label class="flabel" for="varFoodName">Питание</label>
				<input type="text" readonly="" id="varFoodName" class="text-field-mark " value="<?php echo $this->_tpl_vars['data']['varFoodTypeName']; ?>
">
			</div>
			<div class="form-line">
				<label class="flabel" for="intCountPeoples">Количество человек</label>
				<input type="text" readonly="" id="intCountPeoples" class="text-field-mark " value="<?php echo $this->_tpl_vars['data']['intCountPeoples']; ?>
">
			</div>
			<div class="form-line">
				<label class="flabel" for="varPrice">Цена</label>
				<input type="text" readonly="" id="varPrice" class="text-field-mark " value="<?php echo $this->_tpl_vars['data']['intPriceFrom']; ?>
 <?php echo $this->_tpl_vars['data']['varMark']; ?>
">
			</div>
		<div class="heading-blue">
			<h2 class="title"><span>Контактная информация</span></h2>
		</div>
			<div class="form-line">
				<label class="flabel" for="">ФИО</label>
				<input type="text" name="varFIO" <?php if ($this->_tpl_vars['UserData']['varFIO']): ?>value="<?php echo $this->_tpl_vars['UserData']['varFIO']; ?>
" readonly class="text-field-mark"<?php else: ?>class="text-field"<?php endif; ?> />
			</div>
			<div class="form-line">
				<label class="flabel" for="">Контактный телефон<span class="required">*</span></label>
				<input type="text" rel="Контактный телефон" name="varTel" <?php if ($this->_tpl_vars['UserData']['varTels']): ?>value="<?php echo $this->_tpl_vars['UserData']['varTels']; ?>
" readonly class="text-field-mark"<?php else: ?>class="text-field"<?php endif; ?> />
			</div>
			<div class="form-line">
				<label class="flabel" for="">Контактный E-mail<span class="required">*</span></label>
				<input type="text" rel="Контактный E-mail" name="varMail" <?php if ($this->_tpl_vars['UserData']['varEmail']): ?>value="<?php echo $this->_tpl_vars['UserData']['varEmail']; ?>
" readonly class="text-field-mark mail"<?php else: ?>class="text-field mail"<?php endif; ?>>
			</div>
			<div class="form-line">
				<label class="flabel" for="">Комментарии</label>
				<textarea cols="55" name="varComments" rows="5"></textarea>
			</div>
			<input type="button" onclick="inquiryvalidate('#order-form', true)" class="order-submit" value="Отправить">

		</fieldset>
	</form>

</div>