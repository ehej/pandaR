{php} 
$ext = pathinfo($this->get_template_vars('name'), PATHINFO_EXTENSION); 
if($ext == 'swf'){
	echo'
	<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="'.($this->get_template_vars('w')?$this->get_template_vars('w'):'100').'" height="'.($this->get_template_vars('h')?$this->get_template_vars('h'):'100').'">
	   <param name="movie" value="'.$this->get_template_vars('path').$this->get_template_vars('name').'">
	   <param name="quality" value="high">
	   <param name="wmode" value="transparent">
	   <param name="swfversion" value="6.0.65.0">
	   <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
	   <param name="expressinstall" value="/js/expressInstall.swf">
	   <!-- Next object tag is ксfor non-IE browsers. So hide it from IE using IECC. -->
	   <!--[if !IE]>-->
	   <object type="application/x-shockwave-flash" data="'.$this->get_template_vars('path').$this->get_template_vars('name').'" width="'.($this->get_template_vars('w')?$this->get_template_vars('w'):'100').'" height="'.($this->get_template_vars('h')?$this->get_template_vars('h'):'100').'">
		   <!--<![endif]-->
		   <param name="quality" value="high">
		   <param name="wmode" value="transparent">
		   <param name="swfversion" value="6.0.65.0">
		   <param name="expressinstall" value="/js/expressInstall.swf">
		   <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
		   <div>
			   <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
			   <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
		   </div>
		   <!--[if !IE]>-->
	   </object>
	   <!--<![endif]-->
	</object>
	';
	
	
}else{
	if($this->get_template_vars('url')){
		echo "<a href='http://".$this->get_template_vars('url')."'>";
	}
	echo '<img alt="" src="'.$this->get_template_vars('path').$this->get_template_vars('name').'" 
		'.($this->get_template_vars('w')?'width="'.$this->get_template_vars('w').'"':'').
		 ($this->get_template_vars('h')?'height="'.$this->get_template_vars('h').'"':'').'>';
	if($this->get_template_vars('url')){
		echo "</a>";
	}
}
{/php}

