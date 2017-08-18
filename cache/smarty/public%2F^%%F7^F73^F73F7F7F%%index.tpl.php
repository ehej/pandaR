<?php /* Smarty version 2.6.19, created on 2017-08-16 22:23:44
         compiled from F:/OpenServer/domains/panda.fm/data/templates/public/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'F:/OpenServer/domains/panda.fm/data/templates/public/index.tpl', 22, false),array('modifier', 'explode', 'F:/OpenServer/domains/panda.fm/data/templates/public/index.tpl', 25, false),)), $this); ?>
<div class="tours">
<?php $_from = $this->_tpl_vars['ctours']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['items']):
?>
	<div class="heading-orange">
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
		<?php $_from = $this->_tpl_vars['items']['tour']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<tr <?php if ($this->_tpl_vars['i']%2 == 1): ?>class="odd"<?php endif; ?>>
			<td class="tour-name"><span class="rate"><?php echo $this->_tpl_vars['item']['varCountStars']; ?>
*</span> <a href="/tours-country/<?php echo $this->_tpl_vars['items']['tourCountryUri']; ?>
/?intTourID=<?php echo $this->_tpl_vars['item']['intTourID']; ?>
"><strong><?php echo $this->_tpl_vars['item']['varName']; ?>
</strong> / <?php echo $this->_tpl_vars['item']['varResortName']; ?>
</a></td>
			<td width="40"><?php echo $this->_tpl_vars['item']['intCountDays']; ?>
 дн.</td>
			<td width="150" class="small">с <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDateFrom'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
 по <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDateTo'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
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
				<?php endif; ?></td>
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
<?php endforeach; endif; unset($_from); ?>
</div>