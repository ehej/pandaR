<h1>{$pagetitle}</h1>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript">
{literal}
	$(document).ready(function(){
		$('.sort_ul').sortable().disableSelection();
		$('#btnSaveOrder').click(function(){
			var result = [];
			var uls = $('.sort_ul');
			for(var i=0; i < uls.length; i++) {
				$("<input>", {
					type: 'hidden',
					name: 'order[' + parseInt(uls[i].id, 10) + ']',
					val: $(uls[i]).sortable('toArray')
				}).appendTo('#sort_menu');
			}
			$('#sort_menu').submit();
		});
	});
{/literal}
</script>
<input type="button" class="iconize" onclick='window.location="banners_right.edit.php"' rel="23" value="Добавить" />
<br /><br />
<div id="manage_menu_view">
	<ul class="sort_ul" id="0_ul">
	{foreach from=$banners_list item=item}
		<li id="{$item.intBannerRightID}">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td><span style="float:left; font-weight: bold;"><a href="banners_right.edit.php?intBannerRightID={$item.intBannerRightID}" title="{$item.varBannerRealName}">{$item.varBannerRealName}</a></td>
				<td><span class="iconset iconize" style="margin-left: 10px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('banners_right.php?event=delete&intBannerRightID={$item.intBannerRightID}', 'Удалить?')"></span></td>
			</tr>
		</table>	
		</li>
	{/foreach}
	</ul>
</div>
<div style="padding-top: 20px">
<form action="banners_right.php?event=saveorder" method="POST" id="sort_menu">
	<input type="button" class="iconize" id="btnSaveOrder" rel="82" value="Сохранить порядок" />
</form>
<br />
<p class="info">
Для того, чтобы изменить порядок следования баннеров, используйте перетаскивание мышью.<br />
Чтобы система запомнила текущий порядок - нажмите "Сохранить порядок"
</p>
</div>