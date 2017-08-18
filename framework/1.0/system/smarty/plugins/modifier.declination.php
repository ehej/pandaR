<?php
function smarty_modifier_declination($digit, $end1, $end2, $end3, $format="%d %s")
{
	$digit_original = $digit;
	$digit = (int)$digit;
	$digit_string = (string)$digit;
	if($digit <= 19){
		if(strlen($digit_string)>1){
			$i = 0;	
		}else{
			$i = $digit;
		}
	}else{
		$i = substr($digit_string,-1,1);	
	}
	$i = (int)$i;
	if($i == 1){
		$end = $end1;
	}elseif($i >= 2 && $i <= 4 ){
		$end = $end2;
	}else{
		$end = $end3;
	}

    $data = str_replace('%d', $digit_original, $format);
    $data = str_replace('%s', $end, $data);
    
    return $data;
}

/* vim: set expandtab: */

?>
