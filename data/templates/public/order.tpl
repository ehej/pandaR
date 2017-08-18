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
<div class="content">
	<h1>Заявка на тур "{$data.varName}"</h1>
	<form class="order-form" method="post" id="order-form" action="/order.php">
		<input type="hidden" name="event" value="order">
		<input type="hidden" name="intTourID" value="{$data.intTourID}">
		<fieldset>
		<div class="heading-blue">
			<h2 class="title"><span>Информация о туре</span></h2>
		</div>
			<div class="form-line">
				<label class="flabel" for="varTourName">Тур</label>
				<input type="text" id="varTourName" readonly="" class="text-field-mark " value="{$data.varName}">
			</div>
			<div class="form-line">
				<label class="flabel" for="varCountryName">Страна</label>
				<input type="text" id="varCountryName" readonly="" class="text-field-mark " value="{$data.varCountryName}">
			</div>
			<div class="form-line">
				<label class="flabel" for="varTourTypeName">Вид тура</label>
				<input type="text" id="varTourTypeName" readonly="" class="text-field-mark " value="{$data.varTypeName}">
			</div>
			<div class="form-line">
				<label class="flabel" for="varResortName">Отель/курорт</label>
				<input type="text" readonly="" id="varResortName" class="text-field-mark " value="{$data.varResortName}">
			</div>
			<div class="form-line">
				<label class="flabel" for="">Даты тура c</label>
				<div class="datapicker">
					<input type="text" name="varDateFrom" class="text-field date CHECKIN_BEG dp-applied" value="{$data.varDateFrom|date_format:'%d.%m.%Y'}">
					<img width="13" height="13" alt="" src="images/calendar.png">
				</div>
				<label class="fleft" for=""> по</label>
				<div class="datapicker">
					<input type="text" name="varDateTo" class="text-field date CHECKIN_BEG dp-applied" value="{$data.varDateTo|date_format:'%d.%m.%Y'}">
					<img width="13" height="13" alt="" src="images/calendar.png">
				</div>
			</div>
			<div class="form-line">
				<label class="flabel" for="intDays">Количество дней</label>
				<input type="text" readonly="" id="intDays" class="text-field-mark " value="{$data.intCountDays}">
			</div>
			<div class="form-line">
				<label class="flabel" for="varTransportName">Транспорт</label>
				<input type="text" readonly="" id="varTransportName" class="text-field-mark " value="{$data.varTransport}">
			</div>
			<div class="form-line">
				<label class="flabel" for="varPlaceName">Размещение</label>
				<input type="text" readonly="" id="varPlaceName" class="text-field-mark " value="{$data.varPlaceTypeName}">
			</div>
			<div class="form-line">
				<label class="flabel" for="varFoodName">Питание</label>
				<input type="text" readonly="" id="varFoodName" class="text-field-mark " value="{$data.varFoodTypeName}">
			</div>
			<div class="form-line">
				<label class="flabel" for="intCountPeoples">Количество человек</label>
				<input type="text" readonly="" id="intCountPeoples" class="text-field-mark " value="{$data.intCountPeoples}">
			</div>
			<div class="form-line">
				<label class="flabel" for="varPrice">Цена</label>
				<input type="text" readonly="" id="varPrice" class="text-field-mark " value="{$data.intPriceFrom} {$data.varMark}">
			</div>
		<div class="heading-blue">
			<h2 class="title"><span>Контактная информация</span></h2>
		</div>
			<div class="form-line">
				<label class="flabel" for="">ФИО</label>
				<input type="text" name="varFIO" {if $UserData.varFIO}value="{$UserData.varFIO}" readonly class="text-field-mark"{else}class="text-field"{/if} />
			</div>
			<div class="form-line">
				<label class="flabel" for="">Контактный телефон<span class="required">*</span></label>
				<input type="text" rel="Контактный телефон" name="varTel" {if $UserData.varTels}value="{$UserData.varTels}" readonly class="text-field-mark"{else}class="text-field"{/if} />
			</div>
			<div class="form-line">
				<label class="flabel" for="">Контактный E-mail<span class="required">*</span></label>
				<input type="text" rel="Контактный E-mail" name="varMail" {if $UserData.varEmail}value="{$UserData.varEmail}" readonly class="text-field-mark mail"{else}class="text-field mail"{/if}>
			</div>
			<div class="form-line">
				<label class="flabel" for="">Комментарии</label>
				<textarea cols="55" name="varComments" rows="5"></textarea>
			</div>
			<input type="button" onclick="inquiryvalidate('#order-form', true)" class="order-submit" value="Отправить">

		</fieldset>
	</form>

</div>