<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<?php
echo('<xmp>');
	error_reporting(E_ALL);
	set_time_limit(0);
     	
    
	// local path & url
	define("PROJECT_PATH"				, 	"/usr/www/svnfolders/dev/newstravel/");
	define("PROJECT_URL"				, 	"http://newstravel.dev.miritec.com/");

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
	
	include('/usr/www/svnfolders/dev/newstravel/classes/unit/image.php');
	$imageManipulate = new Image();
    /*$link = mysql_connect('localhost', 'root', 'miriteclab');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }*/
// OLD
$dbo = new PDO('mysql:dbname=vitek_news_copy;host=127.0.0.1', 'root', 'miriteclab', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
// NEW  ---evgenij_newstr_tmp--
$dbn = new PDO('mysql:dbname=vitek_newstr;host=127.0.0.1', 'root', 'miriteclab', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
	
	

   
   	//$array_countries = array(10099,100680,274385,276875,276878,276882,276887,276888,276889);//276889 276891

   	//insert into base
   	//$sql = "Select * from ntravel_hotels WHERE country_id IN (".implode(',', $array_countries).")" ;
	$q="SELECT * FROM hotels  WHERE intCountryID=276890";
	$sth = $dbn->prepare($q);
	$sth->execute();
	$hotels = $sth->fetchall(PDO::FETCH_ASSOC);

	$q="SELECT * FROM gallerys  ";
	$sth = $dbn->prepare($q);
	$sth->execute();
	$gallerys = $sth->fetchall(PDO::FETCH_ASSOC);

	//print_R($results);
$i=1;
	foreach($hotels as $hotel){
		foreach($gallerys as $gallery){
			if($gallery['varTitle'] == $hotel['varName']) {
				$dbn->exec("UPDATE galleries_to_modules SET intModuleID=".$hotel['intHotelID']." where intGalleryID=".$gallery['intGalleryID']);
//echo "UPDATE galleries_to_modules SET intModuleID=".$hotel['intHotelID']." where intGalleryID=".$gallery['intGalleryID']."; \r\n";
				$i++;
			}

		}
	}
   	  
   	  
   	  echo $i."\r\n";

   
    echo "COMPLITE\r\n";
    
    print_r($dbn->errorInfo());
    
    
echo('</xmp>');    
    
    
    
    



?>
</body>
</html>