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
//echo('<xmp>');
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
    $link = mysql_connect('localhost', 'root', 'root');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    @mysql_select_db("vitek_newstr") or die("Could not select company database!");
    mysql_query("set names 'UTF8'") ;


	$table = 'resorts';
	$ids = 'intResortID';
	$field_clear = 'varDescription';
	
	
    $sql = "Select $field_clear , $ids  FROM $table " ;

	$rez = mysql_query($sql);
	$c=0;
	while ($row = mysql_fetch_assoc($rez)) {
		$c++;
	    //$data[$c]['old'] = $row['varDescription'];
	    $da = $row[$field_clear];
	    $da = preg_replace("/width\s*=\s*(\"|\')([0-9]*)(\"|\')/i"		,'',$row[$field_clear]);
	    $da = preg_replace("/width\s*:\s*([0-9\.]*)(px|pt)\s?;?/i"		,'',$da);
	    $da = preg_replace("/font-family\s*:[a-zA-Z\s\']*;?/i"			,'',$da);
	    $da = preg_replace("/face\s*=\s*(\"|\')([A-Za-z\s]*)(\"|\')/i"	,'',$da);
	    $da = preg_replace("/font-size\s*:\s*([0-9\.]*)(px|pt)\s?;?/i"	,'',$da);
	    $da = preg_replace("/size\s*=\s*(\"|\')([0-9\+]*)(\"|\')/i"		,'',$da);
	    $da = preg_replace("/style\s*=\s*(\"|\')([\s]*)(\"|\')/i"		,'',$da);
	    
	    $data[$c]['new'] = $da;
	    $sql2 = 'UPDATE '.$table.' SET '.$field_clear.' = "'.addslashes($da).'" WHERE '.$ids.' = '.$row[$ids];
	    echo $row[$ids].' - ';
	    if(mysql_query($sql2)){
			echo 'good_upd';
	    }else{
			echo 'bad_upd';
	    }
	    echo'<div style="border: 1px #000 solid; width: 600px;">'.$da.'</div>';
	}
	//print_r($data);

    
    
//echo('</xmp>');    
    
    
    
    



?>
</body>
</html>