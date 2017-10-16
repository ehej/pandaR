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
    $link = mysql_connect('localhost', 'root', 'miriteclab');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    @mysql_select_db("vitek_newstr") or die("Could not select company database!");
    mysql_query("set names 'UTF8'") ;
	function reload_file($file, $file_path = '/usr/www/svnfolders/dev/newstravel/filestorage/images/'){
		
		$row['img2'] = $file;
		
		$img_news = '/usr/www/svnfolders/dev/newstravel/';
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
		if(!$content = file_get_contents($file_news)){
			return false;
		}
		$ext = end(explode('.',$filename));
		
		
		$file = md5($filename.time().rand(1000, 9999)).'.'.$ext;
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
				return false;
			}else{
				return $file;
			} 
		}	
	}
	
	
	//resize image
	/*
	$file_path = '/usr/www/svnfolders/dev/newstravel/filestorage/images/';
	$d = dir($file_path);
	while (false !== ($entry = $d->read())) {
		if($entry == '.' || $entry == '..') continue;
		
		$dir_read = $file_path.$entry;
		if(is_dir($dir_read)){
			$d2 = dir($dir_read);
			while (false !== ($files = $d2->read())) {
				if(!is_dir($dir_read.'/'.$files)){
					$dir_260 = $dir_read.'/'.'260x192/';
					if ( ! is_dir($dir_260)){
						mkdir($dir_260, 0777);
					}
					$imageManipulate->image_resize($dir_read.'/'.$files,$dir_260.$files, 260,192);
				}
			}
			$d2->close();
		}
	}
	$d->close();*/

	
	

	
	
	
	
	
	
	/*
	$sql = "Select * FROM document" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
	    $data['document'][] = $row;
	}
	foreach($data['document'] as $k => $v){

		$file_path_new = '/usr/www/svnfolders/dev/newstravel/filestorage/files/';
		$file_path = '/usr/www/svnfolders/dev/newstravel/';

		
		$data_name = end(explode('/',$v['varFileName']));
		$ext = end(explode('.',$data_name));
		
		if(!file_exists($file_path.$v['varFileName'])){echo $file_path.$v['varFileName']."\r\n" ; continue;}

		$file_name = md5(time().$data_name).'.'.$ext;
						
		$dir = $file_path_new.substr($file_name, 0, 3)."/";
		
		if ( ! is_dir($dir)){
			if ( ! mkdir($dir, 0777)){
				echo $data['messages'][] = 'Не удалось создать директорию для загрузки файла';
			}else{
				chmod($dir, 0777);
			}
		}
		
		copy($file_path.$v['varFileName'], $dir.$file_name);
		chmod($dir.$file_name, 0777);
		$data['varFileNameReal'] = $data_name;	
		$data['varFileName'] = $file_name;
		$data['varFile'] = $ext;
		
		
		
		
		echo $sql3 = 'UPDATE document SET 
					varFile = \''.addslashes($data['varFile']).'\' ,	
					varFileName = \''.addslashes($data['varFileName'] = $file_name).'\', 	
					varFileNameReal = \''.addslashes($data['varFileNameReal']).'\' 	
				WHERE intDocumentID='.$v['intDocumentID'];
		mysql_query($sql3);
	}*/
	
	
	
	
	/* // перенос описания картинок отелей
	$sql = "Select * from galleries_to_modules WHERE varModuleName = 'hotels'" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
	    $data[] = $row['intGalleryID'];
	    $rel_data[$row['intGalleryID']] = $row['intModuleID'];
	}
	
	$sql = "Select * from gallerys WHERE intGalleryID IN (".implode(',',$data).")" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
	    $data['gallery'][] = $row;
	}
	$c=0;
	foreach($data['gallery'] as $v){	
		
		$sql = 'SELECT * FROM images WHERE intGalleryID='.$v['intGalleryID'].' ORDER BY intOrder' ;
		$rez = mysql_query($sql);
		
		while ($row = mysql_fetch_assoc($rez)) {
			
		 	$sql2 = 'SELECT * FROM newstravel_hotels_gallery WHERE hotel_id = '.$rel_data[$row['intGalleryID']].' and img2 LIKE \'%'.addslashes($row['varRealFileName']).'%\'' ;
		 	$rez2 = mysql_query($sql2);
		 	$cou = mysql_num_rows($rez2);
		 	if($cou != 1){
		 		$c++;
				echo $sql2."\r\n";
			 	if($cou == 0){
					echo $cou.' - '.$c.' - '.$row['intImageID'].'  '.$row['varRealFileName']." \r\n";
			 	}else{
			 		while ($row2 = mysql_fetch_assoc($rez2)) {
						echo $row['intImageID'].'###'.$cou.' - '.$c.' - gal- '.$v['intGalleryID'].' hot_'.$rel_data[$row['intGalleryID']].' hotl_news- '.$row2['hotel_id'].' '.$row2['id'].'  '.$row2['name']." \r\n";
					}
			 	}	
		 	}else{
		 		$row2 = mysql_fetch_assoc($rez2);
				$sql3 = 'UPDATE images SET varTitle = \''.addslashes($row2['name']).'\' WHERE intImageID='.$row['intImageID'];
				mysql_query($sql3);
		 	}
		}	
	}
	*/
	
	
	/*
	$sql = "Select * from adv_res_b" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
		echo $sql2 = "UPDATE adv_resorts SET intTypeBlock = ".$row['b_visible']." WHERE intResortID = ".$row['id'];
		mysql_query($sql2);
	} */	
	
  /*  
	$sql = "Select * from adv_countries WHERE varImage<>'' OR 	varImageFlag<>'' OR varImageMap<>''" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
		$add = array();
		if($row['varImage'] != ''){
			$varImage = reload_file($row['varImage'], $file_path = '/usr/www/svnfolders/dev/newstravel/filestorage/files/');
			$add[] = "varImage = '$varImage'";
	 	}	
	 	if($row['varImageFlag'] != ''){
			$varImageFlag = reload_file($row['varImageFlag'], $file_path = '/usr/www/svnfolders/dev/newstravel/filestorage/files/');
			$add[] = "varImageFlag = '$varImageFlag'";
	 	}
	 	if($row['varImageMap'] != ''){
			$varImageMap = reload_file($row['varImageMap'], $file_path = '/usr/www/svnfolders/dev/newstravel/filestorage/files/');
			$add[] = "varImageMap = '$varImageMap'";
	 	}
	 	$ads = implode(', ', $add);
	 	if(!empty($ads)){
			echo $sql2 = "UPDATE adv_countries SET $ads WHERE intCountryID = ".$row['intCountryID'];
			mysql_query($sql2);
	 	}
	}	
*/
   

	
   
   
   /* 
   	// resize image
   
	$pp = "/usr/www/svnfolders/dev/newstravel/filestorage/images/";
	$d = dir($pp);
	while (false !== ($entry = $d->read())) {
		if(is_dir($pp.$entry) && $entry != '.' && $entry != '..'){
			//echo ($pp.$entry);
			$ds = dir($pp.$entry);
			while (false !== ($entry2 = $ds->read())) {
				if(is_file($pp.$entry.'/'.$entry2) && $entry2 != '.' && $entry2 != '..'){
					$dir_200 = $pp.$entry.'/200x145/';
					if ( ! is_dir($dir_200)){
						echo"create ".$dir_200."
						";
						mkdir($dir_200, 0777);
					}
					echo"file ".$pp.$entry.'/'.$entry2." to file ".$dir_200.$entry2."
					";
					$imageManipulate->image_resize($pp.$entry.'/'.$entry2,$dir_200.$entry2, 200,145);
					//break;
				}
			}
			//break;
		}
	}
	$d->close();

  
*/

  
 /* 
    
    
    die();
    $sql = 'TRUNCATE TABLE `pages` ';
    mysql_query($sql);
    $sql = 'TRUNCATE TABLE `pages_to_countries` ';
    mysql_query($sql);
    $sql = "Select * from newstravel_menus" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
	    $data['newstravel_menus'][] = $row;
	}
	foreach($data['newstravel_menus'] as $v){
		$cont = '';
		$sq = "Select * from newstravel_contentts WHERE struct_node_id=".$v['id'] ;
		$re = mysql_query($sq);
		while ($ro = mysql_fetch_assoc($re)) {
		    $cont .= $ro['s_data'];
		}
		
		$sql = "
		INSERT INTO `pages` (
			`intPageID` ,
			`varUrlAlias`,
			`varTitle` ,
			`varAnnotation` ,
			`varDescription` ,
			`varMetaTitle` ,
			`varMetaKeywords` ,
			`varMetaDescription` ,
			`intContestID` ,
			`intActive` ,
			`intOnlyAuthorized` ,
			`varShowComments`
		)
		VALUES (
			'null',
			'".addslashes($v['s_url'])."', 
			'".addslashes($v['s_name'])."', 
			'', 
			'".addslashes($cont)."', 
			'".addslashes($v['s_title'])."', 
			'".addslashes($v['s_keywords'])."', 
			'".addslashes($v['s_description'])."', 
			'', 
			'".addslashes(($v['b_enable']==1?'1':'0'))."', 
			'0',
			'no'
		);

		";
		mysql_query($sql);
		$id_news_type = mysql_insert_id();
		$relation_news_type[$v['id']] = $id_news_type;
	}
    

    $sql = 'TRUNCATE TABLE `news_type` ';
	mysql_query($sql);
	$sql = 'TRUNCATE TABLE `news` ';
	mysql_query($sql);
    
    $sql = "Select * from newstravel_type" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
	    $data['new_news_type'][] = $row;
	}
	foreach($data['new_news_type'] as $v){
		$sql = 'INSERT INTO news_type (intNewsTypeID,varNameType,varUrlAlias,intOrdering,isActive )
		VALUES(null, \''.addslashes($v['s_name']).'\', \''.addslashes($v['s_url']).'\', \''.addslashes($v['i_order']).'\', \''.addslashes(($v['b_enable']==1?'Yes':'No')).'\')';
		mysql_query($sql);
		$id_news_type = mysql_insert_id();
		$relation_news_type[$v['id']] = $id_news_type;
	}
	
	$sql = "Select * from newstravel_news" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
	    $data['new_news'][] = $row;
	}
	foreach($data['new_news'] as $v){
		$sql = "
		
		INSERT INTO news (
		intNewsID,
		intNewsTypeID,
		varTitle,
		varAnnotation,
		varDescription,
		varMetaTitle,
		varMetaKeywords,
		varMetaDescription,
		intContestID,
		intActive,
		intOnlyAuthorized,
		varDate,
		varShowComments
		)VALUES(
		".$v['id'].", 
		'".$relation_news_type[$v['category_id']]."',
		'".addslashes($v['s_title'])."',
		'".addslashes($v['s_announce'])."',
		'".addslashes($v['s_content'])."',
		'".addslashes($v['s_page_title'])."',
		'".addslashes($v['s_page_descr'])."',
		'".addslashes($v['s_page_keywords'])."',
		'',
		'1',
		'0',
		'".$v['d_date'].' '.$v['d_time']."',
		'No')";
		mysql_query($sql);
		$id_news = mysql_insert_id();
		$relation_news[$v['id']] = $id_news;
	}
    */
   /* work !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!  */   
   
   
   	$array_countries = array(/*10099,100680,274385,276875,276878,276882,276887,276888,276891,276889*/276890);//276889 276891
  /* 	
   	$sql = "SELECT * FROM hotels WHERE intCountryID IN (".implode(',', $array_countries).")";

    $rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
		$ids_hotel_delete[] = $row['intHotelID'] ;   
	}
   	//print_R($ids_hotel_delete);
   	$sql = "SELECT intGalleryID  FROM `gallerys` WHERE `intGalleryID` IN (SELECT intGalleryID  FROM `galleries_to_modules` WHERE `varModuleName` LIKE 'hotels' AND intModuleID IN(".implode(',',$ids_hotel_delete)."))";
   	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
		$ids_gallery_delete[] = $row['intGalleryID'] ;   
	}
   	
   	$sql = "SELECT * FROM `images` WHERE `intGalleryID` IN (".implode(',', $ids_gallery_delete).")";

    $rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
		
	    $data['deleteimage'][] = $row;
	    $dir = '/www/svnfolders/dev/newstravel/filestorage/images/'.substr($row['varFileName'], 0, 3).'/';
	    $file_d = $row['varFileName'];
	    if ($handle = opendir($dir)) {
		    while (false !== ($file = readdir($handle))) {
		        if(is_dir($dir.$file) && $file != '.' && $file != '..'){
		        	if (file_exists($dir.$file.'/'.$file_d)){
		        		unlink($dir.$file.'/'.$file_d);
					}
				}
		    }
		    closedir($handle);
		}
		if (file_exists($dir.$file_d)){
		    unlink($dir.$file_d);
		}
		
	}
	
	echo $sql = "DELETE FROM `images` WHERE `intGalleryID` IN (SELECT intGalleryID  FROM `gallerys` WHERE `intGalleryID` IN (".implode(',',$ids_gallery_delete).")) ";
    $rez = mysql_query($sql);
    echo $sql = "DELETE FROM `gallerys` WHERE `intGalleryID` IN (".implode(',',$ids_gallery_delete).")";
    $rez = mysql_query($sql);
    echo $sql = "delete FROM `galleries_to_modules` WHERE `varModuleName` LIKE 'hotels' AND `intModuleID` IN (".implode(',',$ids_gallery_delete).") ";
    $rez = mysql_query($sql);
    echo $sql = "DELETE FROM hotels WHERE intCountryID IN (".implode(',', $array_countries).")";
    $rez = mysql_query($sql);
    echo $sql = "DELETE FROM hotel_options_relation WHERE intHotelID IN (".implode(',', $ids_hotel_delete).")";
    $rez = mysql_query($sql);
   	 */  	
