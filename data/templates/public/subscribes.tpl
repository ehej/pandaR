{include file="banners.tpl"}
<div class="innerPage">
	{include file="layout/bread_crumbs.tpl"}
	<h1 align="center">{$pagetitle}</h1>
	<br />
	<form action="subscribes.php" method="POST" id="editForm" name="editForm">
	<input type="hidden" name="event" id="event" value="Subscribes" />
	{foreach from=$messages item=item}
		<div class="{if $item.error}error_form{else}messages{/if}">{$item.msg}</div>
	{/foreach}
	<table width="100%" class="container"><tr><td valign="top">
		<table class="bordered" width="500" style="margin: 0 auto;">
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
					<td>Телефон *</td>
					<td><input type="text" id="varPhone" name="varPhone" value="{$data_subs.varPhone|escape}" size="50" /></td>
				</tr>			
				<tr>
					<td>Страна *</td>
					<td><input type="text" id="varCountry" name="varCountry" value="{$data_subs.varCountry|escape}" size="50" /></td>
				</tr>			
				<tr>
					<td>Компания</td>
					<td><input type="text" id="varCompany" name="varCompany" value="{$data_subs.varCompany|escape}" size="50" /></td>
				</tr>			
				<tr>
					<td>Должность</td>
					<td><input type="text" id="varPost" name="varPost" value="{$data_subs.varPost|escape}" size="50" /></td>
				</tr>						
				<tr>
					<td></td>
					<td class="gray">*- поля обязательные для заполнения</td>
				</tr>	
			</tbody>
		</table>
	</td></tr></table>

	<div style="text-align: center;">
		<input type="submit" class="iconize" rel="82" value="Подписаться"/>
	</div>
	</form>
	<br />
	<br />
	<br />
	<h1 align="center">{$pagetitle2}</h1>
	<form action="subscribes.php" method="POST" id="editForm" name="editForm">
	<input type="hidden" name="event" id="event" value="Unsubscribes" />
	<table width="100%" class="container"><tr><td valign="top">
		<table class="bordered" width="500" style="margin: 0 auto;">
			<tbody>
				<tr>
					<td width="140">Имя *</td>
					<td><input type="text" id="varName" name="varName" value="{$data_unsubs.varName|escape}" size="50" /></td>
				</tr>
				<tr>
					<td>E-mai *</td>
					<td><input type="text" id="varEmail" name="varEmail" value="{$data_unsubs.varEmail|escape}" size="50" /></td>
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