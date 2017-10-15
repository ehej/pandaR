<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <title>{$pagetitle|strip_tags|escape} - PANDA TRAVEL</title>
    <meta name="title" content="{$metatitle|escape}" />
    <meta name="description" content="{$metadescription|escape}" />
  	<meta name="keywords" content="{$metakeywords|escape}" />
	{$noindexfollow}
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link type="text/css" rel="stylesheet" href="/css/calendar.css" />
    <link type="text/css" rel="stylesheet" href="/css/jquery.datepick.css" />
    <link type="text/css" rel="stylesheet" href="/css/jcarousel.css" />
    <link type="text/css" rel="stylesheet" href="/css/lytebox.css" />
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css" /><![endif]-->


    <script type="text/javascript">var languageCode = 'ru';</script>
    <script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="/js/jquery.datepick.pack.js"></script>
    <script type="text/javascript" src="/js/jquery.datepick-ru.js"></script>
	<script type="text/javascript" src="/js/calendar.js"></script>
	<script type="text/javascript" src="/js/swfobject.js"></script>
	<script type="text/javascript" src="/js/lytebox.js"></script>
	<script type="text/javascript" src="/js/jquery.jcarousel.min.js"></script>
	<script type="text/javascript" src="/js/jquery.featureList-1.0.0.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <script type="text/javascript" src="/js/jivosite.js"></script>
    
</head>
<body>
<div class="wrapper">
<div class="header">
		<a href="/" class="logo">Panda Travel</a>
		<div class="right-header">
			<div class="autent">
			{include file="layout/block_login.tpl"}
			</div>
			<div class="exchange">
			{foreach from=$currency item=item name=currr}
				{if $smarty.foreach.currr.first}<p><strong>$</strong> <a href="/exchangearchive.php">Курс валют</a> {$item.varDate|date_format:'%d-%m-%Y'}:</p>{/if}
					{if $item.intCurrencyID!=1}<span>1 {$item.varMark} = {$item.intRate} {$gcurrency.varMark}</span>{if !$smarty.foreach.currr.last} | {/if}{/if}
				{/foreach}
			</div>
			<div class="phone">+38(044) <span>537-23-23</span></div>
		</div>
	</div>
	{include file="layout/navigation.tpl" menuArr=$menuListParent}
	<div class="container">
		<div class="main-holder">
			<div class="main">
