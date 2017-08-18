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
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("menu_countries.php")'/>
<input type="button" class="iconize" onclick='document.location.href="menu_subcountries.edit.php?intParentID={$data_menu.intMenuID}"' rel="23" value="Добавить" />
<br /><br />
<div id="manage_menu_view">
	<ul class="sort_ul" id="0_ul">
	{foreach from=$menu_subcountries_list item=item}
		<li id="{$item.intMenuID}">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td><span style="float:left;"><a href="menu_subcountries.edit.php?intMenuID={$item.intMenuID}" title="{$item.varTitle}" {if $item.isVisible != 1}style="color:red"{/if}>{$item.varTitle}</a>{if $item.intPlusSeparator}<br style="line-height: 5px;"><br style="line-height: 5px;">{/if}</td>
				<td><span class="iconset iconize" style="margin-left: 10px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu_countries.php?event=delete&intMenuID={$item.intMenuID}', 'Удалить?')"></span>{if $item.intPlusSeparator}<br  style="line-height: 5px;"><br style="line-height: 5px;">{/if}</td>
			</tr>
		</table>			
		</li>
	{/foreach}
	</ul>
</div>
<div style="padding-top: 20px">
<form action="menu_countries.php?event=saveorder&flagSubmenu=true" method="POST" id="sort_menu">
	<input type="hidden" name="intMenuID" value="{$intMenuID}" />
	<input type="button" class="iconize" id="btnSaveOrder" rel="82" value="Сохранить порядок" />
</form>
<br />
<p class="info">
Для того, чтобы изменить порядок следования пунктов меню, используйте перетаскивание мышью.<br />
Чтобы система запомнила текущий порядок - нажмите "Сохранить порядок"
</p>
</div>