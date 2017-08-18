<?
/*
$t  = 'a:27:{i:0;s:5:"index";i:1;s:4:"menu";i:2;s:5:"pages";i:3;s:12:"modulespages";i:4;s:4:"news";i:5;s:14:"menu_countries";i:6;s:17:"menu_subcountries";i:7;s:14:"special_offers";i:8;s:9:"spoeditor";i:9;s:17:"countries_catalog";i:10;s:15:"regions_catalog";i:11;s:14:"hotels_catalog";i:12;s:16:"departure_cities";i:13;s:15:"promotionstypes";i:14;s:8:"gallerys";i:15;s:13:"banners_zones";i:16;s:13:"banners_right";i:17;s:8:"contests";i:18;s:8:"comments";i:19;s:9:"where_buy";i:20;s:11:"preferences";i:21;s:7:"logging";i:22;s:11:"bottomLinks";i:23;s:5:"users";i:24;s:6:"admins";i:25;s:5:"roles";i:26;s:5:"akcii";}';
print_r ($p = unserialize($t));
foreach($p as $v){
	$d[] = $v; 
 	if($v == 'regions_catalog')	{
		$d[]='resorts_catalog';
		$d[]='subscribes';
 	}
}
echo serialize($d);*/
?>
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
    $link = mysql_connect('localhost', 'root', 'root');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    @mysql_select_db("alex_mibs") or die("Could not select company database!");
    mysql_query("set names 'UTF8'") ;
    
    $doc_root = $_SERVER['DOCUMENT_ROOT'];
    $serv = '/hotels/';
    $img_path = $doc_root.$serv;
    
	$sql = "Select * from new_hotels_pic LIMIT 5" ;
	$rez = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rez)) {
		$hot[]= $row;
		/*$tmp = array();
		$sql2 = "SELECT * FROM regions WHERE varName LIKE('%".$row['name']."%')  " ;
		$rez2 = mysql_query($sql2);
		while ($row2 = mysql_fetch_assoc($rez2)) {
			$tmp[] = $row2['varName'];
		}
	    $data[$row['name']] = $tmp;
	    if(empty($tmp)){echo ($row['name']."\r\n");}
	    */
	    echo "<img src='".$serv.$row['path'].$row['file']."'><br>";
	    
	    $name = $row['file'];
	    $tmp_name = $img_path.$row['path'].$row['file'];
	    
	    
	}
	
	
	function OnUpload ($source) {
		$content = null;
		$isAjax = empty($source) ? true : false;

		$filename = $source['name'];
		$content = file_get_contents($source['tmp_name']);

		$file = md5($source['tmp_name'].time().rand(1000, 9999));
		$dir = IMAGES_PATH.substr($file, 0, 3)."/";
		if ( ! empty($filename)) {
			if ( ! is_dir($dir)){
				if ( ! mkdir($dir, 0777)){
					$data['messages'][] = 'Не удалось создать директорию для загрузки файла';
				}
			}
			$filepath = $dir.$file;
			if ( ! isset($data['message']) && ! file_put_contents($filepath, $content)){
				$data['messages'][] = 'Ошибка загрузки файла';
			} else {

				$data['varRealFileName'] = $filename;
				$data['fileType'] = substr(mime_content_type($filepath), 0, 5);
				$data['varFileName'] = $file;
				if ($data['fileType'] == 'image') {
					$data['intOrder'] = $this->imagesTable->getMaxOrder($this->data['intGalleryID']);
					$data['intImageID'] = $this->imagesTable->Insert($data);
					$data['messages'][] = 'Изображение успешно загружено';
					// resize image
					$data['imageUrl'] = getImageUrl($file, '64x48');
					$data['imageOrigUrl'] = $this->getImageUrl($file);
				} else {
					unlink ($filepath);
					$data['messages'][] = 'Файл не является изображением или видео';
				}
			}
		}
		if ($isAjax) {
			$data['width'] = $this->data['intPreviewWidth'];
			$data['height'] = $this->data['intPreviewHeight'];
			$data['imageUrl'] = $this->getImageUrl($data['varFileName'], $data['width'].'x'.$data['height']);
			$data['imageOrigUrl'] = $this->getImageUrl($data['varFileName']);
			echo json_encode($data);
			$this->terminatePage();
		} else {
			$this->response->redirect('gallerys.edit.php?intGalleryID='.$this->data['intGalleryID']);
		}
	}
	