<!-- <div id="showcase_hike_photo_showcase_module"></div><script src="http://module.ittour.com.ua/showcase_search.jsx?id=22D9176177601G622987N02&type=95&kind=50&width_class=55&row_count=16&border_color=FFFFFF&stars_color=ED1C24&price_color=ED1C24&button_background_color=217F00&select_controls_color=EC3902&bgg_hike_photo_showcase_font_color=000000&bgg_hike_photo_showcase_background_color=E7F8FF&bgg_hike_photo_showcase_background_color_item=F1F1F1&bgg_hike_photo_showcase_order_title_main_color=EBECF2&bgg_hike_photo_showcase_order_title_info_color=1E8FD9"></script> -->
			{include file="layout/slider.tpl"} 
				<div class="extra sidebar">
				{include file="layout/left_block_countries.tpl"}
				</div><!-- end extra -->
				<div class="content">
				{if $messages}
				<div id="messages_block">
					{foreach from=$messages item=message}
						<div class="message {if $message.error}error{else}inform{/if}">
							<h1>{$message.msg}</h1>
						</div>
					{/foreach}
				</div>
				{/if}
				{include file="$page"}
				</div><!-- end content -->
			</div><!-- end main -->
		</div><!-- end main holder-->
		<div class="sidebar">
			<div class="search-box-tr">
				<div class="search-box-br">
					<div class="search-box">
						<h3 class="title">Поиск тура</h3>
						<form action="/tours.php" method="GET" class="search-form">
							<input type="hidden" name="event" value="toursearch">
							<fieldset>
							<div class="form-line">
								<label for="intCountryID">Страна</label>
								<select onchange="changecountry()" id="intCountryID" name="intCountryID">
									<option value=""></option>
									{foreach from=$countries item=item}
									<option {if $smarty.get.intCountryID==$item.intCountryID}selected="selected"{/if} value="{$item.intCountryID}">{$item.varName}</option>
									{/foreach}
								</select>
							</div>
							<div class="form-line">
								<label for="intResortID">Курорт </label>
								{if $URL != $smarty.const.PROJECT_URL|cat:'seminary'}
								<select id="intResortID" name="intResortID">
									<option value=""></option>
									{foreach from=$resorts item=item}
									<option rel="{$item.intCountryID}" {if $smarty.get.intResortID==$item.intResortID}selected="selected"{/if} value="{$item.intResortID}">{$item.varName}</option>
									{/foreach}
								</select>
								{else}
									<input type="text" id="varResortName" name="varResortName" />
								{/if}
							</div>
							<div class="form-line">
								<label for="">Вид отдыха</label>
								<select name="intTypeID">
									<option value=""></option>
									{foreach from=$tourtypes item=item}
									<option {if $smarty.get.intTypeID==$item.intTypeID}selected="selected"{/if} value="{$item.intTypeID}">{$item.varName}</option>
									{/foreach}
								</select>
							</div>
							<div class="form-line">
								<div class="form-col fleft">
									<label for="">Дата </label>
									<div class="datapicker">
										<input class="date CHECKIN_BEG dp-applied" size="12" type="text" value="{$smarty.get.varDate}" name="varDate" autocomplete="off">
										<img src="/images/calendar.png" width="13" height="13" alt="" />
									</div>
								</div>
								<div class="form-col fright">
									<label for="">Дней</label>
									<select name="intCountDays">
										<option value=""></option>
										<option {if $smarty.get.intCountDays==3}selected="selected"{/if} value="3">3</option>
										<option {if $smarty.get.intCountDays==4}selected="selected"{/if} value="4">4</option>
										<option {if $smarty.get.intCountDays==5}selected="selected"{/if} value="5">5</option>
										<option {if $smarty.get.intCountDays==6}selected="selected"{/if} value="6">6</option>
										<option {if $smarty.get.intCountDays==7}selected="selected"{/if} value="7">7</option>
										<option {if $smarty.get.intCountDays==8}selected="selected"{/if} value="8">8</option>
										<option {if $smarty.get.intCountDays==9}selected="selected"{/if} value="9">9</option>
										<option {if $smarty.get.intCountDays==10}selected="selected"{/if} value="10">10</option>
										<option {if $smarty.get.intCountDays==11}selected="selected"{/if} value="11">11</option>
										<option {if $smarty.get.intCountDays==12}selected="selected"{/if} value="12">12</option>
										<option {if $smarty.get.intCountDays==13}selected="selected"{/if} value="13">13</option>
										<option {if $smarty.get.intCountDays==14}selected="selected"{/if} value="14">14</option>
										<option {if $smarty.get.intCountDays==15}selected="selected"{/if} value="15">15</option>
										<option {if $smarty.get.intCountDays==16}selected="selected"{/if} value="16">16</option>
										<option {if $smarty.get.intCountDays==17}selected="selected"{/if} value="17">17</option>
										<option {if $smarty.get.intCountDays==18}selected="selected"{/if} value="18">18</option>
										<option {if $smarty.get.intCountDays==19}selected="selected"{/if} value="19">19</option>
										<option {if $smarty.get.intCountDays==20}selected="selected"{/if} value="20">20</option>
										<option {if $smarty.get.intCountDays==21}selected="selected"{/if} value="21">21</option>
										<option {if $smarty.get.intCountDays==22}selected="selected"{/if} value="22">22</option>
										<option {if $smarty.get.intCountDays==23}selected="selected"{/if} value="23">23</option>
										<option {if $smarty.get.intCountDays==24}selected="selected"{/if} value="24">24</option>
										<option {if $smarty.get.intCountDays==25}selected="selected"{/if} value="25">25</option>
										<option {if $smarty.get.intCountDays==26}selected="selected"{/if} value="26">26</option>
										<option {if $smarty.get.intCountDays==27}selected="selected"{/if} value="27">27</option>
										<option {if $smarty.get.intCountDays==28}selected="selected"{/if} value="28">28</option>
										<option {if $smarty.get.intCountDays==29}selected="selected"{/if} value="29">29</option>
										<option {if $smarty.get.intCountDays==30}selected="selected"{/if} value="30">30</option>
										<option {if $smarty.get.intCountDays==31}selected="selected"{/if} value="31">31</option>
									</select>
								</div>
							</div>
							<div class="form-line">
								<div class="form-col fleft">
									<label for="">К-во человек</label>
									{if $URL != $smarty.const.PROJECT_URL|cat:'seminary'}
									<select name="intCountPeoples">
										<option value=""></option>
										<option {if $smarty.get.intCountPeoples==1}selected="selected"{/if} value="1">1</option>
										<option {if $smarty.get.intCountPeoples==2}selected="selected"{/if} value="2">2</option>
										<option {if $smarty.get.intCountPeoples==3}selected="selected"{/if} value="3">3</option>
										<option {if $smarty.get.intCountPeoples==4}selected="selected"{/if} value="4">4</option>
										<option {if $smarty.get.intCountPeoples==5}selected="selected"{/if} value="5">5</option>
										<option {if $smarty.get.intCountPeoples==='0'}selected="selected"{/if} value="0">другое</option>
									</select>
									{else}
										<input style="width:50px" type="text" name="intCountPeoples" id="intCountPeoples" />
									{/if}
								</div>
								<div class="form-col fright">
									<label for="">Транспорт</label>
									<select name="varTransport">
										<option value=""></option>
										<option {if $smarty.get.varTransport=='plane'}selected="selected"{/if} value="plane">Самолёт</option>
										<option {if $smarty.get.varTransport=='train'}selected="selected"{/if} value="train">Поезд</option>
										<option {if $smarty.get.varTransport=='bus'}selected="selected"{/if} value="bus">Автобус</option>
										<option {if $smarty.get.varTransport=='steamer'}selected="selected"{/if} value="bus">Пароход</option>
									</select>
								</div>
							</div>
							<div align="center">
								<input type="submit" value="Искать" class="search-submit" />&nbsp;&nbsp;&nbsp;&nbsp;
							<!--a onclick="$('form.search-form input[type=\'text\'],form.search-form select').val('')" href="javascript:void(0)">Очистить</a-->
							</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			<div class="side-box">
			{include file="layout/managers.tpl"}
			</div>
			{if $leftlinks && $enableleftlinks}
			<div class="side-box">
				<ul class="boxes-links">
					<li><a href="ittsearch" class="search_ittour"><span>Поиск тура</span></a></li>
					{foreach from=$leftlinks name=link item=item}
					<li><a href="{$item.varLink}" class="{$item.varAliasClass}"><span>{$item.varName}</span></a></li>
					{/foreach}
				</ul>
			
			</div>
			{else}
			<div class="side-box">
				<ul class="boxes-links">
					<li><a href="/tours-country/sale" class="sale"></a></li>
				</ul>
			</div>

			{/if}
			<br />
			<!--iframe src="https://panda-travel.xyz/signup.php" frameborder="0"></iframe-->
				
			<div class="side-box">
				<a href="http://{$bannersZone.varLink1}" class="advert"><img src="{$FILES_URL}{$bannersZone.varBanner1Name}" width="{$bannersZone.intWidth1}" height="{$bannersZone.intHeight1}" alt="" /></a>
			</div>
			<div class="side-box">
				<h3 class="title">Новости</h3>
				<dl class="news">
					{foreach from=$news name=cnews item=item}
						{if $smarty.foreach.cnews.iteration<6}
							<dt>{$item.varDate|date_format:"%d-%m-%Y"}</dt>
							<dd><a href="{$item.link}">{$item.varAnnotation}</a></dd>
						{/if}
					{/foreach}
				</dl>
				<a href="/news" class="wholelink">Читать все новости</a>
			</div>
		</div><!-- end sidebar -->
	</div><!-- end container -->
	<div class="footer">
		<div class="fleft">
			<ul class="footer-menu">
			{foreach from=$menuListParent item=item name=menu}
				<li><a href="{$item.link}">{$item.varTitle}</a></li>
			{/foreach}
			</ul>
			<div class="copyright">
				<p>© 2006-2017 Panda Travel. Все права защищены.</p>
				<p class="develop">Разработка и поддержка - <a href="http://miritec.com">Миритек</a></p>
			</div>
			{if $static_zone.social_zone}
				{include file="static_zone.tpl" zone=$static_zone.social_zone static_zone_path=$static_zone_path template=footer}
			{/if}
		</div>
		<div class="contact">
		{if $static_zone.footer}
			{include file="static_zone.tpl" zone=$static_zone.footer static_zone_path=$static_zone_path template=footer}
		{/if}
		</div>
	</div>
	{if $static_zone.footerSeo}
		{include file="static_zone.tpl" zone=$static_zone.footerSeo static_zone_path=$static_zone_path template=footer}
	{/if}
</div><!--end wrapper-->
</body>
</html>
