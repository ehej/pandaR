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
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("{if $type == 'country'}countries_catalog.php{else}resorts_catalog.php{/if}")'/>
<input type="button" class="iconize" onclick='document.location.href="catalog_menu.edit.php?intParentID={$intParentID}&type={$type}"' rel="23" value="Добавить" />
<br /><br />
<div id="manage_menu_view">
	<ul class="sort_ul" id="0_ul">
	{foreach from=$menu_list item=item}
		{if $item.intParentID!=0}
		<li id="{$item.intMenuID}">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td><span style="float:left;"><a href="catalog_menu.edit.php?intParentID={$intParentID}&type={$type}&intMenuID={$item.intMenuID}" title="{$item.varTitle}">{$item.varTitle}</a></td>
				<td><span class="iconset iconize" style="margin-left: 10px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('catalog_menu.php?{if $type == 'country'}intCountryID{else}intResortID{/if}={$intParentID}&event=Delete&intMenuID={$item.intMenuID}', 'Удалить?')"></span></td>
			</tr>
		</table>					
		{if $item.childs}
			<ul class="sort_ul" id="{$item.intMenuID}_ul">
			{foreach from=$item.childs item=ite}
				<li id="{$ite.intMenuID}">
				<table cellspacing="0" cellpadding="0" style="margin-left:10px;">
					<tr>
						<td><span style="float:left; padding-left: 20px;"><a href="catalog_menu.edit.php?intParentID={$intParentID}&type={$type}&intMenuID={$ite.intMenuID}" title="{$ite.varTitle}">{$ite.varTitle}</a></td>
						<td><span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('catalog_menu.php?{if $type == 'country'}intCountryID{else}intResortID{/if}={$intParentID}&event=Delete&intMenuID={$ite.intMenuID}', 'Удалить?')"></span></td>
					</tr>
				</table>
				{if $ite.childs}
				<ul class="sort_ul" id="{$ite.intMenuID}_ul">
				{foreach from=$ite.childs item=it}
					<li id="{$it.intMenuID}">
					<table cellspacing="0" cellpadding="0" style="margin-left:40px;">
						<tr>
							<td><span style="float:left; padding-left: 20px;"><a href="catalog_menu.edit.php?intParentID={$intParentID}&type={$type}&intMenuID={$it.intMenuID}" title="{$it.varTitle}">{$it.varTitle}</a></td>
							<td><span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('catalog_menu.php?{if $type == 'country'}intCountryID{else}intResortID{/if}={$intParentID}&event=Delete&intMenuID={$it.intMenuID}', 'Удалить?')"></span></td>
						</tr>
					</table>
					</li>
				{/foreach}
				</ul>		
			{/if}
				</li>
			{/foreach}
			</ul>		
		{/if}
		</li>
	{/if}
	{/foreach}
	</ul>
</div>
<div style="padding-top: 20px">
<form action="catalog_menu.php?{if $type == 'country'}intCountryID{else}intResortID{/if}={$intCountryID}&event=saveorder&flagSubmenu=false" method="POST" id="sort_menu">
	<input type="button" class="iconize" id="btnSaveOrder" rel="82" value="Сохранить порядок" />
</form>
<br />
<p class="info">
Для того, чтобы изменить порядок следования пунктов меню, используйте перетаскивание мышью.<br />
Чтобы система запомнила текущий порядок - нажмите "Сохранить порядок"
</p>
</div>