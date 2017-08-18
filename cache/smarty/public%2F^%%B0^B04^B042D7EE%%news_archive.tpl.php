<?php /* Smarty version 2.6.19, created on 2016-10-27 23:46:03
         compiled from /var/www/pandaH/panda.fm/data/templates/public/news_archive.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '/var/www/pandaH/panda.fm/data/templates/public/news_archive.tpl', 24, false),)), $this); ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "banners.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	        <div class="innerPage">
	        	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/bread_crumbs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<form action="/news/" method="get" name="newsArchiveForm" id="newsArchiveForm">
					<div class="Title">
						<h1>Новости</h1>
					</div>
					<br>
					<div>
						<table width="100%" class="table_hotel" cellpadding="0" cellspacing="0">
							<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
								<?php if (is_integer ( $this->_tpl_vars['key'] )): ?>
								<tr>
									<td style="text-align: left;">
											<h2 class="title">
												<span style="font-weight: bold;"><?php echo $this->_tpl_vars['item']['varTitle']; ?>
</span>
											</h2>
										<div style="font-style: italic; "><?php echo $this->_tpl_vars['item']['varAnnotation']; ?>
</div>
										<div style="font-weight: bold; padding: 5px 0px;">
											<a href="<?php echo $this->_tpl_vars['item']['link']; ?>
" style="text-decoration: none; color: #0a5095;font-weight: bold;">Подробнее...</a>
										</div>
										<br clear="all" />
									</td>
									<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</td>
								</tr>
								<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?>
							<tr>
								<td colspan="2"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "scroller_for_public.tpl", 'smarty_include_vars' => array('pager' => $this->_tpl_vars['data']['pager'],'script' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td> 
							</tr>
						</table>
						
		                <p>&nbsp;</p>
		                <p><a href="#" class="scrollTop">Наверх</a></p>
		            </div>

		            <div class="clear"></div>
				</form>
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
		   </div>