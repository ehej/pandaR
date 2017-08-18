{literal}
<script type="text/javascript">
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("static_zone.php")'/>

<form action="static_zone.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intSZID" id="intSZID" value="{$data.intSZID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные администратора</th></tr></thead>
		<tbody>
			<tr>
				<td>Позиция</td>
				<td><select name="varPosition" id="varPosition">
						{foreach from=$position item=item key=key}
						<option value="{$key}" {if $data.varPosition==$key} selected="selected"{/if}>{$item}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td>Вес</td>
				<td><input type="text" id="intOrdering" name="intOrdering" value="{$data.intOrdering}" size="122" /></td>
			</tr>
			<tr>
				<td>Текст</td>
				<td><textarea class="ckeditor" id="varText" name="varText" cols="120">{$data.varText}</textarea></td>
			</tr>
			<tr>
				<td>Активен</td>
				<td><input  style="float:left;" type="checkbox" id="isActive" name="isActive" value="1"{if $data.isActive=='1'} checked="checked"{/if} /></td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>