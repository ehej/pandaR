<?php /* Smarty version 2.6.19, created on 2016-10-27 13:36:27
         compiled from /var/www/pandaH/panda.fm/data/templates/public/contacts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', '/var/www/pandaH/panda.fm/data/templates/public/contacts.tpl', 25, false),array('modifier', 'trim', '/var/www/pandaH/panda.fm/data/templates/public/contacts.tpl', 25, false),)), $this); ?>
<div class="innerPage contact">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/bread_crumbs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_from = $this->_tpl_vars['contacts_office']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<table class="mainAdress">
			 <tr>
				<td class="big">
					<h2><?php echo $this->_tpl_vars['item']['varName']; ?>
 <?php if ($this->_tpl_vars['item']['varMain'] == 'yes'): ?>(главный оффис)<?php endif; ?></h2>
					<?php echo $this->_tpl_vars['item']['varInfo']; ?>

				</td>
			</tr>
		<?php if ($this->_tpl_vars['contact_contacts_group'][$this->_tpl_vars['item']['intContactID']]): ?>
				<tr>
					<td style="padding: 0;" width="50%">
			<?php $_from = $this->_tpl_vars['contact_contacts_group'][$this->_tpl_vars['item']['intContactID']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['its'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['its']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['its']):
        $this->_foreach['its']['iteration']++;
?>
					<span><span>
						<?php if ($this->_tpl_vars['its']['varStaffType'] == 'email'): ?>E-mail: <?php endif; ?>
						<?php if ($this->_tpl_vars['its']['varStaffType'] == 'phone'): ?>Тел: <?php endif; ?>
						<?php if ($this->_tpl_vars['its']['varStaffType'] == 'mobile'): ?>Моб: <?php endif; ?>
						<?php if ($this->_tpl_vars['its']['varStaffType'] == 'icq'): ?>ICQ: <?php endif; ?>
						<?php if ($this->_tpl_vars['its']['varStaffType'] == 'skype'): ?>Skype: <?php endif; ?></span>
						<?php echo $this->_tpl_vars['its']['varText']; ?>
</span><br />
			<?php endforeach; endif; unset($_from); ?><br />
					</td>
				</tr>
			<?php if (((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['varTransport'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)) != ''): ?>
			<tr>
				<td>
					<strong>Как добраться общественным транспортом:</strong>
					<?php echo $this->_tpl_vars['item']['varTransport']; ?>

				</td>
			</tr>
			<?php endif; ?>
		</table> 
		<?php endif; ?>
		<?php if ($this->_tpl_vars['item']['varFoto']): ?>
		<div id="map_<?php echo $this->_tpl_vars['item']['intContactID']; ?>
" style="display: none;">
			<img src="<?php echo $this->_tpl_vars['FOTO_CONTACTS_URL']; ?>
<?php echo $this->_tpl_vars['item']['varFoto']; ?>
" alt=""  class="map">
		</div>
		<a class="button" href="javascript:void(0);" onclick="$('#map_<?php echo $this->_tpl_vars['item']['intContactID']; ?>
').slideToggle();">
		<span class="showmap">Карта проезда</span></a>&nbsp;&nbsp;&nbsp;
		<?php endif; ?><br><br>
	<?php endforeach; endif; unset($_from); ?>
	
	<div class="managers rounded" id="managers">
		<div class="info">
			<?php $_from = $this->_tpl_vars['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['type'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['type']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['it']):
        $this->_foreach['type']['iteration']++;
?>
			<div class="item ">
				<h2><span><?php echo $this->_tpl_vars['it']['varNameType']; ?>
</span><small></small></h2>
				<div class="text">
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
						<?php $_from = $this->_tpl_vars['relations_type'][$this->_tpl_vars['key']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['staff'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['staff']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['staff']['iteration']++;
?>
							<?php if ($this->_tpl_vars['staffs'][$this->_tpl_vars['item']]['varView'] == 'yes'): ?>
						<td>

								<img src="<?php echo $this->_tpl_vars['path']; ?>
<?php echo $this->_tpl_vars['staffs'][$this->_tpl_vars['item']]['varFoto']; ?>
" alt="" width="110">
								<div>
									<strong class="name"><?php echo $this->_tpl_vars['staffs'][$this->_tpl_vars['item']]['varName']; ?>
</strong>
									<?php if ($this->_tpl_vars['staffs'][$this->_tpl_vars['item']]['varPost']): ?><span class="post"><?php echo $this->_tpl_vars['staffs'][$this->_tpl_vars['item']]['varPost']; ?>
</span><?php endif; ?>
									<span class="data">
									<?php if ($this->_tpl_vars['staffs'][$this->_tpl_vars['item']]['varInfo']): ?> <?php echo $this->_tpl_vars['staffs'][$this->_tpl_vars['item']]['varInfo']; ?>
 <?php endif; ?>
									<?php $_from = $this->_tpl_vars['contact'][$this->_tpl_vars['item']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['its']):
?>
										<?php if ($this->_tpl_vars['its']['varStaffType'] == 'email'): ?>E-mail: <?php endif; ?> 
											<?php if ($this->_tpl_vars['its']['varStaffType'] == 'phone'): ?>Тел: <?php endif; ?>
											<?php if ($this->_tpl_vars['its']['varStaffType'] == 'mobile'): ?>Моб: <?php endif; ?>
											<?php if ($this->_tpl_vars['its']['varStaffType'] == 'icq'): ?>ICQ: <?php endif; ?>
											<?php if ($this->_tpl_vars['its']['varStaffType'] == 'skype'): ?>Skype: <?php endif; ?>
											<?php echo $this->_tpl_vars['its']['varText']; ?>
<br>
									<?php endforeach; endif; unset($_from); ?>
									</span>
								</div>
								<div class="clear"></div>
								<br>
							
							</td>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
						</tr>
					</table>
				</div>
			</div>
			<?php endforeach; endif; unset($_from); ?>
		</div>
	</div>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "galleries.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "comments.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "contests.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div><!--//contact-->