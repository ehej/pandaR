<link rel="stylesheet" href="/css/facebox.css" type="text/css" media="screen" />
<script type="text/javascript" src="/js/facebox.js"></script>
{literal}
<script type="text/javascript">
	function getSO() {
		$('#loader').show();
		$.post('countries.php', {intDepadtureCityID: $('#intDepadtureCityID').val(), intCountryID: $('#intCountryID').val(), event: "getSO"},  function(data) {
			$("#so_ajax").html(data);
			$('#loader').hide();
		});
	}
	
	window.onload = function(){
		var divs = $('div.inner div.newcorner');
		var maxHeight = 0;
		$.each(divs, function(index) { 
		  	if (parseInt($(this).height()) > maxHeight) {
		  		maxHeight = parseInt($(this).height()); 
		  	} 
		});
		var divsInner = $('div.topTour div.inner');
		$.each(divs, function(index) { 
			$(this).css('height', maxHeight + 'px');
		});
		$.each(divsInner, function(index) { 
			$(this).css('height', maxHeight + 'px');
		});
	};
	
	$(document).ready(function(){
		{/literal}
		{foreach from=$hilightFormElements item=rule key=elem}
			HilightElement('#{$elem}');
		{/foreach}
		{literal}	
	});
	
	function getSO() {
		$('#loader').show();
		$.post('index.php', {intDepadtureCityID: $('#intDepadtureCityID').val(), event: "getSO"},  function(data) {
			$("#so_ajax").html(data);
			$('#loader').hide();
		});
	}
	
	function HilightElement(e) {
		$(e).css('border', '1px solid red');
	}
	function showInfoTour(varInfo, trHotels, trService, onLine, varFile, varDateCreated, varName, varDateFromTo, varDescription, varDuration) {
		$('#varDateCreatedDIV').html(varDateCreated);
		if(varFile != '') {
			$('#varNameA').attr('href', {/literal}'{$FILES_URL}'{literal}  + varFile).html(varName);
			$('#excelLink').attr('href', {/literal}'{$FILES_URL}'{literal}  + varFile);
		} else {
			$('#varNameA').html(varName);
			$('#excelImg').hide();
		}
		$('#varDateFromToDIV').html(varDateFromTo);
		$('#varDescriptionDIV').html(varDescription);
		$('#varDurationDIV').html(varDuration);
		if (varInfo != '') {
			$('#contentTD').html('Информация о туре:<div style="color: #444; font-size: 11px; padding-top: 10px;">' + varInfo + '</div>');
		} else {
			$('#trServiceDIV').html(trService);
			$('#trHotelsDIV').html(trHotels);
		}
		$('#onLine').attr('href', $('#' + onLine).attr('href'));
		$.facebox($('#faceboxDiv').html());
	}
</script>
{/literal}
<div id="faceboxDiv" style="display: none; vertical-align: top;">
	<div style="float: right;" align="right">
		<a href="javascript:jQuery.facebox.close(); $.noop();"><img alt="" src="/images/Close_Icon.png" width="32" height="31"></a>
	</div>
	<div><h4 class="title" style="font-size: 20px; margin: 0px; margin-bottom: 20px;">Дополнительная информация по туру</h4></div>
	<div style="padding-left: 20px; font-size: 12px;">
		<table>
			<tr>
				<td class="date" id="varDateCreatedDIV" style="color: #0A5095; font-size: 18px; width: 60px; text-align: left;"></td>
				<td class="place">
					<a href="" id="varNameA" style="color: #444; font-size: 11px;"></a><br/>
					<div id="varDateFromToDIV" style="color: #444; font-size: 11px;"></div>
				</td>
				<td class="description">
					<div id="varDescriptionDIV" style="color: #444; font-size: 11px;"></div>
					<div id="varDurationDIV" style="color: #444; font-size: 11px;"></div>
				</td>
				<td style="width: 120px;">
					<a href="" id="excelLink"><img src="{$PROJECT_URL}images/ic_excel.gif" id="excelImg" /></a>&nbsp;
					<a href="" id="onLine" style="font-weight: bold; color: #0A5095;">On-Line</a>
				</td>
			</tr>
			<tr>
				<td class="date" id="contentTD" colspan="4" style="font-size: 14px; padding-top: 20px; color: #0A5095;">
					Дополнительно: 
					<div id="trServiceDIV" style="color: #444; font-size: 11px; padding-top: 10px;"></div>
					<br />
					Отели: 
					<div id="trHotelsDIV" style="color: #444; font-size: 11px; padding-top: 10px;"></div>
				</td>
			</tr>
		</table>
	</div>
	<!-- <hr style="width: 100%;" /> -->
