{literal}<script type="text/javascript">
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
			case 'link'					: $('#link').show(); $('#news_type').hide(); $('#promo').hide(); $('#varUrl').val(''); break;
			case 'page'					: $('#page').show(); $('#news').hide(); $('#news_type').hide(); $('#promo').hide(); break;
			case 'news'					: $('#news').show(); $('#news_type').hide(); $('#promo').hide(); break;
			case 'news_type'			: $('#news_type').show(); $('#promo').hide(); break;
			case 'promoakcii'			: $('#promo').show(); break;
		}
	}
	
	function change_type_menu(){
		type = $('#varTypeMenu option:selected').val();
		$('#intParentID option').css('display', 'none');
		$('#intParentID option[rel="'+type+'"]').css('display','');
		$('#intParentID option[rel="free"]').css('display','');
	}
	
	$(document).ready(function() {
   		change_type_menu();
 	});

	
</script>
{/literal}
<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("menu.php")'/>
<form action="menu.edit.php" method="POST" enctype="multipart/form-data" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intMenuID" id="intMenuID" value="{$menu.intMenuID}" />
<input type="hidden" name="intSortOrder" id="intSortOrder" value="{$menu.intSortOrder}" />

<table width="100%" class="container"><tr><td width="50%">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Общие данные</th></tr></thead>
		<tbody>			
			<tr>
				<td width="300">Название<span class="important">*</span></td>
				<td><input type="text" id="varTitle" name="varTitle" value="{$menu.varTitle|escape}" /></td>
			</tr>
			<tr>
				<td>Модуль</td>
				<td>
					<select id="varModule" name="varModule" onchange="setTarget(this.value)">
					{foreach from=$modules_list item=item}
						{if 
							$item.varPage != 'adv_country' &&  
							$item.varPage != 'hotels' && 
							$item.varPage != 'resorts' && 
							$item.varPage != 'about_country' && 
							$item.varPage != 'regions'
						}
						<option value="{$item.varPage}" {if $menu.varModule==$item.varPage}selected{/if}>{$item.varTitle}</option>
						{/if}
					{/foreach}
					</select>
				</td>
			</tr>
			
			<tr id="link" {if $menu.varModule!='link'}style="display: none;"{/if}>
				<td>Ссылка</td>
				<td><input type="text" id="varUrl" name="varUrl" value="{$menu.varUrl}" /></td>
			</tr>		
			<tr id="page" {if $menu.varModule!='page'}style="display: none;"{/if}>
				<td>Страница</td>
				<td>
					<select id="varIdentifier1" name="varIdentifier1" style="width: 250px;">
						{foreach from=$pages_list item=item}
							<option value="{$item.intPageID}"{if $menu.varIdentifier==$item.intPageID} selected="selected"{/if}>{$item.varTitle}</option>
						{/foreach}	
					</select>			
				</td>
			</tr>
			<tr id="news" {if $menu.varModule!='news'}style="display: none;"{/if}>
				<td>Новость</td>
				<td>
					<select id="varIdentifier2" name="varIdentifier2" style="width: 250px;">
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
			<tr style="display: none;">
				<td>Относится к меню</td>
				<td>
					<select id="varTypeMenu" name="varTypeMenu" onchange="change_type_menu();">
						<option value="top" {if $menu.varTypeMenu=='top'}selected="selected"{/if}>Верхнее меню</option>	
						<option value="bottom" {if $menu.varTypeMenu=='bottom'}selected="selected"{/if}>Нижнее меню</option>	
					</select>				
				</td>
			</tr>
			<tr>
				<td>Добавить изображение</td>
				<td>
				{if $menu.varImage}
					<img src="{$FILES_URL}{$menu.varImage}" width="20" />
					<input type="button" class="iconize" rel="83" value="Удалить" onclick='javascript:OnDelete("menu.edit.php?intMenuID={$menu.intMenuID}&varFlag={$menu.varImage}&event=deleteImage", "Вы уверены, что хотите удалить данный файл?")'/>
				{else}
					<input type="file" name="varImage" id="varImage" />
				{/if}
				</td>
			</tr>
			<tr>
				<td>Родительский пункт меню</td>
				<td>
					<select id="intParentID" name="intParentID">
					<option value="0" rel="free"></option>	
					{foreach from=$menu_list item=item}
						<option rel="{$item.varTypeMenu}" value="{$item.intMenuID}"{if $item.intMenuID == $menu.intParentID} selected="selected"{/if}>{$item.varTitle}</option>						
						{if $item.childs}
							{foreach from=$item.childs item=item}
								<option rel="{$item.varTypeMenu}" value="{$item.intMenuID}"{if $item.intMenuID == $menu.intParentID} selected="selected"{/if}>&nbsp;&nbsp;&nbsp;{$item.varTitle}</option>
							{/foreach}					
						{/if}					
					{/foreach}
					</select>				
				</td>
			</tr>
			<tr>
				<td>Отображать только авторизированным пользователям</td>
				<td><input  style="float:left;" type="checkbox" id="isAuthorized" name="isAuthorized" value="1"{if $menu.isAuthorized == '1'} checked="checked"{/if} /></td>
			</tr>	
			<tr>
				<td>Отображать</td>
				<td><input  style="float:left;" type="checkbox" id="isVisible" name="isVisible" value="1"{if $menu.isVisible == '1'} checked="checked"{/if} /></td>
			</tr>		
		</tbody>
	</table>
	<div>
		<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
	</div>
</td></tr>
</table>