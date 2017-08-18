<?php /* Smarty version 2.6.19, created on 2017-08-17 08:23:04
         compiled from F:/OpenServer/domains/panda.fm/data/templates/public/pages.tpl */ ?>
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
            	<div class="Title">
					<h1><?php if ($this->_tpl_vars['data']['varTitle'] == "Таиланд"): ?>
							Тайланд
						<?php else: ?>
							<?php echo $this->_tpl_vars['data']['varTitle']; ?>

						<?php endif; ?></h1>
				</div>
				<?php if ($this->_tpl_vars['data']['varAnnotation']): ?>
                <div>
                    <h2><?php echo $this->_tpl_vars['data']['varAnnotation']; ?>
</h2>
                </div>
                <?php endif; ?>
                
		<?php if ($this->_tpl_vars['gallsImages']): ?>
			<center><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/gallery.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></center>
		<?php endif; ?>
                <div>
                    <?php echo $this->_tpl_vars['data']['varDescription']; ?>

                    <p>&nbsp;</p>
                    <p><a href="#" class="scrollTop">Наверх</a></p>
                </div>
				
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "seminary.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                <div class="clear"></div>
	
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