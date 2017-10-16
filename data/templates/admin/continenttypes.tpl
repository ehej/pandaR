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
		$('#event').val('SaveOrder');
		$('#sort_menu').submit();
	});
});
{/literal}
</script>

<input type="button" class="iconize" rel="23" value="Добавить" onclick='Go("continenttypes.edit.php")'/>

<form action="continenttypes.php" method="POST" id="sort_menu">
	<input type="hidden" name="event" id="event" value=""/>
	<br /><br />
	<div id="manage_menu_view">
		<ul class="sort_ul" id="0_ul">
		{foreach from=$continenttypes_list item=item}
			<li id="{$item.intTypeID}">
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td><span style="float:left;"><a href="continenttypes.edit.php?intTypeID={$item.intTypeID}" title="{$item.varName}">{$item.varName}</a></td>
					<td><span class="iconset iconize" style="margin-left: 20px; cursor: pointer; float:right;" rel="83" onclick='javascript:OnDelete("continenttypes.php?intTypeID={$item.intTypeID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intTypeID}?")'></span></td>
				</tr>
			</table>		
			</li>
		{/foreach}
		</ul>
	</div>
	<div style="padding-top: 20px">
		<input type="button" class="iconize" id="btnSaveOrder" rel="82" value="Сохранить порядок" />
		<br /><br />
		<p class="info">
		Для того, чтобы изменить порядок следования списка континентов, используйте перетаскивание мышью.<br />
		Чтобы система запомнила текущий порядок - нажмите "Сохранить порядок"
		</p>
	</div>
</form>