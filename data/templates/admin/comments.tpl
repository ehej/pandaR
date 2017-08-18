{literal}
<script type="text/javascript">
	function selectAll() {
		if($('#allCheckBoxes').attr('checked')) {
			$('input[type=checkbox].checkboxes').attr('checked', 'checked');
		} else {
			$('input[type=checkbox].checkboxes').attr('checked', '');
		}
	}
	function deleteSelected() {
		$('#event').val('deleteItems');
		$('#commentsForm').submit();
	}
</script>
{/literal}
<h1>{$pagetitle}</h1>
<form action="comments.php" method="GET" id=commentsForm>
<input type="hidden" name="event" id="event" value="{$event}" />
<input type="hidden" name="sortOrder" id="sortOrder" value="{$sortOrder}"/>
<input type="hidden" name="sortBy" id="sortBy" value="{$sortBy}"/>
<div align="right">
	<input type="text" name="varName" id="varName" class="titled" value="{$filter.LIKEvarName}" title="Имя посетителя" />
	<input type="submit" value="Поиск" class="iconize" rel="132" name="sbutton" />
</div>

<table class="bordered">
<!-- Таблица -->
	<tr>
		<th><input type="checkbox" value="" name="allCheckBoxes" id="allCheckBoxes" onclick="selectAll();" /></th>
		<th>{include file='sortlink.tpl' field='varName' text='Имя' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>{include file='sortlink.tpl' field='varComment' text='Отзыв' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Что обсуждают</th>
		<th>{include file='sortlink.tpl' field='varComment' text='Опубликован' sortorder=$sortOrder sortby=$sortBy script=true}</th>
		<th>Действия</th>
	</tr>
	{foreach from=$comments_list item=item key=key}{if is_integer($key)}
	<tr onDblClick='window.location="comments.edit.php?intCommentID={$item.intCommentID}"' {if $item.varIsNew=='yes'} style="background:#e9f8eb;{/if}">
		<td><input type="checkbox" class="checkboxes" value="{$item.intCommentID}" name="checkBox[]" id="checkBox_{$item.intCommentID}" /></td>
		<td>{$item.varName}</td>
		<td>{$item.varComment|truncate:80}</td>
		<td nowrap="nowrap">
			<a href="{if $item.varModuleName=='category_news'}{$PROJECT_URL}category_news.php?intNewsTypeID={$item.intModuleID}{elseif $item.varModuleName=='news'}{$PROJECT_URL}news.php?intNewsID={$item.intModuleID}{elseif $item.varModuleName=='about_country'}{$PROJECT_URL}about_country.php?intCountryID={$item.intModuleID}{elseif $item.varModuleName=='resorts'}{$PROJECT_URL}resorts.php?intCountryID={$item.intModuleID}{elseif $item.varModuleName=='regions'}{$PROJECT_URL}regions.php?intCountryID={$item.intModuleID}{elseif $item.varModuleName=='hotels'}{$PROJECT_URL}hotels.php?intCountryID={$item.intModuleID}{elseif $item.varModuleName=='resort'}{$PROJECT_URL}resort.php?intResortID={$item.intModuleID}{elseif $item.varModuleName=='region'}{$PROJECT_URL}region.php?intRegionID={$item.intModuleID}{elseif $item.varModuleName=='hotel_gallery'}{$PROJECT_URL}hotel_gallery.php?intHotelID={$item.intModuleID}{elseif $item.varModuleName=='hotel'}{$PROJECT_URL}hotel.php?intHotelID={$item.intModuleID}{elseif $item.varModuleName=='country'}{$PROJECT_URL}country.php?intCountryID={$item.intModuleID}{elseif $item.varModuleName=='promoakciya'}{$PROJECT_URL}promoakciya.php?intPromoID={$item.intModuleID}{elseif $item.varModuleName=='adv_country'}{$PROJECT_URL}adv_country.php?intCountryID={$item.intModuleID}{elseif $item.varModuleName=='adv_resort'}{$PROJECT_URL}adv_resort.php?intResortID={$item.intModuleID}{elseif $item.varModuleName=='adv_resort_content'}{$PROJECT_URL}adv_resort_content.php?intResortContentID={$item.intModuleID}{elseif $item.varModuleName=='akciya'}{$PROJECT_URL}akciya.php?intAkciyID={$item.intModuleID}{elseif $item.varModuleName=='excursion'}{$PROJECT_URL}excursion.php?intExcursionID={$item.intModuleID}{elseif $item.varModuleName=='attraction'}{$PROJECT_URL}attraction.php?intAttractionID={$item.intModuleID}{elseif $item.varModuleName=='other_info'}{$PROJECT_URL}other_info.php?intInfoID={$item.intModuleID}{elseif $item.varModuleName=='pages'}{$PROJECT_URL}pages.php?intPageID={$item.intModuleID}{elseif $item.varModuleName=='pages'}{$PROJECT_URL}pages.php?intPageID={$item.intModuleID}{else}{$PROJECT_URL}{$item.varModuleName}.php{/if}">{if $item.varModuleName=='category_news'}{$PROJECT_URL}category_news.php?intNewsTypeID={$item.intModuleID}{elseif $item.varModuleName=='news'}{$PROJECT_URL}news.php?intNewsID={$item.intModuleID}{elseif $item.varModuleName=='about_country'}{$PROJECT_URL}about_country.php?intCountryID={$item.intModuleID}{elseif $item.varModuleName=='resorts'}{$PROJECT_URL}resorts.php?intCountryID={$item.intModuleID}{elseif $item.varModuleName=='regions'}{$PROJECT_URL}regions.php?intCountryID={$item.intModuleID}{elseif $item.varModuleName=='hotels'}{$PROJECT_URL}hotels.php?intCountryID={$item.intModuleID}{elseif $item.varModuleName=='resort'}{$PROJECT_URL}resort.php?intResortID={$item.intModuleID}{elseif $item.varModuleName=='region'}{$PROJECT_URL}region.php?intRegionID={$item.intModuleID}{elseif $item.varModuleName=='hotel_gallery'}{$PROJECT_URL}hotel_gallery.php?intHotelID={$item.intModuleID}{elseif $item.varModuleName=='hotel'}{$PROJECT_URL}hotel.php?intHotelID={$item.intModuleID}{elseif $item.varModuleName=='country'}{$PROJECT_URL}country.php?intCountryID={$item.intModuleID}{elseif $item.varModuleName=='promoakciya'}{$PROJECT_URL}promoakciya.php?intPromoID={$item.intModuleID}{elseif $item.varModuleName=='adv_country'}{$PROJECT_URL}adv_country.php?intCountryID={$item.intModuleID}{elseif $item.varModuleName=='adv_resort'}{$PROJECT_URL}adv_resort.php?intResortID={$item.intModuleID}{elseif $item.varModuleName=='adv_resort_content'}{$PROJECT_URL}adv_resort_content.php?intResortContentID={$item.intModuleID}{elseif $item.varModuleName=='akciya'}{$PROJECT_URL}akciya.php?intAkciyID={$item.intModuleID}{elseif $item.varModuleName=='excursion'}{$PROJECT_URL}excursion.php?intExcursionID={$item.intModuleID}{elseif $item.varModuleName=='attraction'}{$PROJECT_URL}attraction.php?intAttractionID={$item.intModuleID}{elseif $item.varModuleName=='other_info'}{$PROJECT_URL}other_info.php?intInfoID={$item.intModuleID}{elseif $item.varModuleName=='pages'}{$PROJECT_URL}pages.php?intPageID={$item.intModuleID}{elseif $item.varModuleName=='pages'}{$PROJECT_URL}pages.php?intPageID={$item.intModuleID}{else}{$PROJECT_URL}{$item.varModuleName}.php{/if}</a>
		</td>
		<td style="text-align: center;">{if $item.isActive==1}<span style="color:green;">да</span>{else}<span style="color:red;">нет</span>{/if}</td>
		<td nowrap="nowrap">
			<input type="button" class="iconize" rel="52" value="Редактировать" onclick='javascript:Go("comments.edit.php?intCommentID={$item.intCommentID}")'/> 
			<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("comments.php?intCommentID={$item.intCommentID}&event=delete", "Вы уверены, что хотите удалить запись с ID={$item.intCommentID}?")'/></td>
	</tr>
	{/if}
	{foreachelse}
	<tr>
		<td colspan="6" align="center" style="text-align: center">Нет записей</td>
	</tr>
	{/foreach}
</table>
<input type="button" value="Удалить выделенные" class="iconize" rel="83" onclick="deleteSelected();" />
<!-- /Таблица -->
<br /><br />
{include file="scroller.tpl" pager=$comments_list.pager script=1}
</form>

<script>
{literal}
function sortByField(field, sorder) {
	$('#sortBy').val(field);
	$('#sortOrder').val(sorder);
	$('#commentsForm').submit();
}
{/literal}
</script>