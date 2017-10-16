{include file="banners.tpl"}
<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}           
	<h1>{$pagetitle}</h1>
	<form action="unsubscribes.php" method="POST" id="editForm" name="editForm">
	<input type="hidden" name="event" id="event" value="Unsubscribes" />
	{foreach from=$messages item=item}
		<div class="{if $item.error}error_form{else}messages{/if}">{$item.msg}</div>
	{/foreach}

	<table width="100%" class="container"><tr><td valign="top">
		<table class="bordered" width="500" style="margin: 0 auto;">
			<thead><tr><th colspan="2">Данные подписчика</th></tr></thead>
			<tbody>
				<tr>
					<td width="140">Имя *</td>
					<td><input type="text" id="varName" name="varName" value="{$data_subs.varName|escape}" size="50" /></td>
				</tr>
				<tr>
					<td>E-mai *</td>
					<td><input type="text" id="varEmail" name="varEmail" value="{$data_subs.varEmail|escape}" size="50" /></td>
				</tr>	
				<tr>
					<td></td>
					<td class="gray">*- поля обязательные для заполнения</td>
				</tr>	
			</tbody>
		</table>
	</td></tr></table>

	<div style="text-align: center;">
		<input type="submit" class="iconize" rel="82" value="Отписаться"/>
	</div>
	</form>
</div>