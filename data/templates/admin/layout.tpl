<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>{$pagetitle}</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta NAME="developer" CONTENT="www.miritec.com" />
	<link type="text/css" rel="stylesheet" href="{$PROJECT_URL}css/admin.css" />
	<link type="text/css" rel="stylesheet" href="{$PROJECT_URL}css/calendar.css" />
	<link type="text/css" rel="stylesheet" href="{$PROJECT_URL}css/files.css" />
	<link type="text/css" rel="stylesheet" href="{$PROJECT_URL}css/lytebox.css" />
	<script type="text/javascript" src="{$PROJECT_URL}js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="{$PROJECT_URL}js/admin.js"></script>
	<script type="text/javascript">var languageCode = 'ru';</script>
	<script type="text/javascript" src="{$PROJECT_URL}js/calendar.js"></script>
	<script type="text/javascript" src="{$PROJECT_URL}js/jquery-ui.js"></script>
	<script type="text/javascript" src="{$PROJECT_URL}js/lytebox.js"></script>
	<script type="text/javascript" src="{$PROJECT_URL}/js/ckeditor/ckeditor.js"></script>
  </head>
  <body>
	<div id="hidescreen"></div>
    <div id="topBarBlue"></div>
    <div id="contentBar">
		<a href="/admin/index.php"><div id="logoBar">PandaTravel</div></a>
        <div id="navBar">
            <!-- /Верхнее меню -->
            <ul id="topMenu">
                <li><a href="{$PROJECT_URL}admin/?event=logout">Выход</a></li>
            </ul>
            <!-- /Верхнее меню -->
        </div>
        <table id="contentTable" cellpadding="0" cellspacing="0">
            <tr>
                <td id="sideBar" valign="top">
                    <!-- Главное меню -->
                    <ul id="mainMenu">      
                    	<li class="cat_name"><div>Главная</div></li>
                        <li class="separator"></li>  
                    	{foreach from=$adminPrivileges item=item}
                    		{if $item=='menu'}<li id="menuMenu"><a href="menu.php">Меню</a></li>{/if}
                    		{if $item=='pages'}<li id="pagesMenu"><a href="pages.php">Страницы</a></li>{/if}
                    		{if $item=='modulespages'}<li id="modulespagesMenu"><a href="modulespages.php">Модульные страницы</a></li>{/if}
                    		{if $item=='news'}<li id="newsMenu"><a href="news.php">Новости</a></li>{/if}
                    		{*{if $item=='menu_countries'}<li id="menuCountriesMenu"><a href="menu_countries.php">Меню стран</a></li>{/if}*}
                    	{/foreach}
                    	<li class="cat_name"><div>Справочники</div></li>
                        <li class="separator"></li>	
                        {foreach from=$adminPrivileges item=item}
                    		{if $item=='countries_catalog'}<li id="countriesCatalogMenu"><a href="countries_catalog.php">Страны</a></li>{/if}
                    		{if $item=='resorts_catalog'}<li id="resortsCatalogMenu"><a href="resorts_catalog.php">Курорты</a></li>{/if}
                    		{*if $item=='regions_catalog'}<li id="regionsCatalogMenu"><a href="regions_catalog.php">Регионы</a></li>{/if*}
                    		{if $item=='hotels_catalog'}<li id="hotelsCatalogMenu"><a href="hotels_catalog.php">Отели</a></li>{/if}
							{if $item=='foodtypes'}<li id="foodtypesMenu"><a href="foodtypes.php">Типы питания</a></li>{/if}
							{if $item=='placetypes'}<li id="placetypesMenu"><a href="placetypes.php">Типы размещения</a></li>{/if}
                    	{/foreach}
						<li class="cat_name"><div>Инфоромация о турах</div></li>
						<li class="separator"></li>
						{foreach from=$adminPrivileges item=item}
							{if $item=='tours'}<li id="toursMenu"><a href="tours.php">Туры</a></li>{/if}
							{if $item=='tourtypes'}<li id="tourtypesMenu"><a href="tourtypes.php">Виды туров</a></li>{/if}
							{if $item=='applications'}<li id="applicationsMenu"><a href="applications.php">Заявки</a></li>{/if}
							{if $item=='applications'}<li id="seminarordersMenu"><a href="seminarorders.php">Семинарские заявки</a></li>{/if}
						{/foreach}
                    	<li class="cat_name"><div>Остальное</div></li>
                        <li class="separator"></li>
                       	{foreach from=$adminPrivileges item=item}
                        	{if $item=='gallerys'}<li id="gallerysMenu"><a href="gallerys.php">Фотогалереи</a></li>{/if}
                        	{if $item=='generalgallery'}<li id="generalgalleryMenu"><a href="generalgallery.php">Слайдер</a></li>{/if}
                        	{if $item=='banners_zones'}<li id="banners_zonesMenu"><a href="banners_zones.php">Баннерные зоны</a></li>{/if}
                        	{if $item=='bottom_links'}<li id="bottomLinksMenu"><a href="bottom_links.php">Сcылки внизу</a></li>{/if}
                        	{if $item=='subscribes'}<li id="subscribesMenu"><a href="subscribes.php">Подписчики</a></li>{/if}
                        	{if $item=='messages'}<li id="messagesMenu"><a href="messages.php">Статьи рассылки</a></li>{/if}
                        	{if $item=='static_zone'}<li id="static_zoneMenu"><a href="static_zone.php">Статические зоны</a></li>{/if}
                        	{if $item=='contacts'}<li id="contactsMenu"><a href="contacts.php">Контакты</a></li>{/if}
                        	{if $item=='currencies'}<li id="currenciesMenu"><a href="currencies.php">Курс валют</a></li>{/if}
                        	{if $item=='links'}<li id="linksMenu"><a href="links.php">Ссылки правого блока</a></li>{/if}
                        {/foreach}
                        <li class="cat_name"><div>Безопасность</div></li>
                        <li class="separator"></li>
                        {foreach from=$adminPrivileges item=item}
                        	{if $item=='staffs_type'}<li id="staffs_typeMenu"><a href="staffs_type.php">Категории сотрудников</a></li>{/if}
                        	{if $item=='staffs'}<li id="staffsMenu"><a href="staffs.php">Сотрудники</a></li>{/if}
                    	{/foreach} 
                    	{if $ADMIN_DATA.intRoleID==SUPER_ADMIN_ROLE}<li id="adminsMenu"><a href="admins.php">Администраторы</a></li>{/if}
                    	{if $ADMIN_DATA.intRoleID==SUPER_ADMIN_ROLE}<li id="usersMenu"><a href="users.php">Пользователи</a></li>{/if}
                        {if $ADMIN_DATA.intRoleID==SUPER_ADMIN_ROLE}<li id="rolesMenu"><a href="roles.php">Роли</a></li>{/if}
                    </ul>
                  
                    <!-- /Главное меню -->
                </td>
                <td id="content" valign="top">
                    <!-- Тело -->
                    <script>$('#{$boldMenu}Menu').addClass('active');</script>
                    {if $messages}
						{foreach from=$messages item=message}
							<div class="message {if $message.error}error{else}inform{/if}">
		                        {$message.msg}
		                    </div>
						{/foreach}
					{/if}
					{include file="$page"}
                    <!-- /Тело -->
                </td>
            </tr>
        </table>
    </div>
{if $messages}
<script>
{foreach from=$hilightFormElements item=rule key=elem}
	HilightElement('#{$elem}');
{/foreach}
</script>
{/if}
<!-- Loaded in {$page_loaded_in} sec -->
	<div class="topBarBlue"></div>
  </body>
</html>
