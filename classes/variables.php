<?php

require(dirname(__FILE__) . '/config.php');

date_default_timezone_set("Europe/Kiev");

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

define("FRAMEWORK_VERSION"						, 	"1.0");
define("PROJECT_SESSION_NAME"					, 	'miritec');

define('ENABLE_TEMPLATES_CACHE'					, 	false);
define('PROJECT_CHARSET'						, 	'utf-8');
define('SESSION_SAVE_HANDLER'					, 	'php');
define('DEFAULT_ITEMSPERPAGE'					, 	20);
define('DEFAULT_ITEMSONPAGE'					, 	10);
define('DEFAULT_SUPER_ADMIN_ID'					, 	1);
define('SUPER_ADMIN_ROLE'						, 	1);
define('WELCOME_TO_UKRAINE_MENU_ID'				, 	12);
define('HOTELS_IN_UKRAINE_MENU_ID'				, 	64);
define('ABOUT_UKRAINE_MENU_ID'					, 	65);
define('DEFAULT_DATE_FORMAT'					, 	'%d.%m.%y');
define('DEFAULT_DATETIME_FORMAT'				, 	'%Y-%m-%d %H:%M');

// tables
define('DB_TABLE_PREFIX'						, 	'');
define('DB_MSSQL_TABLE_PREFIX'					, 	'dbo.');

define('DB_TABLE_ADMINS'						, 	DB_TABLE_PREFIX.'admins');

define('DB_TABLE_STAFFS_TYPE'					, 	DB_TABLE_PREFIX.'staffs_type');
define('DB_TABLE_STAFFS_RELATION_TYPE'			, 	DB_TABLE_PREFIX.'staffs_relation_type');
define('DB_TABLE_STAFFS'						, 	DB_TABLE_PREFIX.'staffs');
define('DB_TABLE_STAFFS_RELATION_COUNTRY'		, 	DB_TABLE_PREFIX.'staffs_relation_country');
define('DB_TABLE_STAFFS_CONTACT'				, 	DB_TABLE_PREFIX.'staffs_contact');

define('DB_TABLE_CONTACTS'						, 	DB_TABLE_PREFIX.'contacts');
define('DB_TABLE_SETTINGS'						, 	DB_TABLE_PREFIX.'settings');
define('DB_TABLE_CONTACTS_CONTACT'				, 	DB_TABLE_PREFIX.'contacts_contact');
define('DB_TABLE_GENERALGALLERY'				, 	DB_TABLE_PREFIX.'generalgallery');

define('DB_TABLE_PROMO'							, 	DB_TABLE_PREFIX.'promo');
define('DB_TABLE_PROMO_HOTEL'					, 	DB_TABLE_PREFIX.'promo_hotel');
define('DB_TABLE_PROMO_HOTEL_DETAILS'			, 	DB_TABLE_PREFIX.'promo_hotel_details');

define('DB_TABLE_STATIC_ZONE'					, 	DB_TABLE_PREFIX.'static_zone');
define('DB_TABLE_STATIC_ZONE_POSITION'			, 	DB_TABLE_PREFIX.'static_zone_position');

define('DB_TABLE_FORMS'							, 	DB_TABLE_PREFIX.'forms');
define('DB_TABLE_FORM_FIEDS'					, 	DB_TABLE_PREFIX.'form_fields');

define('DB_TABLE_DOCUMENT'						, 	DB_TABLE_PREFIX.'document');
define('DB_TABLE_DOCUMENT_CATEGORY'				, 	DB_TABLE_PREFIX.'document_category');

