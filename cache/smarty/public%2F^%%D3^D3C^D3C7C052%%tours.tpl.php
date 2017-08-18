<?php /* Smarty version 2.6.19, created on 2016-10-27 12:12:48
         compiled from /var/www/pandaH/panda.fm/data/templates/public/tours.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '/var/www/pandaH/panda.fm/data/templates/public/tours.tpl', 25, false),array('modifier', 'explode', '/var/www/pandaH/panda.fm/data/templates/public/tours.tpl', 95, false),)), $this); ?>
<?php if (! $this->_tpl_vars['print']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/bread_crumbs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1><?php echo $this->_tpl_vars['curCountry']['varName']; ?>
</h1>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/country_navigation.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<?php if ($_GET['intTourID']): ?>
	<div>
		<h2 style="color: #4E9F2C;"><?php echo $this->_tpl_vars['data']['varName']; ?>
</h2>
		<?php if (! $this->_tpl_vars['print']): ?>
		<a class="order-button" style="float: right;position: relative; bottom: 5px;margin-left: 10px;" href="/order.php?intTourID=<?php echo $this->_tpl_vars['data']['intTourID']; ?>
">Заказать</a>
		<a class="order-button" style="float: right;position: relative; bottom: 5px;" href="?intTourID=<?php echo $this->_tpl_vars['data']['intTourID']; ?>
&event=print">Печать</a>
		<?php endif; ?>
		<table class="tour_params hovered">
		<?php if ($this->_tpl_vars['data']['varResortName']): ?>
		<tr>
			<td class="param">Курорт(ы):</td><td><?php echo $this->_tpl_vars['data']['varResortName']; ?>
</td>
		</tr>
		<?php endif; ?>
		<tr>
			<td class="param">Период действия цен:</td><td>
			<?php $this->assign('end1', "день"); ?>
			<?php $this->assign('end2', "дня"); ?>
			<?php $this->assign('end3', "дней"); ?>
			
			с <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['varDateFrom'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 по <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['varDateTo'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</td>
		</tr>
		<?php if ($this->_tpl_vars['data']['varStatement']): ?>
		<tr>
			<td class="param">Показания:</td><td><?php echo $this->_tpl_vars['data']['varStatement']; ?>
</td>
		</tr>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['data']['varHeat']): ?>
		<tr>
			<td class="param">Заезды:</td><td><?php echo $this->_tpl_vars['data']['varHeat']; ?>
</td>
		</tr>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['data']['intCountDays'] || $this->_tpl_vars['data']['varDays']): ?>
		<tr>
			<td class="param">Количество дней:</td><td><?php if ($this->_tpl_vars['data']['varDays']): ?><?php echo $this->_tpl_vars['data']['varDays']; ?>
<?php else: ?><?php echo $this->_tpl_vars['data']['intCountDays']; ?>
<?php endif; ?></td>
		</tr>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['data']['varFile3'] || $this->_tpl_vars['data']['varFile2'] || $this->_tpl_vars['data']['varFile1']): ?>
		<tr>
			<td class="param">Файлы:</td>
			<td>
				<a href="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['data']['varFile1']; ?>
" target="_blank"><?php echo $this->_tpl_vars['data']['varRealFile1Name']; ?>
</a><br />
				<a href="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['data']['varFile2']; ?>
" target="_blank"><?php echo $this->_tpl_vars['data']['varRealFile2Name']; ?>
</a><br />
				<a href="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['data']['varFile3']; ?>
" target="_blank"><?php echo $this->_tpl_vars['data']['varRealFile3Name']; ?>
</a>
			</td>
		</tr>
		<?php endif; ?>
		</table>
		<br />
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/gallery.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php if ($this->_tpl_vars['data']['hotel']): ?>
			<div class="tour_top_description"><?php echo $this->_tpl_vars['data']['hotel']['varDescription']; ?>
</div><br/>
		<?php else: ?>
			<div class="tour_top_description"><?php echo $this->_tpl_vars['data']['varDescription']; ?>
</div><br/>
		<?php endif; ?>
		<div class="tour_bottom_description"><?php echo $this->_tpl_vars['data']['varDescriptionBottom']; ?>
</div>
		<?php if ($this->_tpl_vars['UserData']): ?>
		<div class="foragencies">
			<div class="islogon">Вы авторизованы как <?php echo $this->_tpl_vars['UserData']['varName']; ?>
</div>
			<div class="comission">Комиссия для агентств с этого тура составляет: <?php echo $this->_tpl_vars['data']['varAgencyComission']; ?>
</div>
			<div class="agencydescription"><?php echo $this->_tpl_vars['data']['varAgencyDescription']; ?>
</div>
		</div>
		<?php endif; ?>
	</div>
<?php else: ?>
	<div class="tours">
	<?php $_from = $this->_tpl_vars['ctours']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['items']):
?>
		<div class="heading-blue">
			<h2 class="title"><span><?php echo $this->_tpl_vars['key']; ?>
</span></h2>
		</div>
		<table class="tours-table" width="100%">
			<tr class="table-heading">
				<td class="tour-name">Название / курорт</td>
				<td>Дней</td>
				<td class="time">Период действия цен</td>
				<td class="transport-icon">Транспорт</td>
				<td>Размещение</td>
				<td>Питание</td>
				<td>Цена</td>
				<td>&nbsp;</td>
			</tr>
			<?php $this->assign('i', 1); ?>
			<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>		
			<tr <?php if ($this->_tpl_vars['i']%2 == 1): ?>class="odd"<?php endif; ?>>
				<td class="tour-name"><span class="rate"><?php echo $this->_tpl_vars['item']['varCountStars']; ?>
*</span><a href="/tours-country/<?php echo $this->_tpl_vars['item']['tourCountryUri']; ?>
/?intTourID=<?php echo $this->_tpl_vars['item']['intTourID']; ?>
"><strong><?php echo $this->_tpl_vars['item']['varName']; ?>
</strong> / <?php echo $this->_tpl_vars['item']['varResortName']; ?>
</a></td>
				<td width="40"><?php echo $this->_tpl_vars['item']['intCountDays']; ?>
 дн.</td>
				<td width="150" class="small">с <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDateFrom'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 по <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDateTo'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

				</td>
				<td width="80" align="center">
					<?php if ($this->_tpl_vars['item']['varTransport']): ?>
						<?php $this->assign('transport', ((is_array($_tmp=',')) ? $this->_run_mod_handler('explode', true, $_tmp, $this->_tpl_vars['item']['varTransport']) : explode($_tmp, $this->_tpl_vars['item']['varTransport']))); ?>
						<?php $_from = $this->_tpl_vars['transport']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['trnsp']):
?>
							<img src="/images/<?php echo $this->_tpl_vars['trnsp']; ?>
.png" alt="" />
						<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>
				</td>
				<td width="70"><?php echo $this->_tpl_vars['item']['varPlaceTypeName']; ?>
</td>
				<td width="70"><?php echo $this->_tpl_vars['item']['varFoodTypeName']; ?>
</td>
				<td width="70" class="price"><?php echo $this->_tpl_vars['item']['intPriceFrom']; ?>
 <?php echo $this->_tpl_vars['item']['varMark']; ?>
</td>
				<td width="80"><a href="/order.php?intTourID=<?php echo $this->_tpl_vars['item']['intTourID']; ?>
" class="order-button">Заказать</a></td>
			</tr>
			<?php $this->assign('i', $this->_tpl_vars['i']+1); ?>
			<?php endforeach; endif; unset($_from); ?>
		</table>
	<?php endforeach; else: ?><center>
			<h2>Под запрос, мы индивидуально рассчитаем Вам тур любой сложности 
			537 23 23 </h2></center>
	<?php endif; unset($_from); ?>
	</div>
<?php endif; ?>