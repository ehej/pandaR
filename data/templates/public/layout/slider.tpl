<div class="slider">
	<div class="slider-content">
		{foreach from=$generalgallery item=item}
		<div class="slide">
			<a href="{$item.varLink}">
				<img src="{$bannerpath}{$item.varImage}"  alt="" />
				{if $item.varDescription}
				<div class="slide-description">
					<div class="desc-title">{$item.varDescription}</div>
				</div>
				{/if}
			</a>
		</div>
		{/foreach}
	</div>
	<ul class="slider-menu">
	{foreach from=$generalgallery key=key item=item}
		<li>
			<a href="#{$key}">{$item.varName}</a>
			<div class="menu_arrow"></div>
		</li>
	{/foreach}
	</ul>
	<span class="slider-lc"></span>
	<span class="slider-rc"></span>
</div> 
<!--end slider -->

