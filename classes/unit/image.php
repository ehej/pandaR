<?php
class Image {
	
	private $quality;
	private $bgcolor;
	private $dir;
	private $chmode;
	private $rootpath;
	
	public function Image($dir = IMAGES_PATH, $rootpath = PROJECT_PATH, $bgcolor = '0xFFFFFF', $quality = 100, $chmode = 0777) {
		$this->dir = $dir;
		$this->rootpath = $rootpath;
		$this->bgcolor = $bgcolor;
		$this->quality = $quality;
		$this->chmode = $chmode;
	}
	
	function setDir($dir) {
		$this->dir = $dir;
	}
	
	function setRootPath($path){
		$this->rootpath = $path;
	}
	
	function setQuality($quality) {
		$this->quality = $quality;
	}
	
	function setBGColor($color) {
		$$this->bgcolor = $color;
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

 	private function update_picture($src, $dest, $w, $h){
		if($s = getimagesize($src)){
			if(file_exists($dest)){
				if(($s['0'] != $w) && ($s['1'] != $h)){
					$this->image_resize($src, $dest, $w, $h);
					chmod($dest, $this->chmode);
				}
			}else{
				$this->image_resize($src, $dest, $w, $h);
				chmod($dest, $this->chmode);
			}
		}
	}


	public function resize($picture, $dim='350x200', $format = 0){
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
	        case 1: default:  $img = '<img src="/'.substr($pic, strlen($this->rootpath)).'" alt="" border="0">';
	   }
	   return $img;  
	}
	
}