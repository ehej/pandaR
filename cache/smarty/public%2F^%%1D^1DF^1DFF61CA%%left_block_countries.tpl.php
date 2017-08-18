<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:16
         compiled from layout/left_block_countries.tpl */ ?>
<?php if ($this->_tpl_vars['curCountryID'] != ''): ?>
	<?php $_from = $this->_tpl_vars['menuCountries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['menu']['iteration']++;
?>
		<?php if ($this->_tpl_vars['item']['intParentID'] == 0 && $this->_tpl_vars['curCountryID'] == $this->_tpl_vars['item']['intCountryID'] && $this->_tpl_vars['item']['intCountryID']): ?>
			<div class="box country">
				<div class="bg">
					<h2 class="no0 open">
					<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
						<?php if ($this->_tpl_vars['i']['intCountryID'] == $this->_tpl_vars['item']['intCountryID']): ?>
							<?php if ($this->_tpl_vars['i']['varFlag']): ?><img src="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['i']['varFlag']; ?>
" width="25" height="17">&nbsp;<?php endif; ?><a class="countrititle" href="<?php echo $this->_tpl_vars['i']['link']; ?>
"><?php echo $this->_tpl_vars['i']['varName']; ?>
</a>
							<?php $this->assign('countrylink', $this->_tpl_vars['i']['link']); ?>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?></h2>
					<div class="innerContent open">
						<span ><a href="<?php echo $this->_tpl_vars['countrylink']; ?>
" title="" <?php if ($this->_tpl_vars['it']['varColor'] != ''): ?>style="color:#<?php echo $this->_tpl_vars['it']['varColor']; ?>
"<?php endif; ?>>О стране</a>&nbsp;<?php if ($this->_tpl_vars['item']['chield']): ?>|<?php endif; ?></span>
						<?php if (! empty ( $this->_tpl_vars['item']['chield'] )): ?>
							<?php $_from = $this->_tpl_vars['item']['chield']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['it']):
        $this->_foreach['child']['iteration']++;
?>
								<span ><a href="<?php echo $this->_tpl_vars['it']['link']; ?>
" title="" <?php if ($this->_tpl_vars['it']['varColor'] != ''): ?>style="color:#<?php echo $this->_tpl_vars['it']['varColor']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['it']['varTitle']; ?>
</a>&nbsp;<?php if (! ($this->_foreach['child']['iteration'] == $this->_foreach['child']['total']) && ! ($this->_foreach['child']['iteration'] <= 1)): ?>|<?php endif; ?></span>
							<?php endforeach; endif; unset($_from); ?>
							
							<div class="clear"></div>
						<?php endif; ?>
					</div>
				</div>
				<div class="bg2"></div>
			</div>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php $_from = $this->_tpl_vars['menuCountries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['menu']['iteration']++;
?>
		<?php if ($this->_tpl_vars['item']['intParentID'] == 0 && $this->_tpl_vars['curCountryID'] != $this->_tpl_vars['item']['intCountryID'] && $this->_tpl_vars['item']['intCountryID']): ?>
			<div class="box country">
				<div class="bg">
					<h2 class="no0 ">
					<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
						<?php if ($this->_tpl_vars['i']['intCountryID'] == $this->_tpl_vars['item']['intCountryID']): ?>
							<?php if ($this->_tpl_vars['i']['varFlag']): ?><img src="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['i']['varFlag']; ?>
" width="25" height="17">&nbsp;<?php endif; ?><a class="countrititle" href="<?php echo $this->_tpl_vars['i']['link']; ?>
"><?php echo $this->_tpl_vars['i']['varName']; ?>
</a>
							<?php $this->assign('countrylink', $this->_tpl_vars['i']['link']); ?>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?></h2>
					<div class="innerContent">
						<span ><a href="<?php echo $this->_tpl_vars['countrylink']; ?>
" title="" <?php if ($this->_tpl_vars['it']['varColor'] != ''): ?>style="color:#<?php echo $this->_tpl_vars['it']['varColor']; ?>
"<?php endif; ?>>О стране</a>&nbsp;<?php if ($this->_tpl_vars['item']['chield']): ?>|<?php endif; ?></span>
						<?php if (! empty ( $this->_tpl_vars['item']['chield'] )): ?>
							<?php $_from = $this->_tpl_vars['item']['chield']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['it']):
        $this->_foreach['child']['iteration']++;
?>
								<span ><a href="<?php echo $this->_tpl_vars['it']['link']; ?>
" title="" <?php if ($this->_tpl_vars['it']['varColor'] != ''): ?>style="color:#<?php echo $this->_tpl_vars['it']['varColor']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['it']['varTitle']; ?>
</a>&nbsp;<?php if (! ($this->_foreach['child']['iteration'] == $this->_foreach['child']['total']) && ! ($this->_foreach['child']['iteration'] <= 1)): ?>|<?php endif; ?></span>
							<?php endforeach; endif; unset($_from); ?>
							
							<div class="clear"></div>
						<?php endif; ?>
					</div>
				</div>
				<div class="bg2"></div>
			</div>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
	<?php $_from = $this->_tpl_vars['menuCountries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['menu']['iteration']++;
?>
		<?php if ($this->_tpl_vars['item']['intCountryID']): ?>
		<div class="box country">
			<div class="bg">
				<h2 class="no0 <?php if ($this->_tpl_vars['item']['intParentID'] == 0 && $this->_tpl_vars['curCountryID'] == $this->_tpl_vars['item']['intCountryID']): ?><?php endif; ?>">
				<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
					<?php if ($this->_tpl_vars['i']['intCountryID'] == $this->_tpl_vars['item']['intCountryID']): ?>
						<?php if ($this->_tpl_vars['i']['varFlag']): ?><img src="<?php echo $this->_tpl_vars['FILES_URL']; ?>
<?php echo $this->_tpl_vars['i']['varFlag']; ?>
" width="25" height="17">&nbsp;<?php endif; ?><a class="countrititle" href="<?php echo $this->_tpl_vars['i']['link']; ?>
"><?php echo $this->_tpl_vars['i']['varName']; ?>
</a>
						<?php $this->assign('countrylink', $this->_tpl_vars['i']['link']); ?>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?></h2>
				<div class="innerContent">
					<span><a href="<?php echo $this->_tpl_vars['countrylink']; ?>
" title="" <?php if ($this->_tpl_vars['it']['varColor'] != ''): ?>style="color:#<?php echo $this->_tpl_vars['it']['varColor']; ?>
"<?php endif; ?>>О стране</a>&nbsp;<?php if ($this->_tpl_vars['item']['chield']): ?>|<?php endif; ?></span>
					<?php if (! empty ( $this->_tpl_vars['item']['chield'] )): ?>
						<?php $_from = $this->_tpl_vars['item']['chield']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['it']):
        $this->_foreach['child']['iteration']++;
?>
							<span><a href="<?php echo $this->_tpl_vars['it']['link']; ?>
" title="" <?php if ($this->_tpl_vars['it']['varColor'] != ''): ?>style="color:#<?php echo $this->_tpl_vars['it']['varColor']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['it']['varTitle']; ?>
</a>&nbsp;<?php if (! ($this->_foreach['child']['iteration'] == $this->_foreach['child']['total']) && ! ($this->_foreach['child']['iteration'] <= 1)): ?>|<?php endif; ?></span>
						<?php endforeach; endif; unset($_from); ?>
						<div class="clear"></div>
					<?php endif; ?>
				</div>
			</div>
			<div class="bg2"></div>
		</div>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>