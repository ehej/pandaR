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
	$q="SELECT * FROM ntravel_regions AS a LEFT JOIN ntravel_cities AS b ON b.id = city_id WHERE a.`country_id` =276889";
	$sth = $dbo->prepare($q);
	$sth->execute();
	$results = $sth->fetchall(PDO::FETCH_ASSOC);
	//print_R($results);

	foreach($results as $result){
		$dbn->exec("DELETE FROM `resorts` WHERE intResortID=".$result['id']);
		$dbn->exec("DELETE FROM `regions` WHERE intRegionID=".$result['city_id']);

		$dbn->exec("INSERT INTO `resorts` (intResortID, intCountryID, varName, varUrlAlias, varMetaTitle, varMetaKeywords, varMetaDescription, varDescription, varShowComments, isActive, isViewInMenu, isAllwaysOpen)
						VALUES
						('".$result['id']."', '276889', '".$result['name']."', '', '".$result['s_page_title']."', '".$result['s_page_keywords']."', '".$result['s_page_descr']."', '".$result['descr']."', '', '1', '1', '')");

		//$resortid = $dbn->lastInsertId();

		$dbn->exec("INSERT INTO `regions` (intRegionID, intResortID, varName, varUrlAlias, varMetaTitle, varMetaKeywords, varMetaDescription, varDescription, intMTCityID, varShowComments, isActive, isViewInMenu)
						VALUES
						('".$result['city_id']."', '".$result['id']."', '".$result['name']."', '', '".$result['s_page_title']."', '".$result['s_page_keywords']."', '".$result['s_page_descr']."', '".$result['descr']."', '', '', '1', '')");

		$sth = $dbo->prepare("SELECT * FROM ntravel_hotels WHERE city_id =".$result['city_id']);
		$sth->execute();
		$hotels = $sth->fetchall(PDO::FETCH_ASSOC);
		//print_r($hotels);

		foreach($hotels as $v) {
			$dbn->exec("DELETE FROM `hotels` WHERE intHotelID=".$v['id']);

			$sql = "
			INSERT INTO `hotels` (
				`intHotelID` ,
				`intRegionID` ,
				`intCountryID` ,
				`intResortID` ,
				`varName` ,
				`varUrlAlias` ,
				`varLogo` ,
				`varRealLogoName` ,
				`varMetaTitle` ,
				`varMetaKeywords` ,
				`varMetaDescription` ,
				`varDescription` ,
				`intMTHotels` ,
				`varShowComments` ,
				`varCountStars`
			)
			VALUES (
				'".addslashes($v['id'])."',
				'".addslashes($v['region_id'])."',
				'".addslashes($v['country_id'])."',
				'".addslashes($v['city_id'])."',
				'".addslashes($v['name'])."',
				'".addslashes($v['s_url_name'])."',
				'',
				'',
				'".addslashes($v['s_page_title'])."',
				'".addslashes($v['s_page_keywords'])."',
				'".addslashes($v['s_page_descr'])."',
				'".addslashes($v['descr'])."',
				'',
				'".addslashes(($v['enable']==1?'yes':'no'))."',
				'".addslashes($v['category_id'])."'
			);

			";
			//echo"\r\n";
			//continue;
			$dbn->exec($sql);
			$id_hotel = $dbn->lastInsertId();

			$sql2 = 'INSERT INTO gallerys (varTitle, intPreviewWidth, intPreviewHeight,	intCountImgInRow)VALUES("'.addslashes($v['name']).'","64","48","6")';
			$dbn->exec($sql2);
			$id_gallery = $dbn->lastInsertId();
			$sql2 = 'INSERT INTO galleries_to_modules (varModuleName, intModuleID, intGalleryID)VALUES("hotels","'.$id_hotel.'","'.$id_gallery.'")';
			$dbn->exec($sql2);

			$sth = $dbo->prepare('SELECT * FROM ntravel_gallerys WHERE hotel_id='.$v['id'].' ORDER BY ordr') ;
			$sth->execute();
			$rez = $sth->fetchall(PDO::FETCH_ASSOC);
			//print_r($rez);
			$c=1;
			foreach($rez as $row) {
				$img_news = '/usr/www/svnfolders/dev/newstravel/img_newstrav/';
				$file_news = $img_news.$row['img2'];
				$filename = end(explode('/', $row['img2']));
				if(!is_file($file_news)){
					$file_news = $img_news.strtolower($row['img2']);
					if(!is_file($file_news)){
						$tmp = explode('.',$row['img2']);
						$ext = end($tmp);
						unset($tmp[count($tmp)-1]);
						$nf = implode('.',$tmp);
						$file_news = $img_news.strtolower($nf).'.'.$ext;
					}
				}
				$content = file_get_contents($file_news);
				$file_path = '/usr/www/svnfolders/dev/newstravel/filestorage/images/tmp/';

				$file = md5($filename.time().rand(1000, 9999));
				$dir = $file_path.substr($file, 0, 3)."/";
				if ( ! empty($filename)) {
					if ( ! is_dir($dir)){
						if ( ! mkdir($dir, 0777)){
							echo $data['messages'][] = 'Не удалось создать директорию для загрузки файла';
						}else{
							chmod($dir, 0777);
						}
					}

					$filepath = $dir.$file;
					if ( ! isset($data['message']) && ! file_put_contents($filepath, $content)){
						echo $data['messages'][] = 'Ошибка загрузки файла';
					} else {
						$data['intGalleryID'] = $id_gallery;
						$data['varRealFileName'] = $filename;
						$data['fileType'] = substr(mime_content_type($filepath), 0, 5);
						$data['varFileName'] = $file;
						if ($data['fileType'] == 'image') {
							$data['intOrder'] = $c++;
							$dbn->exec('INSERT INTO images
								(intGalleryID ,	varFileName  ,	varRealFileName  ,	intOrder)
								VALUES
								("'.$id_gallery.'","'.$file.'","'.$row['img2'].'","'.$c.'")	');
								$c++;
							//mysql_query($sql);
							$data['messages'][] = 'Изображение успешно загружено';
							// resize image

							$dir_64 = $dir.'64x48/';
							if ( ! is_dir($dir_64)){
								mkdir($dir_64, 0777);
							}
							$imageManipulate->image_resize($dir.$file,$dir_64.$file, 64,48);
							$dir_100 = $dir.'100x80/';
							if ( ! is_dir($dir_100)){
								mkdir($dir_100, 0777);
							}
							$imageManipulate->image_resize($dir.$file,$dir_100.$file, 100,80);
							$dir_145 = $dir.'200x145/';
							if ( ! is_dir($dir_145)){
								mkdir($dir_145, 0777);
							}
							$imageManipulate->image_resize($dir.$file,$dir_145.$file, 200,145);
							$dir_260 = $dir.'260x192/';
							if ( ! is_dir($dir_260)){
								mkdir($dir_260, 0777);
							}
							$imageManipulate->image_resize($dir.$file,$dir_260.$file, 260,192);

						} else {
							unlink ($filepath);
							echo $data['messages'][] = 'Файл не является изображением или видео';
						}
					}
				}
			}
		}
	}
   	  
   	  
   	  
   	  
   
    echo "COMPLITE\r\n";
    
    print_r($dbn->errorInfo());
    
    
echo('</xmp>');    
    
    
    
    



?>
</body>
</html>