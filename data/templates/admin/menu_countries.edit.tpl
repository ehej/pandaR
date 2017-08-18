{literal}
<script type="text/javascript">	
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}
<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("menu_countries.php")'/>
<form action="menu_countries.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intMenuID" id="intMenuID" value="{$menu.intMenuID}" />
<input type="hidden" name="intSortOrder" id="intSortOrder" value="{$menu.intSortOrder}" />

<table width="100%" class="container"><tr><td width="50%">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Общие данные</th></tr></thead>
		<tbody>			
			<tr>
				<td>Страна</td>
				<td>
					<select name="intCountryID" id="intCountryID">
						{foreach from=$countries item=item}
							<option value="{$item.intCountryID}"{if $item.intCountryID==$menu.intCountryID} selected="selected"{/if}>{$item.varName}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			{*<tr>
				<td>Чартерная страна</td>
				<td><input  style="float:left;" type="checkbox" id="isCharter" name="isCharter" value="1"{if $menu.isCharter == '1'} checked="checked"{/if} /></td>
			</tr>*}
			<tr>
				<td>Отображать</td>
				<td><input  style="float:left;" type="checkbox" id="isVisible" name="isVisible" value="1"{if $menu.isVisible != '0'} checked="checked"{/if} /></td>
			</tr>
			<tr>
				<td>Отображать только авторизированным пользователям</td>
				<td><input  style="float:left;" type="checkbox" id="isAuthorized" name="isAuthorized" value="1"{if $menu.isAuthorized == '1'} checked="checked"{/if} /></td>
			</tr>
		</tbody>
	</table>
	<div>
		<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
	</div>
</td></tr>
</table>