<?php
function clear_array($arr){
	foreach ($arr as $value) {
		if(trim($value) != ''){
			$ret[] = $value;
		}
	}
	return $ret;
}
$url = $_SERVER['REQUEST_URI'];
if(preg_match("/^\/news\/record([\d]+)/",$url,$match)){
	$_REQUEST['intNewsID'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'news.php';
	
}elseif(preg_match("/^\/news\/?$/",$url)){
	$_SERVER['SCRIPT_NAME'] = 'news_archive.php';
	
}elseif(preg_match("/^\/news\/\?(.*)/",$url,$match)){
	$arr = explode('&',$match[1]);
	foreach ($arr as $value) {
		$vals = explode('=', $value);
		$_REQUEST[$vals[0]] = $vals[1];
	}
	$_SERVER['SCRIPT_NAME'] = 'news_archive.php';
	
}elseif(preg_match("/^\/news\/cat\/(.*)\/\?(.+)/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$arr = explode('&',$match[2]);
	foreach ($arr as $value) {
		$vals = explode('=', $value);
		$_REQUEST[$vals[0]] = $vals[1];
	}
	$_SERVER['SCRIPT_NAME'] = 'category_news.php';
		
}elseif(preg_match("/^\/news\/cat\/(.*)/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'category_news.php';
	
}elseif(preg_match("/^\/spo\/([\d]+)/",$url,$match)){
	$_REQUEST['intCountryID'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'so.php';
	
}elseif(preg_match("/^\/about-country\/(.*)/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'about_country.php';
	
}elseif(preg_match("/^\/cities-country\/(.*)/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'resorts.php';

}elseif(preg_match("/^\/regions-country\/(.*)/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'regions.php';

}elseif(preg_match("/^\/tours-country\/(.*)/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'tours.php';

}elseif(preg_match("/^\/vizas-country\/(.*)/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'vizas.php';

}elseif(preg_match("/^\/hotels-country\/([^\?]*)(.*)/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'hotels.php';
	
}elseif(preg_match("/^\/cities\/(.*)/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'resort.php';
	
}elseif(preg_match("/^\/regions\/(.*)\?(.*)/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$arr = explode('&',$match[2]);
	foreach ($arr as $value) {
		$vals = explode('=', $value);
		$_REQUEST[$vals[0]] = $vals[1];
	}
	$_SERVER['SCRIPT_NAME'] = 'region.php';

}elseif(preg_match("/^\/regions\/(.*)/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'region.php';
	
}elseif(preg_match("/^\/hotels\/(.*)\/gallery/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'hotel_gallery.php';
	
}elseif(preg_match("/^\/hotels\/(.*)/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'hotel.php';
	
}elseif(preg_match("/^\/countries\/(.*)/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'country.php';
	
}elseif(preg_match("/^\/countries\/?$/",$url)){
	$_SERVER['SCRIPT_NAME'] = 'countries.php';
	
}elseif(preg_match("/^\/promo-([\d]+)/",$url,$match)){
	$_REQUEST['intPromoID'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'promoakciya.php';
	
}elseif(preg_match("/^\/guide\//",$url,$match)){
	$arr_vars = explode('/', $url);
	$arr_vars = clear_array($arr_vars);
	switch (count($arr_vars)) {
	    case 2:
	        $_REQUEST['varUrlAlias'] = $arr_vars[1];
	        $_SERVER['SCRIPT_NAME'] = 'adv_country.php';
	        break;
	    case 3:
	        $_REQUEST['varUrlAliasCountry'] = $arr_vars[1];
	        $_REQUEST['varUrlAlias'] = $arr_vars[2];
	        $_SERVER['SCRIPT_NAME'] = 'adv_resort.php';
	        break;
	    case 4:
	        $_REQUEST['varUrlAliasCountry'] = $arr_vars[1];
	        $_REQUEST['varUrlAliasResort'] = $arr_vars[2];
	        $_REQUEST['varUrlAlias'] = $arr_vars[3];
	        $_SERVER['SCRIPT_NAME'] = 'adv_resort_content.php';
	        break;
	}
}elseif(preg_match("/^\/subscribes\/?$/",$url)){
	$_SERVER['SCRIPT_NAME'] = 'subscribes.php';
	
}elseif(preg_match("/^\/subscribes_add\/?$/",$url)){
	$_SERVER['SCRIPT_NAME'] = 'subscribes_add.php';

}elseif(preg_match("/^\/subscribes_add\/(.*)/",$url,$match)){
	$_REQUEST['hash'] = $match[1];
	$_REQUEST['event'] = 'Activate';
	$_SERVER['SCRIPT_NAME'] = 'subscribes_active.php';
	
}elseif(preg_match("/^\/unsubscribes\/?$/",$url)){
	$_SERVER['SCRIPT_NAME'] = 'unsubscribes.php';
	
/*}elseif(preg_match("/^\/feedback\/?$/",$url)){
	$_SERVER['SCRIPT_NAME'] = 'feedback.php';
  */	
}elseif(preg_match("/^\/private-room\/?$/",$url)){
	$_SERVER['SCRIPT_NAME'] = 'private_room.php';
	
}elseif(preg_match("/^\/akciya-(\d+)\/?$/",$url,$match)){
	$_REQUEST['intAkciyID'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'akciya.php';

}elseif(preg_match("/^\/akcii\/?$/",$url)){
	$_SERVER['SCRIPT_NAME'] = 'akcii.php';

}elseif(preg_match("/^\/excursion-(\d+)\/?$/",$url,$match)){
	$_REQUEST['intExcursionID'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'excursion.php';

}elseif(preg_match("/^\/excursions\/(\w+)\/([^\/]+)\/?$/",$url,$match)){
	$_REQUEST['varDestinationType'] = $match[1];
	$_REQUEST['varUrlAlias'] = $match[2];
	if(strlen($_REQUEST['varUrlAlias']) == strlen((int)$_REQUEST['varUrlAlias'])){
		$_REQUEST['intDestinationID'] = (int)$_REQUEST['varUrlAlias'];
		unset($_REQUEST['varUrlAlias']);
	}
	$_SERVER['SCRIPT_NAME'] = 'excursions.php';
	
}elseif(preg_match("/^\/attractions\/(\w+)\/([^\/]+)\/?$/",$url,$match)){
	$_REQUEST['varDestinationType'] = $match[1];
	$_REQUEST['varUrlAlias'] = $match[2];
	if(strlen($_REQUEST['varUrlAlias']) == strlen((int)$_REQUEST['varUrlAlias'])){
		$_REQUEST['intDestinationID'] = (int)$_REQUEST['varUrlAlias'];
		unset($_REQUEST['varUrlAlias']);
	}
	$_SERVER['SCRIPT_NAME'] = 'attractions.php';
	
}elseif(preg_match("/^\/attraction\/([^\/]+)\/?$/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	if(strlen($_REQUEST['varUrlAlias']) == strlen((int)$_REQUEST['varUrlAlias'])){
		$_REQUEST['intAttractionID'] = (int)$_REQUEST['varUrlAlias'];
		unset($_REQUEST['varUrlAlias']);
	}
	$_SERVER['SCRIPT_NAME'] = 'attraction.php';

}elseif(preg_match("/^\/info\/(\w+)\/(\d+)\/?$/",$url,$match)){
	$_REQUEST['varDestinationType'] = $match[1];
	$_REQUEST['intDestinationID'] = $match[2];
	$_SERVER['SCRIPT_NAME'] = 'attractions.php';
	
}elseif(preg_match("/^\/info\/([^\/]+)\/?$/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	if(strlen($_REQUEST['varUrlAlias']) == strlen((int)$_REQUEST['varUrlAlias'])){
		$_REQUEST['intInfoID'] = (int)$_REQUEST['varUrlAlias'];
		unset($_REQUEST['varUrlAlias']);
	}
	$_SERVER['SCRIPT_NAME'] = 'other_info.php';
		
}elseif(preg_match("/^\/documents\/?$/",$url)){
	$_SERVER['SCRIPT_NAME'] = 'document.php';

}elseif(preg_match("/^\/contact\/?$/",$url)){
	$_SERVER['SCRIPT_NAME'] = 'contacts.php';

}elseif(preg_match("/^\/contacts-region\/?$/",$url)){
	$_SERVER['SCRIPT_NAME'] = 'contacts_region.php';

}elseif(preg_match("/^\/guest-book(.*)$/",$url)){
	$_SERVER['SCRIPT_NAME'] = 'guest_book.php';

}elseif(preg_match("/^\/gde-kupit-tour(.*)$/",$url)){
	$_SERVER['SCRIPT_NAME'] = 'where_buy.php';

}elseif(preg_match("/^\/currency-courses(.*)$/",$url)){
	$_SERVER['SCRIPT_NAME'] = 'currency_courses.php';
	
}elseif(preg_match("/^\/([^\/]*)/",$url,$match)){
	$_REQUEST['varUrlAlias'] = $match[1];
	$_SERVER['SCRIPT_NAME'] = 'pages.php';
}
//echo $_SERVER['SCRIPT_NAME'];
//echo $url;
include($_SERVER['SCRIPT_NAME']);



?>