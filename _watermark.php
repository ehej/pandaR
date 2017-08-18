<? 
error_reporting(0);

if(@$_REQUEST['mini'] == ''){
    $wm = $_SERVER['DOCUMENT_ROOT'].'/images/logo.png';
}else{
    $wm = $_SERVER['DOCUMENT_ROOT'].'/images/logo_mini.png';
}
waterMark($_SERVER['DOCUMENT_ROOT'].$_REQUEST['img']); 

function waterMark($original, $watermark, $placement = 'bottom=5,right=5', $destination = null) { 
   $original = urldecode($original);
   $info_o = getImageSize($original); 
   
   if (!$info_o) 
         return false; 
   $info_w = getImageSize($watermark); 
//print_r($info_w);
   if (!$info_w) 
         return false; 
   list ($vertical, $horizontal) = split(',', $placement,2); 
   list($vertical, $sy) = split('=', trim($vertical),2); 
   list($horizontal, $sx) = split('=', trim($horizontal),2); 

   switch (trim($vertical)) { 
      case 'bottom': 
         $y = $info_o[1] - $info_w[1] - (int)$sy; 
         break; 
      case 'middle': 
         $y = ceil($info_o[1]/2) - ceil($info_w[1]/2) + (int)$sy; 
         break; 
      default: 
         $y = (int)$sy; 
         break; 
      } 

   switch (trim($horizontal)) { 
      case 'right': 
         $x = $info_o[0] - $info_w[0] - (int)$sx; 
         break; 
      case 'center': 
         $x = ceil($info_o[0]/2) - ceil($info_w[0]/2) + (int)$sx; 
         break; 
      default: 
         $x = (int)$sx; 
         break; 
      } 

   header("Content-Type: ".$info_o['mime']); 

   $original = @imageCreateFromString(file_get_contents($original)); 
   $watermark = @imageCreateFromString(file_get_contents($watermark)); 
   $out = imageCreateTrueColor($info_o[0],$info_o[1]); 

   imageCopy($out, $original, 0, 0, 0, 0, $info_o[0], $info_o[1]); 

   imageCopy($out, $watermark, $x, $y, 0, 0, $info_w[0], $info_w[1]);


   switch ($info_o[2]) { 
      case 1: 
         imageGIF($out); 
         break; 
      case 2: 
         imageJPEG($out,'' , 100); 
         break; 
      case 3: 
         imagePNG($out); 
         break; 
   } 

   imageDestroy($out); 
   imageDestroy($original); 
   imageDestroy($watermark); 

   return true; 
   } 

?>