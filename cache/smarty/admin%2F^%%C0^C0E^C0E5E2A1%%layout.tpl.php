<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:14
         compiled from /var/www/pandaH/panda.fm/data/templates/admin/layout.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title><?php echo $this->_tpl_vars['pagetitle']; ?>
</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta NAME="developer" CONTENT="www.miritec.com" />
	<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
css/admin.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
css/calendar.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
css/files.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
css/lytebox.css" />
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
js/admin.js"></script>
	<script type="text/javascript">var languageCode = 'ru';</script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
js/calendar.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
js/lytebox.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
/js/ckeditor/ckeditor.js"></script>
  </head>
  <body>
	<div id="hidescreen"></div>
    <div id="topBarBlue"></div>
    <div id="contentBar">
		<a href="/admin/index.php"><div id="logoBar">PandaTravel</div></a>
        <div id="navBar">
            <!-- /Верхнее меню -->
            <ul id="topMenu">
                <li><a href="<?php echo $this->_tpl_vars['PROJECT_URL']; ?>
admin/?event=logout">Выход</a></li>
            </ul>
            <!-- /Верхнее меню -->
        </div>
        <table id="contentTable" cellpadding="0" cellspacing="0">
            <tr>
                <td id="sideBar" valign="top">
                    <!-- Главное меню -->
                    <ul id="mainMenu">      
                    	<li class="cat_name"><div>Главная</div></li>
                        <li class="separator"></li>  
                    	<?php $_from = $this->_tpl_vars['adminPrivileges']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                    		<?php if ($this->_tpl_vars['item'] == 'menu'): ?><li id="menuMenu"><a href="menu.php">Меню</a></li><?php endif; ?>
                    		<?php if ($this->_tpl_vars['item'] == 'pages'): ?><li id="pagesMenu"><a href="pages.php">Страницы</a></li><?php endif; ?>
                    		<?php if ($this->_tpl_vars['item'] == 'modulespages'): ?><li id="modulespagesMenu"><a href="modulespages.php">Модульные страницы</a></li><?php endif; ?>
                    		<?php if ($this->_tpl_vars['item'] == 'news'): ?><li id="newsMenu"><a href="news.php">Новости</a></li><?php endif; ?>
                    		                    	<?php endforeach; endif; unset($_from); ?>
                    	<li class="cat_name"><div>Справочники</div></li>
                        <li class="separator"></li>	
                        <?php $_from = $this->_tpl_vars['adminPrivileges']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                    		<?php if ($this->_tpl_vars['item'] == 'countries_catalog'): ?><li id="countriesCatalogMenu"><a href="countries_catalog.php">Страны</a></li><?php endif; ?>
                    		<?php if ($this->_tpl_vars['item'] == 'resorts_catalog'): ?><li id="resortsCatalogMenu"><a href="resorts_catalog.php">Курорты</a></li><?php endif; ?>
                    		                    		<?php if ($this->_tpl_vars['item'] == 'hotels_catalog'): ?><li id="hotelsCatalogMenu"><a href="hotels_catalog.php">Отели</a></li><?php endif; ?>
							<?php if ($this->_tpl_vars['item'] == 'foodtypes'): ?><li id="foodtypesMenu"><a href="foodtypes.php">Типы питания</a></li><?php endif; ?>
							<?php if ($this->_tpl_vars['item'] == 'placetypes'): ?><li id="placetypesMenu"><a href="placetypes.php">Типы размещения</a></li><?php endif; ?>
                    	<?php endforeach; endif; unset($_from); ?>
						<li class="cat_name"><div>Инфоромация о турах</div></li>
						<li class="separator"></li>
						<?php $_from = $this->_tpl_vars['adminPrivileges']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
							<?php if ($this->_tpl_vars['item'] == 'tours'): ?><li id="toursMenu"><a href="tours.php">Туры</a></li><?php endif; ?>
							<?php if ($this->_tpl_vars['item'] == 'tourtypes'): ?><li id="tourtypesMenu"><a href="tourtypes.php">Виды туров</a></li><?php endif; ?>
							<?php if ($this->_tpl_vars['item'] == 'applications'): ?><li id="applicationsMenu"><a href="applications.php">Заявки</a></li><?php endif; ?>
							<?php if ($this->_tpl_vars['item'] == 'applications'): ?><li id="seminarordersMenu"><a href="seminarorders.php">Семинарские заявки</a></li><?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
                    	<li class="cat_name"><div>Остальное</div></li>
                        <li class="separator"></li>
                       	<?php $_from = $this->_tpl_vars['adminPrivileges']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                        	<?php if ($this->_tpl_vars['item'] == 'gallerys'): ?><li id="gallerysMenu"><a href="gallerys.php">Фотогалереи</a></li><?php endif; ?>
                        	<?php if ($this->_tpl_vars['item'] == 'generalgallery'): ?><li id="generalgalleryMenu"><a href="generalgallery.php">Слайдер</a></li><?php endif; ?>
                        	<?php if ($this->_tpl_vars['item'] == 'banners_zones'): ?><li id="banners_zonesMenu"><a href="banners_zones.php">Баннерные зоны</a></li><?php endif; ?>
                        	<?php if ($this->_tpl_vars['item'] == 'bottom_links'): ?><li id="bottomLinksMenu"><a href="bottom_links.php">Сcылки внизу</a></li><?php endif; ?>
                        	<?php if ($this->_tpl_vars['item'] == 'subscribes'): ?><li id="subscribesMenu"><a href="subscribes.php">Подписчики</a></li><?php endif; ?>
                        	<?php if ($this->_tpl_vars['item'] == 'messages'): ?><li id="messagesMenu"><a href="messages.php">Статьи рассылки</a></li><?php endif; ?>
                        	<?php if ($this->_tpl_vars['item'] == 'static_zone'): ?><li id="static_zoneMenu"><a href="static_zone.php">Статические зоны</a></li><?php endif; ?>
                        	<?php if ($this->_tpl_vars['item'] == 'contacts'): ?><li id="contactsMenu"><a href="contacts.php">Контакты</a></li><?php endif; ?>
                        	<?php if ($this->_tpl_vars['item'] == 'currencies'): ?><li id="currenciesMenu"><a href="currencies.php">Курс валют</a></li><?php endif; ?>
                        	<?php if ($this->_tpl_vars['item'] == 'links'): ?><li id="linksMenu"><a href="links.php">Ссылки правого блока</a></li><?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <li class="cat_name"><div>Безопасность</div></li>
                        <li class="separator"></li>
                        <?php $_from = $this->_tpl_vars['adminPrivileges']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                        	<?php if ($this->_tpl_vars['item'] == 'staffs_type'): ?><li id="staffs_typeMenu"><a href="staffs_type.php">Категории сотрудников</a></li><?php endif; ?>
                        	<?php if ($this->_tpl_vars['item'] == 'staffs'): ?><li id="staffsMenu"><a href="staffs.php">Сотрудники</a></li><?php endif; ?>
                    	<?php endforeach; endif; unset($_from); ?> 
                    	<?php if ($this->_tpl_vars['ADMIN_DATA']['intRoleID'] == SUPER_ADMIN_ROLE): ?><li id="adminsMenu"><a href="admins.php">Администраторы</a></li><?php endif; ?>
                    	<?php if ($this->_tpl_vars['ADMIN_DATA']['intRoleID'] == SUPER_ADMIN_ROLE): ?><li id="usersMenu"><a href="users.php">Пользователи</a></li><?php endif; ?>
                        <?php if ($this->_tpl_vars['ADMIN_DATA']['intRoleID'] == SUPER_ADMIN_ROLE): ?><li id="rolesMenu"><a href="roles.php">Роли</a></li><?php endif; ?>
                    </ul>
                  
                    <!-- /Главное меню -->
                </td>
                <td id="content" valign="top">
                    <!-- Тело -->
                    <script>$('#<?php echo $this->_tpl_vars['boldMenu']; ?>
Menu').addClass('active');</script>
                    <?php if ($this->_tpl_vars['messages']): ?>
						<?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['message']):
?>
							<div class="message <?php if ($this->_tpl_vars['message']['error']): ?>error<?php else: ?>inform<?php endif; ?>">
		                        <?php echo $this->_tpl_vars['message']['msg']; ?>

		                    </div>
						<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['page']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    <!-- /Тело -->
                </td>
            </tr>
        </table>
    </div>
<?php if ($this->_tpl_vars['messages']): ?>
<script>
<?php $_from = $this->_tpl_vars['hilightFormElements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem'] => $this->_tpl_vars['rule']):
?>
	HilightElement('#<?php echo $this->_tpl_vars['elem']; ?>
');
<?php endforeach; endif; unset($_from); ?>
</script>
<?php endif; ?>
<!-- Loaded in <?php echo $this->_tpl_vars['page_loaded_in']; ?>
 sec -->
	<div class="topBarBlue"></div>
  </body>
</html>