{if $bannersZone}
	<div class="baner">
		{if $bannersZone.isShowSection_1==1}
			{if $bannersZone.varBanner1Name!=''}{include file='bans_img_flash.tpl' url=$bannersZone.varLink1 path=$FILES_URL w=$bannersZone.intWidth1 h=$bannersZone.intHeight1 name=$bannersZone.varBanner1Name}{/if}
			{if $bannersZone.varBanner2Name!=''}{include file='bans_img_flash.tpl' url=$bannersZone.varLink2 path=$FILES_URL w=$bannersZone.intWidth2 h=$bannersZone.intHeight2 name=$bannersZone.varBanner2Name}{/if}
			{if $bannersZone.varBanner3Name!=''}{include file='bans_img_flash.tpl' url=$bannersZone.varLink3 path=$FILES_URL w=$bannersZone.intWidth3 h=$bannersZone.intHeight3 name=$bannersZone.varBanner3Name}{/if}
			{if $bannersZone.varBanner4Name!=''}{include file='bans_img_flash.tpl' url=$bannersZone.varLink4 path=$FILES_URL w=$bannersZone.intWidth4 h=$bannersZone.intHeight4 name=$bannersZone.varBanner4Name}{/if}
			{if $bannersZone.varBanner1Name != '' ||  $bannersZone.varBanner2Name != '' ||  $bannersZone.varBanner3Name != '' ||  $bannersZone.varBanner4Name != ''}
			<br />
			{/if}
		{/if}

		{if $bannersZone.isShowSection_2==1}
			{if $bannersZone.varBanner5Name!=''}{include file='bans_img_flash.tpl' url=$bannersZone.varLink5 path=$FILES_URL w=$bannersZone.intWidth5 h=$bannersZone.intHeight5 name=$bannersZone.varBanner5Name}{/if}
			{if $bannersZone.varBanner6Name!=''}{include file='bans_img_flash.tpl' url=$bannersZone.varLink6 path=$FILES_URL w=$bannersZone.intWidth6 h=$bannersZone.intHeight6 name=$bannersZone.varBanner6Name}{/if}
			{if $bannersZone.varBanner7Name!=''}{include file='bans_img_flash.tpl' url=$bannersZone.varLink7 path=$FILES_URL w=$bannersZone.intWidth7 h=$bannersZone.intHeight7 name=$bannersZone.varBanner7Name}{/if}
			{if $bannersZone.varBanner8Name!=''}{include file='bans_img_flash.tpl' url=$bannersZone.varLink8 path=$FILES_URL w=$bannersZone.intWidth8 h=$bannersZone.intHeight8 name=$bannersZone.varBanner8Name}{/if}
		{/if}
	</div>
{/if}