function getImageUrl($image, $size = null) {
		if ( ! empty($size)) {
			$path = IMAGES_PATH.substr($image,0,3)."/".$size."/".$image;
			if ( ! file_exists($path)) {
				$path = substr($image,0,3)."/".$image;
				$this->imageManipulate->resize($path, $size);
			}
			$path = IMAGES_URL.substr($image,0,3)."/".$size."/".$image;
		} else {
			$path = IMAGES_URL.substr($image,0,3)."/".$image;
		}
		return $path;
	}
	
	function resize($picture, $dim='350x200', $format = 0){
	   $src = $this->dir.$picture;
	   if ( ! @ getimagesize($src) ) return false;
	   $d = explode('x', $dim);
	   if ( ! ($d && is_numeric($d['0']) && is_numeric($d['1'])) ) return false;
	   /*$wr = is_dir($dir) ? ! (is_writable($dir) ? true :  chmod($dirpic, CHMODE)) : false;
	   if (!$wr) return false;*/
	   $dirpic = $this->dir.substr($picture,0,4).$dim;
	   $pic = $dirpic.'/'.basename($picture);
	   if ( ! @ getimagesize($pic)){
	     if ( is_dir($dirpic) ? (is_writable($dirpic) ? true : (chmod($dirpic, $this->chmode) ? true : false )) :  (@mkdir($dirpic, $this->chmode) ? (is_writable($dirpic) ? true : chmod($dirpic, $this->chmode)) : false)) {
	       $this->update_picture($src, $pic, $d['0'], $d['1']);
	     } else return false;
	   }
	   $img = "";
	   switch($format){
	        case 0: $img = '<img src="/'.substr($pic, strlen($this->rootpath)).'" alt="" border="0">'; break;
	        case 2: $img = '<img src="/'.substr($pic, strlen($this->rootpath)).'" alt="" border="0" align="left" style="margin-right:15px;" >'; break;
	        case 1: default:  $img = "/".substr($pic, strlen($this->rootpath));
	   }
	   return $img;  
	}
	
	function image_resize($src, $dest, $width, $height) {
		if (!file_exists($src)) return false;
		$size = getimagesize($src);
		if ($size === false) return false;
		$format = strtolower(substr($size['mime'], strrpos($size['mime'], '/')+1));
		$icfunc = "imagecreatefrom" . $format;
		if ( ! function_exists($icfunc)) return false;
		$x_ratio = $width / $size[0];
		$y_ratio = $height / $size[1];
		$ratio = min($x_ratio, $y_ratio);
		$ratio = $x_ratio;
		$use_x_ratio = ($x_ratio == $ratio);
		$new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
		$new_height  = ! $use_x_ratio ? $height : floor($size[1] * $ratio);
		if ($new_width > $size[0]) { $new_width=$size[0]; }
		if ($new_height > $size[1]) { $new_height=$size[1]; }
		$new_left  = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2);
		$new_top  = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);
		$new_left = $new_top = 0;
		$isrc = $icfunc($src);
		$idest = imagecreatetruecolor($new_width, $new_height);
		imagefill($idest, 0, 0, $this->bgcolor);
		imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0] ,$size[1]);
		$image = "image".$format;
		if (!function_exists($image)) return false;
		$image($idest, $dest, $this->quality);
		imagedestroy($isrc);
		imagedestroy($idest);
		//copy($dest, $savepath);
		return true;
	}
	
print_r($hot);
echo count($data);