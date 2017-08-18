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
<input type="button" class="iconize" onclick='document.location.href="bottom_links.edit.php"' rel="23" value="Добавить" />
<br /><br />
<div id="manage_menu_view">
	<ul class="sort_ul" id="0_ul">
	{foreach from=$bottom_links item=item}
		<li id="{$item.intBottomLinkID}">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<span style="float:left; font-weight: bold;">
						<a href="bottom_links.edit.php?intBottomLinkID={$item.intBottomLinkID}" title="{$item.varTitle}">{$item.varTitle}</a>
					</span>
				</td>
				<td><span class="iconset iconize" style="margin-left: 10px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('bottom_links.php?event=delete&intBottomLinkID={$item.intBottomLinkID}', 'Удалить?')"></span></td>
			</tr>
		</table>			
		</li>
	{/foreach}
	</ul>
</div>
<div style="padding-top: 20px">
<form action="bottom_links.php?event=saveorder" method="POST" id="sort_menu">
	<input type="button" class="iconize" id="btnSaveOrder" rel="82" value="Сохранить порядок" />
</form>
<br />
<p class="info">
Для того, чтобы изменить порядок следования ссылок, используйте перетаскивание мышью.<br />
Чтобы система запомнила текущий порядок - нажмите "Сохранить порядок"
</p>
</div>