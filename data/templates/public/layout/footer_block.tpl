<div class="footer">
	<div class="fleft">
		<ul class="footer-menu">
		{foreach from=$menuArr item=item name=menu}
			<li><a href="{$item.link}">{$item.varTitle}</a></li>
		{/foreach}
		</ul>
		<div class="copyright">
			<p>© 2006-2012 Panda Travel. Все права защищены.</p>
			<p class="develop">Разработка и поддержка - <a href="#">Миритек</a></p>
		</div>
		<ul class="social">
			<li><a href="#"><img src="images/facebook.png" width="21" height="19" alt="" /></a></li>
			<li><a href="#"><img src="images/vkontakte.png" width="21" height="21" alt="" /></a></li>
		</ul>
	</div>
	<div class="contact">
	{if $static_zone.footer}
		{include file="static_zone.tpl" zone=$static_zone.footer static_zone_path=$static_zone_path template=footer}
	{/if}
	</div>
</div>
{if $static_zone.footerSeo}
	{include file="static_zone.tpl" zone=$static_zone.footerSeo static_zone_path=$static_zone_path template=footer}
{/if}