define('DB_TABLE_PAGES'							, 	DB_TABLE_PREFIX.'pages');
define('DB_TABLE_MODULES_PAGES'					, 	DB_TABLE_PREFIX.'modules_pages');
define('DB_TABLE_MENU'							, 	DB_TABLE_PREFIX.'menu');
define('DB_TABLE_MENU_COUNTRIES'				, 	DB_TABLE_PREFIX.'menuCountries');
define('DB_TABLE_CATALOG_MENU'					, 	DB_TABLE_PREFIX.'catalog_menu');
define('DB_TABLE_TOURS'							, 	DB_TABLE_PREFIX.'tours');
define('DB_TABLE_TOURTYPES'						, 	DB_TABLE_PREFIX.'tourtypes');
define('DB_TABLE_CONTINENTTYPES'				, 	DB_TABLE_PREFIX.'continenttypes');
define('DB_TABLE_COUNTRIES'						, 	DB_TABLE_PREFIX.'countries');
define('DB_TABLE_RESORTS'						, 	DB_TABLE_PREFIX.'resorts');
define('DB_TABLE_FOODTYPES'						, 	DB_TABLE_PREFIX.'foodtypes');
define('DB_TABLE_PLACETYPES'					, 	DB_TABLE_PREFIX.'placetypes');
define('DB_TABLE_CURRENCIES'					, 	DB_TABLE_PREFIX.'currencies');
define('DB_TABLE_CURRENCIES_ARCHIVE'			, 	DB_TABLE_PREFIX.'currencies_archive');
define('DB_TABLE_REGIONS'						, 	DB_TABLE_PREFIX.'regions');
define('DB_TABLE_HOTELS'						, 	DB_TABLE_PREFIX.'hotels');
define('DB_TABLE_ATTRACTIONS'					, 	DB_TABLE_PREFIX.'attractions');
define('DB_TABLE_OTHER_INFO'					, 	DB_TABLE_PREFIX.'other_info');
define('DB_TABLE_CATEGORY_INFO'					, 	DB_TABLE_PREFIX.'category_info');
define('DB_TABLE_TOURS_COUNTRIES'				, 	DB_TABLE_PREFIX.'tour_to_country');
define('DB_TABLE_TOURS_RESORTS'					, 	DB_TABLE_PREFIX.'tour_to_resorts');
define('DB_TABLE_TOURS_HOTELS'					, 	DB_TABLE_PREFIX.'tour_to_hotel');
define('DB_TABLE_TOURS_TYPES'					, 	DB_TABLE_PREFIX.'tour_to_tourtypes');
define('DB_TABLE_TOURS_TRANSPORT'				, 	DB_TABLE_PREFIX.'tour_to_transport');
define('DB_TABLE_TOURS_PLACEMENT'				, 	DB_TABLE_PREFIX.'tour_to_placement');
define('DB_TABLE_TOURS_FOODTYPES'				, 	DB_TABLE_PREFIX.'tour_to_foodtypes');
define('DB_TABLE_TOURS_COUNTPEOPLES'			, 	DB_TABLE_PREFIX.'tour_to_countpeoples');

define('DB_TABLE_UKRAINE_AREA'					, 	DB_TABLE_PREFIX.'ukraine_area');
define('DB_TABLE_UKRAINE_CITY'					, 	DB_TABLE_PREFIX.'ukraine_city');

define('DB_TABLE_GUEST_BOOK'					, 	DB_TABLE_PREFIX.'guest_book');

define('DB_TABLE_HOTEL_OPTIONS'					, 	DB_TABLE_PREFIX.'hotel_options');
define('DB_TABLE_HOTEL_OPTIONS_RELATION'		, 	DB_TABLE_PREFIX.'hotel_options_relation');

define('DB_TABLE_EXCURSIONS'					, 	DB_TABLE_PREFIX.'excursions');
define('DB_TABLE_EXCURSIONS_RELATION'  			, 	DB_TABLE_PREFIX.'excursions_relation');

define('DB_TABLE_LINKS'  						, 	DB_TABLE_PREFIX.'links');

define('DB_TABLE_HOTELS_TYPES'					, 	DB_TABLE_PREFIX.'hoteltypes');
define('DB_TABLE_USERS'							, 	DB_TABLE_PREFIX.'users');
define('DB_TABLE_SUBSCRIBES'					, 	DB_TABLE_PREFIX.'subscribes');
define('DB_TABLE_MESSAGES'						, 	DB_TABLE_PREFIX.'messages');
define('DB_TABLE_APPLICATIONS'					, 	DB_TABLE_PREFIX.'applications');

