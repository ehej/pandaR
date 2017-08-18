<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <title>{$pagetitle|strip_tags|escape} - NEWS TRAVEL</title>
    <meta name="title" content="{$metatitle|escape}" />
    <meta name="description" content="{$metadescription|escape}" />
  	<meta name="keywords" content="{$metakeywords|escape}" />
	{$noindexfollow}
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link type="text/css" rel="stylesheet" href="/css/calendar.css" />
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css" /><![endif]-->
    
    
    <script type="text/javascript">var languageCode = 'ru';</script>
    <script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="/js/jquery.datepick.pack.js"></script>
    <script type="text/javascript" src="/js/jquery.datepick-ru.js"></script>
	<script type="text/javascript" src="/js/calendar.js"></script>
	<script type="text/javascript" src="/js/swfobject.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <link rel="shortcut icon" href="/favicon.ico" type="image/ico"/>
    
</head>
<body class="sidebars">
<div class="wrapper">
	<div class="header">
		<a href="#" class="logo">Panda Travel</a>
		<div class="right-header">
			<div class="exchange">
				<p><strong>$</strong> <a href="#">Курс валют</a> 25-10-2011:</p>
				{foreach from=$currency item=item name=currr}
					<span>{if $smarty.foreach.currr.first}{$item.tdate|date_format:'%d-%m-%Y'}: {/if} 1 {$item.alias_from} = {$item.rate}{$item.alias_to}</span>{if !$smarty.foreach.currr.last} | {/if}
				{/foreach}
			</div>
			<div style="position: absolute; width: 260px;z-index:100;">
				{if $static_zone.head_zone}
					{include file="static_zone.tpl" zone=$static_zone.head_zone static_zone_path=$static_zone_path template=bottom_menu}
				{/if}
			</div>
		</div>
	</div>
{include file="layout/navigation.tpl" menuArr=$menuListParent }


