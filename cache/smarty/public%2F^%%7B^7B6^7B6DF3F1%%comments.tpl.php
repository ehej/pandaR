<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:16
         compiled from comments.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'comments.tpl', 45, false),)), $this); ?>
<?php if ($this->_tpl_vars['isShowComments'] == 'yes'): ?>
<div class="title" style="padding: 15px;">Комментарии</div>
<div class="title" style="text-align: right; width: 100%; font-size: 20px;">
	<div align="right" style="margin-bottom: 20px; padding-bottom: 15px;">
	<span style="cursor: pointer;<?php if ($this->_tpl_vars['commentFlag'] == 'true'): ?> display: none;<?php endif; ?>" onclick="javascript:changeShowCommentForm();">Добавить комментарий</span> <div style="height:15px;">&nbsp;</div>
	<div id="commentBlock" style="display: <?php if ($this->_tpl_vars['commentData']): ?>block<?php else: ?>none<?php endif; ?>; font-family: Arial; font-size: 12px;">
		<form method="post" id="userForm" action="">
		<input type="hidden" name="event" value="comment" />
		<table border="0" style="border-collapse: collapse; width: 100%; font-size: 12px; color: #365782;">
			<tr>
				<td>Имя (*)</td>
				<td class="commentBlock"><input type="text" value="<?php echo $this->_tpl_vars['commentData']['varName']; ?>
" size="20" maxlength="255" name="varName" id="varName" /></td>
			</tr>
			
			<tr>
				<td>Комментарий (*)</td>
				<td class="commentBlock"><textarea id="varComment" name="varComment" cols="30" rows="5"><?php echo $this->_tpl_vars['commentData']['varComment']; ?>
</textarea></td>
			</tr>
			<tr>
				<td>Введите код (*)</td>
				<td class="commentBlock"><img src="/kcaptcha.php?id=<?php  echo time(); ?>" alt="captcha" /><br/><br/><input type="text" name="Captcha" value="" id="Captcha" style="text-align:center;width:75px;" /></td>
			</tr>
			<tr>
				<td></td>
				<td class="commentBlock"><input type="submit" value="Отправить" name ="Submit" id="Submit" /></td>
			</tr>
			<tr>
				<td></td>
				<td class="commentBlock">«*» - поля обязательные для заполнения<br/><br/></td>
			</tr>
		</table>
	</form>
	</div>
	<?php if ($this->_tpl_vars['commentFlag'] == 'true'): ?>
	<div style="width: 100%; text-align: center; font-size: 12px; font-family: Arial;">Ваш комментарий будет добавлен после модерации</div>
	<?php else: ?>
		<?php if ($this->_tpl_vars['commentFlag'] == 'false'): ?>
		<div style="width: 100%; text-align: center; font-size: 12px; color: red; padding: 20px 0px; font-family: Arial;">Исправте ошибки заполнения формы</div>
		<?php endif; ?>
		<table cellpadding="5" cellspacing="" class="currencyTable">
		<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<tr>
				<td style="border-bottom: 2px solid #0a70d6; padding: 10px;">
					<div style="display: inline;" class="currencyValue"><?php echo $this->_tpl_vars['item']['varName']; ?>
</div>
					<div style="float: right;" class="currencyDate"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['varDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</div>
					<div style="font-style: italic; padding: 5px 0px; padding-top: 15px; font-family: Arial; font-size: 12px; color: gray;"><?php echo $this->_tpl_vars['item']['varComment']; ?>
</div>
				</td>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
		</table>
	<?php endif; ?>
	</div>
</div>
<?php endif; ?>