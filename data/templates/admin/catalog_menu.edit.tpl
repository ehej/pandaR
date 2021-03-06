{literal}
<script type="text/javascript" src="/js/colorpicker.js"></script>
<script type="text/javascript">	
	$(document).ready(function(){
		$('#varColor').ColorPicker({
	  		onSubmit: function(hsb, hex, rgb) {
	    		$('#varColor').val(hex);
	  		},
	  		onBeforeShow: function () {
	    		$(this).ColorPickerSetColor(this.value);
	  		},
	  		onChange: function (hsb, hex, rgb) {
	  			$('#varColor').val(hex);
	  		}
	 	})
	.bind('keyup', function(){
	  	$(this).ColorPickerSetColor(this.value);
		});
	});
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
	
	function setTarget(value) {
		$('#link').hide(); 
		$('#page').hide(); 
		$('#news').hide(); 
		$('#news_type').hide(); 
		$('#promo').hide();
	
		switch (value) {
			case 'link'					: $('#link').show(); $('#varUrl').val(''); break;
			case 'page'					: $('#page').show(); break;
			case 'news'					: $('#news').show(); break;
			case 'news_type'			: $('#news_type').show(); break;
			case 'promoakcii'			: $('#promo').show(); break;
		}
	}
</script>
{/literal}
<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("catalog_menu.php?{if $type == 'country'}intCountryID{else}intResortID{/if}={$menu.intCountryID}")'/>
<form action="catalog_menu.edit.php?{$QUERY_STRING}" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intMenuID" id="intMenuID" value="{$menu.intMenuID}" />
<input type="hidden" name="intSortOrder" id="intSortOrder" value="{$menu.intSortOrder}" />
<input type="hidden" name="intCountryID" id="intCountryID" value="{$menu.intCountryID}" />

<table width="100%" class="container"><tr><td width="50%">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Общие данные</th></tr></thead>
		<tbody>		
			<tr>
				<td>Название</td>
				<td><input type="text" name="varTitle" id="varTitle" value="{$menu.varTitle}" style="width: 200px;" /></td>
			</tr>
			<tr>
				<td>Модуль</td>
				<td>
					<select id="varModule" name="varModule" onchange="setTarget(this.value)">
						{foreach from=$modules_list item=item}
						{if $item.varPage != 'documents' && $item.varPage != 'regions'}
						<option value="{$item.varPage}" {if $menu.varModule==$item.varPage}selected{/if}>{$item.varTitle}</option>
						{/if}
						{/foreach}
					</select>					
				</td>
			</tr>	
			{if !$menu}
			<tr id="link">
				<td>Ссылка</td>
				<td><input type="text" id="varUrl" name="varUrl" value="" /></td>
			</tr>
			{/if}
			<tr id="link" {if $menu.varModule!='link'}style="display: none;"{/if}>
				<td>Ссылка</td>
				<td><input type="text" id="varUrl" name="varUrl" value="{$menu.varUrl}" /></td>
			</tr>		
			<tr id="page" {if $menu.varModule!='page'}style="display: none;"{/if}>
				<td>Страница</td>
				<td>
					<select id="varIdentifier1" name="varIdentifier1" style="width: 100px;">
						{foreach from=$pages_list item=item}
							<option value="{$item.intPageID}"{if $menu.varIdentifier==$item.intPageID} selected="selected"{/if}>{$item.varTitle}</option>
						{/foreach}	
					</select>			
				</td>
			</tr>
			<tr id="news" {if $menu.varModule!='news'}style="display: none;"{/if}>
				<td>Новость</td>
				<td>
					<select id="varIdentifier2" name="varIdentifier2" style="width: 100px;">
						{foreach from=$news_list item=item}
							<option value="{$item.intNewsID}"{if $menu.varIdentifier==$item.intNewsID} selected="selected"{/if}>{$item.varTitle}</option>
						{/foreach}	
					</select>			
				</td>
			</tr>
			<tr id="news_type" {if $menu.varModule!='news_type'}style="display: none;"{/if}>
				<td>Типы новостей</td>
				<td>
					<select id="varIdentifier3" name="varIdentifier3" style="width: 250px;">
						{foreach from=$news_type_list item=item}
							<option value="{$item.intNewsTypeID}"{if $menu.varIdentifier==$item.intNewsTypeID} selected="selected"{/if}>{$item.varNameType}</option>
						{/foreach}	
					</select>			
				</td>
			</tr>
			<tr id="promo" {if $menu.varModule!='promoakcii'}style="display: none;"{/if}>
				<td>Промоакции</td>
				<td>
					<select id="varIdentifier4" name="varIdentifier4" style="width: 250px;">
						{foreach from=$promo item=item}
							<option value="{$item.intPromoID}"{if $menu.varIdentifier==$item.intPromoID} selected="selected"{/if}>{$item.varName}</option>
						{/foreach}	
					</select>			
				</td>
			</tr>
			<tr>
				<td>Отображать</td>
				<td><input  style="float:left;" type="checkbox" id="isVisible" name="isVisible" value="1"{if $menu.isVisible != '0'} checked="checked"{/if} /></td>
			</tr>
		</tbody>
	</table>
	<div>
		<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
	</div>
</td></tr>
</table>