</div>
<div class="baner">
   {include file="banners.tpl"}
</div>
<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	{if $special_offers}
	<div class="conrols" id="controls" style="vertical-align: middle;">
		<div align="left" style="vertical-align: middle; text-align: left; float: left;">
			<form action="/so.php" id="searchSO" name="searchSO">
				<input type="hidden" name="intCountryID" id="intCountryID" value="{$data.intCountryID}">
				<span style="color: #0A5095; font-size: 12px; text-transform: none;">Город вылета:</span>
				<select name="intDepadtureCityID" id="intDepadtureCityID" onchange="javascript:$('#searchSO').submit(); $.noop();" style="text-transform: none;">
				<option value="">Все города</option>
				{foreach from=$departure_cities item=item}
					<option value="{$item.intDepadtureCityID}"{if $intDepadtureCityID==$item.intDepadtureCityID} selected="selected"{/if}>{$item.varName}</option>
				{/foreach}
				</select>
			</form>
		</div>
		<a class="down">Развернуть разделы</a>
		<a class="up">Свернуть разделы</a>
	</div>
	<div id="so_ajax">
		{foreach from=$special_offers key=key item=item}
		<div class="item expanded">
			<h1><span>{$key}</span></h1>
			<div>
			{foreach from=$item item=it}
				
				{if $prev != $it.intPromotionTypeID}
				<div class="box {if $promotion_types[$it.intPromotionTypeID].varColapse != 'N'} expanded-box {else} collapsed-box {/if}">
					<h2>
						<span>{$promotion_types[$it.intPromotionTypeID].varName}</span> 
						<a href="/">Все предложения и цены &raquo;</a>
					</h2>
					<div {if $promotion_types[$it.intPromotionTypeID].varColapse != 'N'} {else} class="hide" {/if}>
				{/if}
						<table>
							<tr>
								<td class="date">{$it.varDateCreated|date_format:"%d.%m"}</td>
								<td class="place">
									<a href="/">{$it.varName}</a><br/>
									(c {$it.varDateFrom|date_format:"%d.%m.%y"} по {$it.varDateTo|date_format:"%d.%m.%y"})
								</td>
								<td class="description" style="width: 280px;">
									{$it.varDescription}
									Продолжительность тура: {$it.varDuration} ночей
								</td>
								<td style="width: 120px;">
									<a href='javascript:showInfoTour("{$it.varInfo|replace:":'}", "{$it.trHotels|replace:":'}", "{$it.trService}", "onLine{$smarty.foreach.spos.iteration}", "{$it.varFile}", "{$it.varDateCreated|date_format:"%d.%m"}", "{$it.varName}", "(c {$it.varDateFrom|date_format:"%d.%m.%Y"} по {$it.varDateTo|date_format:"%d.%m.%Y"})", "{$it.varDescription|repalace:":'}", "Продолжительность тура: {$it.varDuration} ночей"); $.noop();'><img src="{$PROJECT_URL}images/info.gif" /></a>&nbsp;
									{if $it.varFile}
									<a href="{$FILES_URL}{$it.varFile}">
									{if $it.ext=='docx'||$it.ext=='doc'}
									<img src="{$PROJECT_URL}images/word.png" width="15" height="15" />
									{elseif $it.ext=='xlsx'||$it.ext=='xls'}
									<img src="{$PROJECT_URL}images/excel.png" width="15" height="15" />
									{/if}
									</a>&nbsp;
									{/if}
									<a id="onLine{$smarty.foreach.spos.iteration}" href="http://online.mibstravel.ua/Extra/QuotedDynamic.aspx?country={foreach from=$countries item=ite}{if $key==$ite.varName}{$ite.intMTCountryID}{/if}{/foreach}&tour={$it.intSpecOffIDMT}&dateFrom={$it.varDateFromMT|date_format:"%Y-%m-%d"}&dateTo={$it.varDateToMT|date_format:"%Y-%m-%d"}" style="font-weight: bold; color: #0A5095;">On-Line</a>
								</td>
							</tr>
						</table>
						{assign var=prev value=$it.intPromotionTypeID}
				{if $prev != $it.intPromotionTypeID}
					</div>
				</div>
				{/if}
				
				
				{/foreach}
					</div>
				</div>
			</div>
		</div>	
		{/foreach}
	</div>
	{else}
	<div align="center" style="color: #0A5095; font-size: 12px;">По Вашему запросу спецпредложений не найдено</div>
	{/if}
	
	{include file="galleries.tpl"}
	
	{include file="comments.tpl"}
	
	{include file="contests.tpl"}
	
</div>