/*   	  
delete FROM `hotel_options_relation` WHERE intHotelID IN(select intHotelID from hotels WHERE intCountryID in(10099,100680,274385,276875,276878,276882,276887,276888,276889));

insert 
	into 
		`hotel_options_relation` 
		(intHotelID, intResortID, intOptionID)
		select hotel_id, city_id, option_id 
			from ntravel_hotels_options_link
			WHERE hotel_id IN (select intHotelID from hotels WHERE intCountryID in(10099,100680,274385,276875,276878,276882,276887,276888,276889))
*/   	  
   	//insert into base
   	$sql = "Select * from ntravel_hotels WHERE country_id IN (".implode(',', $array_countries).")" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
	    $data['new_hotels'][] = $row;
	}

	foreach($data['new_hotels'] as $v){
		//print_R($v);
		
		/*
		echo $v['country_id']." - country\r\n";
		echo ($v['category']?$v['category']:'Новый курорт').' # '.$v['category']." - chto\r\n";
		print_r($resort_new_resort[$v['country_id']]);
		echo $resort_new_resort[$v['country_id']][($v['category']?$v['category']:'Новый курорт')]." - resort\r\n";
		*/
		$sql = "
		DELETE FROM `hotels` WHERE `intHotelID`='".$v['id']."'; 
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
		echo $sql;
		//echo"\r\n";
		continue;
		mysql_query($sql);
		$id_hotel = mysql_insert_id();
		
		$sql2 = 'INSERT INTO gallerys (varTitle, intPreviewWidth, intPreviewHeight,	intCountImgInRow)VALUES("'.addslashes($v['name']).'","64","48","6")';
		mysql_query($sql2);
		$id_gallery = mysql_insert_id();
		$sql2 = 'INSERT INTO galleries_to_modules (varModuleName, intModuleID, intGalleryID)VALUES("hotels","'.$id_hotel.'","'.$id_gallery.'")';
		mysql_query($sql2);
		
		$sql = 'SELECT * FROM ntravel_gallerys WHERE hotel_id='.$v['id'].' ORDER BY ordr' ;
		$rez = mysql_query($sql);
		$c=1;
		while ($row = mysql_fetch_assoc($rez)) {
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
			$file_path = '/usr/www/svnfolders/dev/newstravel/filestorage/images/';
			
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
						$sql = 'INSERT INTO images 
							(intGalleryID ,	varFileName  ,	varRealFileName  ,	intOrder)
							VALUES
							("'.$id_gallery.'","'.$file.'","'.$row['img2'].'","'.$c.'")	';
							$c++;
						mysql_query($sql);
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
   	  
   print_r(mysql_error());
   	  
   
    echo "COMPLITE";
    
die();
   
    $sql = "SELECT * FROM `images` WHERE `intGalleryID` IN (SELECT intGalleryID  FROM `gallerys` WHERE `intGalleryID` IN (SELECT intGalleryID  FROM `galleries_to_modules` WHERE `varModuleName` LIKE 'hotels'))";

    $rez = mysql_query($sql);/*
	while ($row = mysql_fetch_assoc($rez)) {
	    $data['deleteimage'][] = $row;
	    $dir = '/www/svnfolders/dev/mibstour/filestorage/images/'.substr($row['varFileName'], 0, 3).'/';
	    $file_d = $row['varFileName'];
	    if ($handle = opendir($dir)) {
		    while (false !== ($file = readdir($handle))) {
		        if(is_dir($dir.$file) && $file != '.' && $file != '..'){
		        	if (file_exists($dir.$file.'/'.$file_d)){
		        		unlink($dir.$file.'/'.$file_d);
					}
				}
		    }
		    closedir($handle);
		}
		if (file_exists($dir.$file_d)){
		    unlink($dir.$file_d);
		}
	}*/
	
	
	
	
	
	
	
	
    $sql = "DELETE FROM `images` WHERE `intGalleryID` IN (SELECT intGalleryID  FROM `gallerys` WHERE `intGalleryID` IN (SELECT intGalleryID  FROM `galleries_to_modules` WHERE `varModuleName` LIKE 'hotels')) ";
    $rez = mysql_query($sql);
    $sql = "DELETE FROM `gallerys` WHERE `intGalleryID` IN (SELECT intGalleryID  FROM `galleries_to_modules` WHERE `varModuleName` LIKE 'hotels')";
    $rez = mysql_query($sql);
    $sql = "delete FROM `galleries_to_modules` WHERE `varModuleName` LIKE 'hotels' ";
    $rez = mysql_query($sql);
    
    
    //подмена стран
    $sql = 'TRUNCATE TABLE `countries` ';
    $rez = mysql_query($sql);
    $sql = "Select * from newstravel_countries" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
	    $data['new_countries'][] = $row;
	}
	
	foreach($data['new_countries'] as $v){
		$sql = "
			INSERT INTO countries (
				`intCountryID` ,
				`varName` ,
				`varUrlAlias` ,
				`varMetaTitle` ,
				`varMetaKeywords` ,
				`varMetaDescription` ,
				`varDescription` ,
				`varDescriptionCountry` ,
				`varFlag` ,
				`varRealFlagName` ,
				`intMTCountryID` ,
				`varShowComments`
			)VALUES(
				'".$v['id']."',
				'".addslashes($v['name'])."',
				'".addslashes($v['s_url_name'])."',
				'".addslashes($v['s_page_title'])."',
				'".addslashes($v['s_page_keywords'])."',
				'".addslashes($v['s_page_descr'])."',
				'".addslashes($v['descr'])."',
				'".addslashes($v['descr'])."',
				'".addslashes($v['img'])."',
				'',
				'',
				'".addslashes(($v['enable']==1?'yes':'no'))."'
			)";
		mysql_query($sql);
		$id_country = mysql_insert_id();
		$country_new_country[$v['id']]=$id_country; // какой id на какой поменялся
	}
	
 
	//очистка resort
	$sql = 'TRUNCATE TABLE `resorts` ';
	mysql_query($sql);	
	$sql = "Select * FROM newstravel_resorts" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
	    $data['new_resort'][] = $row;
	}
	foreach($data['new_resort'] as $k => $v){
		$sql = "
		INSERT INTO `resorts` (
			`intResortID` ,
			`intCountryID` ,
			`varName` ,
			`varUrlAlias` ,
			`varMetaTitle` ,
			`varMetaKeywords` ,
			`varMetaDescription` ,
			`varDescription` ,
			`varShowComments`
		) VALUES (
			'".addslashes($v['id'])."', 
			'".addslashes($v['country_id'])."',
			'".addslashes($v['name'])."', 
			'".addslashes($v['s_url_name'])."', 
			'".addslashes($v['s_page_title'])."', 
			'".addslashes($v['s_page_keywords'])."', 
			'".addslashes($v['s_page_descr'])."', 
			'".addslashes($v['descr'])."', 
			'".addslashes(($v['enable']==1?'yes':'no'))."'
		);";
		mysql_query($sql);
		$id_resort = mysql_insert_id();
		$resort_new_resort[$v['id']]=$id_resort; // какой id на какой поменялся
	}
	
	$sql = 'TRUNCATE TABLE `regions` ';
	mysql_query($sql);
	$sql = "Select * from newstravel_regions" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
	    $data['new_region'][] = $row;
	}
		
	foreach($data['new_region'] as $v){
		$sql = "
		INSERT INTO `regions` (
			`intRegionID` ,
			`intResortID` ,
			`varName` ,
			`varUrlAlias` ,
			`varMetaTitle` ,
			`varMetaKeywords` ,
			`varMetaDescription` ,
			`varDescription` ,
			`intMTCityID` ,
			`varShowComments`
		)
		VALUES (
			'".addslashes($v['id'])."', 
			'".addslashes($v['city_id'])."', 
			'".addslashes($v['s_name'])."', 
			'".addslashes($v['s_url_name'])."', 
			'".addslashes($v['s_page_title'])."', 
			'".addslashes($v['s_page_keywords'])."', 
			'".addslashes($v['s_page_descr'])."', 
			'".addslashes($v['s_content'])."', 
			'', 
			'".addslashes(($v['b_enable']==1?'yes':'no'))."'
		);";
		mysql_query($sql);
		$id_region = mysql_insert_id();
		$region_new_region[$v['id']]=$id_region; // какой id на какой поменялся	
	}



			
	$sql = 'TRUNCATE TABLE `hotels` ';
	mysql_query($sql);
	$sql = "Select * from newstravel_hotels" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
	    $data['new_hotels'][] = $row;
	}
	foreach($data['new_hotels'] as $v){
		/*
		echo $v['country_id']." - country\r\n";
		echo ($v['category']?$v['category']:'Новый курорт').' # '.$v['category']." - chto\r\n";
		print_r($resort_new_resort[$v['country_id']]);
		echo $resort_new_resort[$v['country_id']][($v['category']?$v['category']:'Новый курорт')]." - resort\r\n";
		*/
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
			`intCountStars`
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
		mysql_query($sql);
		$id_hotel = mysql_insert_id();
		
		$sql2 = 'INSERT INTO gallerys (varTitle, intPreviewWidth, intPreviewHeight,	intCountImgInRow)VALUES("'.$v['name'].'","64","48","6")';
		mysql_query($sql2);
		$id_gallery = mysql_insert_id();
		$sql2 = 'INSERT INTO galleries_to_modules (varModuleName, intModuleID, intGalleryID)VALUES("hotels","'.$id_hotel.'","'.$id_gallery.'")';
		mysql_query($sql2);
		
		$sql = 'SELECT * FROM newstravel_hotels_gallery WHERE hotel_id='.$v['id'].' ORDER BY ordr' ;
		$rez = mysql_query($sql);
		$c=1;
		while ($row = mysql_fetch_assoc($rez)) {
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
			$file_path = '/usr/www/svnfolders/dev/newstravel/filestorage/images/';
			
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
						$sql = 'INSERT INTO images 
							(intGalleryID ,	varFileName  ,	varRealFileName  ,	intOrder)
							VALUES
							("'.$id_gallery.'","'.$file.'","'.$row['img2'].'","'.$c.'")	';
							$c++;
						mysql_query($sql);
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
					} else {
						unlink ($filepath);
						echo $data['messages'][] = 'Файл не является изображением или видео';
					}
				}
			}
		}	
	}
	$sql = 'TRUNCATE TABLE `countries_to_where_buy` ';
	mysql_query($sql);
	$sql = "Select * from countries" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
	    $data['countries2'][] = $row;
	}
	for($i=2; $i<=5; $i++){
		foreach($data['countries2'] as $v){
			$sql = 'INSERT INTO countries_to_where_buy 
					(intCountryID ,	intWhereBuyID)
					VALUES
					("'.$v['intCountryID'].'","'.$i.'")	';
			mysql_query($sql);	
		}
	}
    
    
    
echo('</xmp>');    
    
    
    
    



?>
</body>
</html>