define('DB_TABLE_CONTESTS'						, 	DB_TABLE_PREFIX.'contests');
define('DB_TABLE_PAGES_TO_COUNTRIES'			, 	DB_TABLE_PREFIX.'pages_to_countries');
define('DB_TABLE_GALLERYS'						, 	DB_TABLE_PREFIX.'gallerys');
define('DB_TABLE_BANNERS_MAIN'					, 	DB_TABLE_PREFIX.'banners_main');
define('DB_TABLE_IMAGES'						, 	DB_TABLE_PREFIX.'images');
define('DB_TABLE_NEWS'							, 	DB_TABLE_PREFIX.'news');
define('DB_TABLE_NEWS_TYPE'						, 	DB_TABLE_PREFIX.'news_type');
define('DB_TABLE_AKCII'							, 	DB_TABLE_PREFIX.'akcii');
define('DB_TABLE_SPO_PREFERENCES'				, 	DB_TABLE_PREFIX.'spo_preferences');
define('DB_TABLE_PREFERENCES'					, 	DB_TABLE_PREFIX.'preferences');
define('DB_TABLE_ROLES'							, 	DB_TABLE_PREFIX.'roles');
define('DB_TABLE_ROLES_PRIVILEGES'				, 	DB_TABLE_PREFIX.'roles_privileges');
define('DB_TABLE_PROMOTIONS_TYPES'				, 	DB_TABLE_PREFIX.'promotions_types');
define('DB_TABLE_COMMENTS'						, 	DB_TABLE_PREFIX.'comments');
define('DB_TABLE_QUESTIONS'						, 	DB_TABLE_PREFIX.'questions');
define('DB_TABLE_ANSWERS'						, 	DB_TABLE_PREFIX.'answers');
define('DB_TABLE_ORDERS'						, 	DB_TABLE_PREFIX.'orders');
define('DB_TABLE_SEMINARS'						, 	DB_TABLE_PREFIX.'seminar_orders');
define('DB_TABLE_GALLERIES_TO_MODULES'			, 	DB_TABLE_PREFIX.'galleries_to_modules');
define('DB_TABLE_BANNERS_TO_MODULES'			, 	DB_TABLE_PREFIX.'banners_to_modules');
define('DB_TABLE_DEPARTURE_CITIES'				, 	DB_TABLE_PREFIX.'departure_cities');
define('DB_TABLE_SPO_EDITOR'					, 	DB_TABLE_PREFIX.'spo_editor');
define('DB_TABLE_SPECIAL_OFFERS'				, 	DB_TABLE_PREFIX.'special_offers');
define('DB_TABLE_BANNERS_RIGHT'					, 	DB_TABLE_PREFIX.'banners_right');
define('DB_TABLE_WHERE_BUY'						, 	DB_TABLE_PREFIX.'where_buy');
define('DB_TABLE_COUNTRIES_TO_WHERE_BUY'		, 	DB_TABLE_PREFIX.'countries_to_where_buy');
define('DB_TABLE_BOTTOM_LINKS'					, 	DB_TABLE_PREFIX.'bottom_links');
define('DB_TABLE_AGENCIES'						, 	DB_TABLE_PREFIX.'agencies');
define('DB_TABLE_HOTELS_SERVICES_GROUPS'		, 	DB_TABLE_PREFIX.'hotels_services_groups');
define('DB_TABLE_HOTELS_SERVICES_PARAMS'		, 	DB_TABLE_PREFIX.'hotels_services_params');
define('DB_TABLE_HOTELS_SERVICES_PARAMS_VALUES'	, 	DB_TABLE_PREFIX.'hotels_services_params_values');

define('DB_TABLE_ADV_COUNTRIES'					, 	DB_TABLE_PREFIX.'adv_countries');
define('DB_TABLE_ADV_RESORTS'					, 	DB_TABLE_PREFIX.'adv_resorts');
define('DB_TABLE_ADV_RESORTS_CONTENT'			, 	DB_TABLE_PREFIX.'adv_resorts_content');

include_once(FRAMEWORK_PATH.FRAMEWORK_VERSION."/system/kernel.php");
