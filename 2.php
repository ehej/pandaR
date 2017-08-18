<?php
	$link = mysql_connect('localhost', 'root', 'miriteclab');
	if (!$link) {
	    die('Not connected : ' . mysql_error());
	}

	// make foo the current db
	$db_selected = mysql_select_db('evgenij_panda', $link);
	if (!$db_selected) {
	    die ('Can\'t use foo : ' . mysql_error());
	}

	$pp[1][] = 'index';
    $pp[1][] = 'menu';
    $pp[1][] = 'pages';
    $pp[1][] = 'modulespages';
    $pp[1][] = 'news';
    $pp[1][] = 'news_type';
    $pp[1][] = 'menu_countries';
    $pp[1][] = 'menu_subcountries';
    $pp[1][] = 'special_offers';
    $pp[1][] = 'spoeditor';
    $pp[1][] = 'countries_catalog';
    $pp[1][] = 'resorts_catalog';
    $pp[1][] = 'regions_catalog';
    $pp[1][] = 'hotels_catalog';
    $pp[1][] = 'hotels_option';
    $pp[1][] = 'document';
    $pp[1][] = 'document_category';
    $pp[1][] = 'subscribes';
	$pp[1][] = 'messages';
    $pp[1][] = 'departure_cities';
    $pp[1][] = 'promotionstypes';
    $pp[1][] = 'gallerys';
    $pp[1][] = 'banners_zones';
    $pp[1][] = 'banners_right';
    $pp[1][] = 'contests';
    $pp[1][] = 'comments';
    $pp[1][] = 'where_buy';
    $pp[1][] = 'preferences';
    $pp[1][] = 'logging';
    $pp[1][] = 'bottomLinks';
    $pp[1][] = 'users';
    $pp[1][] = 'admins';
    $pp[1][] = 'roles';
    $pp[1][] = 'akcii';
	$pp[1][] = 'static_zone';
	$pp[1][] = 'staffs';
	$pp[1][] = 'promo';
	$pp[1][] = 'promo_hotel';
	$pp[1][] = 'promo_hotel_detail';
	$pp[1][] = 'forms';
	$pp[1][] = 'form_field';
	$pp[1][] = 'excursions';
	$pp[1][] = 'contacts';
	$pp[1][] = 'catalog_menu';
	$pp[1][] = 'attractions';
	$pp[1][] = 'other_info';
	$pp[1][] = 'category_info';
	$pp[1][] = 'ukrainian_area';
	$pp[1][] = 'ukrainian_city';
	$pp[1][] = 'staffs_type';
	$pp[1][] = 'guest_book';
	$pp[1][] = 'settings';
	$pp[1][] = 'tours';
	$pp[1][] = 'tourtypes';
	$pp[1][] = 'placetypes';
	$pp[1][] = 'foodtypes';
	$pp[1][] = 'currencies';
	$pp[1][] = 'currencies_archive';
	$pp[1][] = 'applications';
	$pp[1][] = 'generalgallery';

	
	
	$pp[1][] = 'countries_catalog_adv';
    $pp[1][] = 'resorts_catalog_adv';
    $pp[1][] = 'resorts_content_catalog_adv';
	
	$pp[2][0] =  'index';
    $pp[2][1] =  'pages';
    $pp[2][2] =  'news';
    $pp[2][3] =  'special_offers';
    $pp[2][4] =  'countries_catalog';
    $pp[2][5] =  'hotels_catalog';
    $pp[2][6] =  'promotionstypes';
    $pp[2][7] =  'banners_right';
    $pp[2][8] =  'comments';
    $pp[2][9] =  'preferences';
    $pp[2][10] = 'users';

	$pp[5][0] = 'index';

	$user_update = 1;
	$data = serialize($pp[$user_update]);
	
	$sql = 'UPDATE roles SET varPriveleges=\''.$data.'\' WHERE intRoleID = '.$user_update;
	
	mysql_query($sql);
	echo 'Complite';

?>