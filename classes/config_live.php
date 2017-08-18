<?php
// error reporting
//error_reporting(E_ALL^E_NOTICE);
define('ENABLE_INTERNAL_DEBUG'		, 	false);

// local path & url
define("PROJECT_PATH"				, 	"/var/www/newstravel.com.ua/");
define("PROJECT_URL"				, 	"http://www.newstravel.com.ua/");

// templates path
define('TEMPLATES_PATH'				, 	PROJECT_PATH.'data/templates/');

// cache path
define('PROJECT_CACHE'				, 	PROJECT_PATH.'cache/');

// filestorage settings
define('FILESTORAGE_PATH'			, 	PROJECT_PATH.'filestorage/');
define('FILESTORAGE_URL'			, 	PROJECT_URL.'filestorage/');
define('IMAGES_PATH'				, 	FILESTORAGE_PATH.'images/');
define('IMAGES_URL'					, 	FILESTORAGE_URL.'images/');
define('FILES_PATH'					, 	FILESTORAGE_PATH.'files/');
define('FILES_URL'					, 	FILESTORAGE_URL.'files/');
define('FILES_BG'                   ,   FILESTORAGE_PATH.'bg_site/');
define('FILES_BG_URL'               ,   FILESTORAGE_URL.'bg_site/');

define('FOTO_STAFFS'                ,   FILESTORAGE_PATH.'foto_staffs/');
define('FOTO_STAFFS_URL'            ,   FILESTORAGE_URL.'foto_staffs/');

define('FOTO_CONTACTS'                ,   FILESTORAGE_PATH.'foto_contacts/');
define('FOTO_CONTACTS_URL'            ,   FILESTORAGE_URL.'foto_contacts/');

// mail settings
define('MAIL_TEMPLATES_PATH'		, 	'mail/');
define('PROJECT_FROM_MAIL'			, 	'info@newstravel.com.ua');
define('PROJECT_TO_MAIL'			, 	'info@newstravel.com.ua');
define('SITE_FROM_NAME'				, 	'NewsTravel');



// framework path
define("FRAMEWORK_PATH"				, 	PROJECT_PATH."framework/");

// database connections
define('DB_URI'						, 	'mysql://newsuser:NqwEasTR@localhost/newstravel');
define('DB_MSSQL_URI'				, 	'mssql://spominprice:!@CgjVby@online.newstravel.com.ua/wwwbron');
define('DB_ODBC_URI'				, 	'odbc://spominprice:!@CgjVby@online.newstravel.com.ua/SQLOnLine');




define('LOG_USERS_ACTION', true);
define('LOG_USERS_ACTION_PATH', PROJECT_PATH . 'logs/');
define('LOG_USERS_ACTION_EXT', '.log');

//memcache confif
define('MEMCACHE_HOST'				, 	'localhost');
define('MEMCACHE_PORT'				, 	'11211');
define('MEMCACHE_TIME'				, 	time()+60*60*60);