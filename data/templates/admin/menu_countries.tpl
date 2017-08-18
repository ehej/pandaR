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
<input type="button" class="iconize" onclick='document.location.href="menu_countries.edit.php"' rel="23" value="Добавить" />
<br /><br />
<div id="manage_menu_view">
	<ul class="sort_ul" id="0_ul">
	{foreach from=$menu_countries_list item=item}
		<li id="{$item.intMenuID}">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<span style="float:left; font-weight: bold;">
						<a href="menu_countries.php?event=showSubmenu&intMenuID={$item.intMenuID}" title="{$item.varTitle}">
						{foreach from=$countries item=it}{if $it.intCountryID==$item.intCountryID}{$it.varName}{/if}{/foreach}
						</a>
					</span>
				</td>
				<td><span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="52" onclick="Go('menu_countries.edit.php?intMenuID={$item.intMenuID}')"></span></td>
				<td><span class="iconset iconize" style="margin-left: 10px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu_countries.php?event=delete&intMenuID={$item.intMenuID}', 'Удалить?')"></span></td>
			</tr>
		</table>
		{*if $item.childs}
			<ul class="sort_ul" id="{$item.intMenuID}_ul">
			{foreach from=$item.childs item=item}
				<li id="{$item.intMenuID}">
				<table cellspacing="0" cellpadding="0" style="margin-left:10px;">
					<tr>
						<td><span style="float:left; padding-left: 20px;"><a href="menu_countries.edit.php?event=edit&intMenuID={$item.intMenuID}" title="{$item.varTitle}">{$item.varTitle}</a></td>
						<td><span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu_countries.php?event=delete&intMenuID={$item.intMenuID}', 'Удалить?')"></span></td>
					</tr>
				</table>
				</li>
			{/foreach}
			</ul>		
		{/if*}			
		</li>
	{/foreach}
	</ul>
</div>
<div style="padding-top: 20px">
<form action="menu_countries.php?event=saveorder&flagSubmenu=false" method="POST" id="sort_menu">
	<input type="button" class="iconize" id="btnSaveOrder" rel="82" value="Сохранить порядок" />
</form>
<br />
<p class="info">
Для того, чтобы изменить порядок следования пунктов меню, используйте перетаскивание мышью.<br />
Чтобы система запомнила текущий порядок - нажмите "Сохранить порядок"
</p>
</div>
