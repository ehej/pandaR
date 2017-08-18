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
	$('.sort_ul_bottom').sortable().disableSelection();
	$('#btnSaveOrder_bottom').click(function(){
		var result = [];
		var uls = $('.sort_ul_bottom');
		for(var i=0; i < uls.length; i++) {
			$("<input>", {
				type: 'hidden',
				name: 'order[' + parseInt(uls[i].id, 10) + ']',
				val: $(uls[i]).sortable('toArray')
			}).appendTo('#sort_menu_bottom');
		}
		$('#sort_menu_bottom').submit();
	});
});
{/literal}
</script>
<input type="button" class="iconize" onclick='window.location="menu.edit.php"' rel="23" value="Добавить" />
<br /><br />
<table  width="100%" >
	<tr>
		<td width="50%">
			<h1>Верхнее меню</h1>
			<div id="manage_menu_view">
				<ul class="sort_ul" id="0_ul">
				{foreach from=$menu_list item=item}
					<li id="{$item.intMenuID}">
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td><span style="float:left; font-weight: bold;"><a href="menu.edit.php?intMenuID={$item.intMenuID}" style="{if $item.isVisible == 0}color:#ccc;{/if}" title="{$item.varTitle|strip_tags|escape}">{$item.varTitle|strip_tags|escape}</a></td>
							<td>

								<span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu.php?event=delete&intMenuID={$item.intMenuID}', 'Удалить?')"></span>

							</td>
						</tr>
					</table>
					{if $item.childs}
						<ul class="sort_ul" id="{$item.intMenuID}_ul">
						{foreach from=$item.childs item=ite}
							<li id="{$ite.intMenuID}">
							<table cellspacing="0" cellpadding="0" style="margin-left:10px;">
								<tr>
									<td><span style="float:left; padding-left: 20px;"><a href="menu.edit.php?event=edit&intMenuID={$ite.intMenuID}" style="{if $ite.isVisible == 0}color:#ccc;{/if}" title="{$ite.varTitle|strip_tags|escape}">{$ite.varTitle|strip_tags|escape}</a></td>
									<td>

										<span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu.php?event=delete&intMenuID={$ite.intMenuID}', 'Удалить?')"></span>
	
									</td>
								</tr>
							</table>
							{if $ite.childs}
							<ul class="sort_ul" id="{$ite.intMenuID}_ul">
							{foreach from=$ite.childs item=it}
								<li id="{$it.intMenuID}">
								<table cellspacing="0" cellpadding="0" style="margin-left:40px;">
									<tr>
										<td><span style="float:left; padding-left: 20px;"><a href="menu.edit.php?event=edit&intMenuID={$it.intMenuID}" style="{if $it.isVisible == 0}color:#ccc;{/if}" title="{$it.varTitle|strip_tags|escape}">{$it.varTitle|strip_tags|escape}</a></td>
										<td>

											<span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu.php?event=delete&intMenuID={$it.intMenuID}', 'Удалить?')"></span>

										</td>
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
				{/foreach}
				</ul>
			</div>
			<div style="padding-top: 20px">
			<form action="menu.php?event=saveorder" method="POST" id="sort_menu">
				<input type="button" class="iconize" id="btnSaveOrder" rel="82" value="Сохранить порядок" />
			</form>
			</div>
		</td>
		<td style="display: none;">
			<h1>Нижнее меню</h1>
			<div id="manage_menu_view">
				<ul class="sort_ul_bottom" id="1_ul">
				{foreach from=$menu_list_bottom item=item}
					<li id="{$item.intMenuID}">
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td><span style="float:left; font-weight: bold;"><a href="menu.edit.php?intMenuID={$item.intMenuID}" style="{if $item.isVisible == 0}color:#ccc;{/if}" title="{$item.varTitle|strip_tags|escape}">{$item.varTitle|strip_tags|escape}</a></td>
							<td>

								<span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu.php?event=delete&intMenuID={$item.intMenuID}', 'Удалить?')"></span>

							</td>
						</tr>
					</table>
					{if $item.childs}
						<ul class="sort_ul" id="{$item.intMenuID}_ul">
						{foreach from=$item.childs item=ite}
							<li id="{$ite.intMenuID}">
							<table cellspacing="0" cellpadding="0" style="margin-left:10px;">
								<tr>
									<td><span style="float:left; padding-left: 20px;"><a href="menu.edit.php?event=edit&intMenuID={$ite.intMenuID}" style="{if $ite.isVisible == 0}color:#ccc;{/if}" title="{$ite.varTitle|strip_tags|escape}">{$ite.varTitle|strip_tags|escape}</a></td>
									<td>

										<span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu.php?event=delete&intMenuID={$ite.intMenuID}', 'Удалить?')"></span>

									</td>
								</tr>
							</table>
							{if $ite.childs}
							<ul class="sort_ul" id="{$ite.intMenuID}_ul">
							{foreach from=$ite.childs item=it}
								<li id="{$it.intMenuID}">
								<table cellspacing="0" cellpadding="0" style="margin-left:40px;">
									<tr>
										<td><span style="float:left; padding-left: 20px;"><a href="menu.edit.php?event=edit&intMenuID={$it.intMenuID}" style="{if $it.isVisible == 0}color:#ccc;{/if}" title="{$it.varTitle|strip_tags|escape}">{$it.varTitle|strip_tags|escape}</a></td>
										<td>

											<span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick="OnDelete('menu.php?event=delete&intMenuID={$it.intMenuID}', 'Удалить?')"></span>

										</td>
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
				{/foreach}
				</ul>
			</div>
			<div style="padding-top: 20px">
			<form action="menu.php?event=saveorder" method="POST" id="sort_menu_bottom">
				<input type="button" class="iconize" id="btnSaveOrder_bottom" rel="82" value="Сохранить порядок" />
			</form>
			</div>
		
		</td>
	</tr>
</table>	
<div>
<br />
<p class="info">
Для того, чтобы изменить порядок следования пунктов меню, используйте перетаскивание мышью.<br />
Чтобы система запомнила текущий порядок - нажмите "Сохранить порядок"
</p>
</div>