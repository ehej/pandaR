<?php /* Smarty version 2.6.19, created on 2016-10-27 12:09:16
         compiled from contests.tpl */ ?>
<?php if ($this->_tpl_vars['contest'] != ''): ?>
<?php echo '
<script type="text/javascript">
	function contestComplete() {
		$(\'#event\').val(\'contestComplete\');
		$(\'#contestForm\').submit();
	}
</script>
'; ?>

<div class="title" style="padding: 15px;">On-line конкурсы</div>
<div class="title" style="text-align: right; width: 100%; font-size: 20px;">
	<div align="right" style="margin-bottom: 20px; padding-bottom: 15px;">
	<span>Конкурс «<?php echo $this->_tpl_vars['contest']['varTitle']; ?>
»</span><div style="height:15px;">&nbsp;</div>
	<?php if ($this->_tpl_vars['contestFlag'] == 'true'): ?>
	<div style="width: 100%; text-align: center; font-size: 12px; font-family: Arial;">
		<form action="/" method="post" name="completeContestForm" id="completeContestForm">
		<input type="hidden" name="event" value="contestComplete" />
		<input type="hidden" name="contestName" id="contestName" value="Конкурс MIBS Travel «<?php echo $this->_tpl_vars['contest']['varTitle']; ?>
»" />
		<div style="padding-bottom: 20px; color: green;">Вы успешно прошли конкурс! Заполните анкету и отправте ее нам.</div>
		<table cellpadding="5" cellspacing="5" class="currencyTable">
			<tr>
				<td class="contestTitle" style="padding-top: 20px;">Ф.И.О.</td>
				<td class="currencyItem" style="padding-top: 20px;"><input type="text" name="varFIOContest" id="varFIOContest" value="<?php echo $this->_tpl_vars['contestData']['varFIOContest']; ?>
" /></td>
			</tr>
			<tr>
				<td class="contestTitle">Название турагентства</td>
				<td class="currencyItem"><input type="text" name="varCompanyNameContest" id="varCompanyNameContest" value="<?php echo $this->_tpl_vars['contestData']['varCompanyNameContest']; ?>
" /></td>
			</tr>
			<tr>
				<td class="contestTitle">Город</td>
				<td class="currencyItem"><input type="text" name="varCityContest" id="varCityContest" value="<?php echo $this->_tpl_vars['contestData']['varCityContest']; ?>
" /></td>
			</tr>
			<tr>
				<td class="contestTitle">Почтовый адрес</td>
				<td class="currencyItem"><input type="text" name="varPostArrdContest" id="varPostArrdContest" value="<?php echo $this->_tpl_vars['contestData']['varPostArrdContest']; ?>
" /></td>
			</tr>
			<tr>
				<td class="contestTitle">Электронный адрес</td>
				<td class="currencyItem"><input type="text" name="varEmailContest" id="varEmailContest" value="<?php echo $this->_tpl_vars['contestData']['varEmailContest']; ?>
" /></td>
			</tr>
			<tr>
				<td class="contestTitle">Контактный телефон</td>
				<td class="currencyItem"><input type="text" name="varPhoneContest" id="varPhoneContest" value="<?php echo $this->_tpl_vars['contestData']['varPhoneContest']; ?>
" /></td>
			</tr>
			<tr>
				<td class="contestTitle" style="padding-bottom: 20px;">Другая информация</td>
				<td class="currencyItem" style="padding-bottom: 20px;">
					<textarea rows="5" cols="30" name="varInfoContest" id="varInfoContest"><?php echo $this->_tpl_vars['contestData']['varInfoContest']; ?>
</textarea>
				</td>
			</tr>
			<tr>
				<td class="contestTitle" style="padding-bottom: 20px;">&nbsp;</td>
				<td class="currencyItem" style="padding-bottom: 20px;">
					<input type="submit" value="Отправить" />
				</td>
			</tr>
		</table>
		</form>
	</div>
	<?php elseif ($this->_tpl_vars['contestFlag'] == 'false'): ?>
	<div style="width: 100%; text-align: center; font-size: 12px; color: red; padding: 20px 0px; font-family: Arial;">К сожалению, вы неправильно ответили на следующие вопросы:</div>
	<div style="width: 100%; text-align: left; font-size: 12px; padding: 20px 0px; font-family: Arial;">
		<ul>
		<?php $_from = $this->_tpl_vars['errorQuestions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<li style="line-height: 15px;"><?php echo $this->_tpl_vars['item']; ?>
</li>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
	</div>
	<div style="width: 100%; text-align: center; font-size: 12px; padding: 20px 0px; font-family: Arial;">
		<p class="archive"><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Назад</a></p>
	</div>
	<?php else: ?>
	<form action="/" method="get" name="contestForm" id="contestForm">
		<input type="hidden" name="event" id="event" value="contest" />
		<input type="hidden" name="intContestID" id="intContestID" value="<?php echo $this->_tpl_vars['contest']['intContestID']; ?>
" />
		<table cellpadding="0" cellspacing="0" style="border-collapse: collapse; border: none; background-color: #e7e7e7; width: 100%; font-family: Arial;">
			<?php unset($this->_sections['contest']);
$this->_sections['contest']['name'] = 'contest';
$this->_sections['contest']['loop'] = is_array($_loop=$this->_tpl_vars['contest']['questions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['contest']['max'] = (int)$this->_tpl_vars['contest']['intCountQuestionsInPage'];
$this->_sections['contest']['start'] = (int)0;
$this->_sections['contest']['show'] = true;
if ($this->_sections['contest']['max'] < 0)
    $this->_sections['contest']['max'] = $this->_sections['contest']['loop'];
$this->_sections['contest']['step'] = 1;
if ($this->_sections['contest']['start'] < 0)
    $this->_sections['contest']['start'] = max($this->_sections['contest']['step'] > 0 ? 0 : -1, $this->_sections['contest']['loop'] + $this->_sections['contest']['start']);
else
    $this->_sections['contest']['start'] = min($this->_sections['contest']['start'], $this->_sections['contest']['step'] > 0 ? $this->_sections['contest']['loop'] : $this->_sections['contest']['loop']-1);
if ($this->_sections['contest']['show']) {
    $this->_sections['contest']['total'] = min(ceil(($this->_sections['contest']['step'] > 0 ? $this->_sections['contest']['loop'] - $this->_sections['contest']['start'] : $this->_sections['contest']['start']+1)/abs($this->_sections['contest']['step'])), $this->_sections['contest']['max']);
    if ($this->_sections['contest']['total'] == 0)
        $this->_sections['contest']['show'] = false;
} else
    $this->_sections['contest']['total'] = 0;
if ($this->_sections['contest']['show']):

            for ($this->_sections['contest']['index'] = $this->_sections['contest']['start'], $this->_sections['contest']['iteration'] = 1;
                 $this->_sections['contest']['iteration'] <= $this->_sections['contest']['total'];
                 $this->_sections['contest']['index'] += $this->_sections['contest']['step'], $this->_sections['contest']['iteration']++):
$this->_sections['contest']['rownum'] = $this->_sections['contest']['iteration'];
$this->_sections['contest']['index_prev'] = $this->_sections['contest']['index'] - $this->_sections['contest']['step'];
$this->_sections['contest']['index_next'] = $this->_sections['contest']['index'] + $this->_sections['contest']['step'];
$this->_sections['contest']['first']      = ($this->_sections['contest']['iteration'] == 1);
$this->_sections['contest']['last']       = ($this->_sections['contest']['iteration'] == $this->_sections['contest']['total']);
?>
				<?php if ($this->_tpl_vars['contest']['questions'][$this->_sections['contest']['index']]['intQuestionID']): ?>
			<tr>
				<td class="feedbackTdLeft"><?php echo $this->_tpl_vars['contest']['questions'][$this->_sections['contest']['index']]['varQuestionText']; ?>
</td>
			</tr>
					<?php $_from = $this->_tpl_vars['contest']['questions'][$this->_sections['contest']['index']]['answers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
						<?php if ($this->_tpl_vars['item']['intQuestionID'] == $this->_tpl_vars['contest']['questions'][$this->_sections['contest']['index']]['intQuestionID']): ?>
			<tr>
				<td style="color: black; font-size: 12px; font-family: Arial; padding-left: 20px; padding-bottom: 10px; vertical-align: middle;">
					<div style="float: left;">
						<input type="radio"<?php $_from = $this->_tpl_vars['contestResults']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['it']):
?><?php if ($this->_tpl_vars['contest']['questions'][$this->_sections['contest']['index']]['intQuestionID'] == $this->_tpl_vars['it']['question'] && $this->_tpl_vars['item']['intAnswerID'] == $this->_tpl_vars['it']['answer']): ?> checked="checked"<?php endif; ?><?php endforeach; endif; unset($_from); ?> name="q[<?php echo $this->_tpl_vars['item']['intQuestionID']; ?>
]" value="<?php echo $this->_tpl_vars['item']['intAnswerID']; ?>
" />
					</div>
					<div style="padding-top: 3px; padding-left: 5px;"><?php echo $this->_tpl_vars['item']['varAnswerText']; ?>
</div>
				</td>
			</tr>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['contest']['questions'][$this->_sections['contest']['index']]['intQuestionID'] == $this->_tpl_vars['lastQuestionID']): ?>
			<tr>
				<td colspan="2" style="text-align: center; padding: 15px 0px;">
					<input type="button" value="Готово!" onclick="contestComplete()" />
				</td>
			</tr>
				<?php endif; ?>
			<?php endfor; endif; ?>
		</table>
		<br />
		<div align="left">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "scroller_for_public.tpl", 'smarty_include_vars' => array('pager' => $this->_tpl_vars['contest']['questions']['pager'],'script' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</form>
	<?php endif; ?>
	</div>
</div>
<?php endif; ?>