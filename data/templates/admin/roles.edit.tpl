{literal}
<script type="text/javascript">
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>
<input type="button" class="iconize" rel="78" value="Вернуться к списку" onclick='Go("roles.php")'/>

<form action="roles.edit.php" method="POST" id="editForm" name="editForm">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intRoleID" id="intRoleID" value="{$data.intRoleID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Данные роли</th></tr></thead>
		<tbody>
			<tr>
				<td>Название<span class="important">*</span></td>
				<td><input type="text" id="varRoleName" name="varRoleName" value="{$data.varRoleName}" size="122" /></td>
			</tr>
			<tr>
				<td>Привелегии на редактирование</td>
				<td>
					<select name="varPriveleges[]" id="varPriveleges" multiple="multiple" style="width: 100%; height: 315px;">
					{*главная*}
						<option {foreach from=$data.varPriveleges item=item}{if $item=='index'} selected="selected"{/if}{/foreach} value="index">Главная</option>
                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='menu'} selected="selected"{/if}{/foreach} value="menu">Меню</option>
                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='pages'} selected="selected"{/if}{/foreach} value="pages">Страницы</option>
                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='modulespages'} selected="selected"{/if}{/foreach} value="modulespages">Модульные страницы</option>
                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='news'} selected="selected"{/if}{/foreach} value="news">Новости</option>

                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='menu_countries'} selected="selected"{/if}{/foreach} value="menu_countries">Меню стран</option>
                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='messages'} selected="selected"{/if}{/foreach} value="messages">Статьи рассылки</option>
                    {*справочники*}
                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='countries_catalog'} selected="selected"{/if}{/foreach} value="countries_catalog">Страны</option>
                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='resorts_catalog'} selected="selected"{/if}{/foreach} value="resorts_catalog">Курорты</option>
                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='regions_catalog'} selected="selected"{/if}{/foreach} value="regions_catalog">Регионы</option>
                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='hotels_catalog'} selected="selected"{/if}{/foreach} value="hotels_catalog">Отели</option>
                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='placetypes'} selected="selected"{/if}{/foreach} value="placetypes">Типы размещения</option>
                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='hoteltypes'} selected="selected"{/if}{/foreach} value="hoteltypes">Типы отелей</option>
						<option {foreach from=$data.varPriveleges item=item}{if $item=='foodtypes'} selected="selected"{/if}{/foreach} value="foodtypes">Типы питания</option>
						

                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='tours'} selected="selected"{/if}{/foreach} value="tours">Туры</option>
                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='tourtypes'} selected="selected"{/if}{/foreach} value="tourtypes">Категории туров</option>
                    	<option {foreach from=$data.varPriveleges item=item}{if $item=='applications'} selected="selected"{/if}{/foreach} value="applications">Заявки</option>

                    {*остальное*}

                       	<option {foreach from=$data.varPriveleges item=item}{if $item=='subscribes'} selected="selected"{/if}{/foreach} value="subscribes">Подписчики</option>
                       	<option {foreach from=$data.varPriveleges item=item}{if $item=='gallerys'} selected="selected"{/if}{/foreach} value="gallerys">Фотогалереи</option>
                        <option {foreach from=$data.varPriveleges item=item}{if $item=='banners_zones'} selected="selected"{/if}{/foreach} value="banners_zones">Баннерные зоны</option>
                        <option {foreach from=$data.varPriveleges item=item}{if $item=='banners_right'} selected="selected"{/if}{/foreach} value="banners_right">Баннеры справа</option>
                        <option {foreach from=$data.varPriveleges item=item}{if $item=='static_zone'} selected="selected"{/if}{/foreach} value="static_zone">Статические зоны</option>
                        <option {foreach from=$data.varPriveleges item=item}{if $item=='links'} selected="selected"{/if}{/foreach} value="links">Ссылки левого блока</option>

                        <option {foreach from=$data.varPriveleges item=item}{if $item=='contacts'} selected="selected"{/if}{/foreach} value="contacts">Контакты</option>
                        <option {foreach from=$data.varPriveleges item=item}{if $item=='currencies'} selected="selected"{/if}{/foreach} value="currencies">Курс валют</option>
                        <option {foreach from=$data.varPriveleges item=item}{if $item=='generalgallery'} selected="selected"{/if}{/foreach} value="generalgallery">Слайдер</option>

                     {*Безопасность*}
                        <option {foreach from=$data.varPriveleges item=item}{if $item=='staffs_type'} selected="selected"{/if}{/foreach} value="staffs_type">Категории сотрудников</option>
                        <option {foreach from=$data.varPriveleges item=item}{if $item=='staffs'} selected="selected"{/if}{/foreach} value="staffs">Сотрудники</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>