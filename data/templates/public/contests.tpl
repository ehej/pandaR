{if $contest!=''}
{literal}
<script type="text/javascript">
	function contestComplete() {
		$('#event').val('contestComplete');
		$('#contestForm').submit();
	}
</script>
{/literal}
<div class="title" style="padding: 15px;">On-line конкурсы</div>
<div class="title" style="text-align: right; width: 100%; font-size: 20px;">
	<div align="right" style="margin-bottom: 20px; padding-bottom: 15px;">
	<span>Конкурс «{$contest.varTitle}»</span><div style="height:15px;">&nbsp;</div>
	{if $contestFlag=='true'}
	<div style="width: 100%; text-align: center; font-size: 12px; font-family: Arial;">
		<form action="/" method="post" name="completeContestForm" id="completeContestForm">
		<input type="hidden" name="event" value="contestComplete" />
		<input type="hidden" name="contestName" id="contestName" value="Конкурс MIBS Travel «{$contest.varTitle}»" />
		<div style="padding-bottom: 20px; color: green;">Вы успешно прошли конкурс! Заполните анкету и отправте ее нам.</div>
		<table cellpadding="5" cellspacing="5" class="currencyTable">
			<tr>
				<td class="contestTitle" style="padding-top: 20px;">Ф.И.О.</td>
				<td class="currencyItem" style="padding-top: 20px;"><input type="text" name="varFIOContest" id="varFIOContest" value="{$contestData.varFIOContest}" /></td>
			</tr>
			<tr>
				<td class="contestTitle">Название турагентства</td>
				<td class="currencyItem"><input type="text" name="varCompanyNameContest" id="varCompanyNameContest" value="{$contestData.varCompanyNameContest}" /></td>
			</tr>
			<tr>
				<td class="contestTitle">Город</td>
				<td class="currencyItem"><input type="text" name="varCityContest" id="varCityContest" value="{$contestData.varCityContest}" /></td>
			</tr>
			<tr>
				<td class="contestTitle">Почтовый адрес</td>
				<td class="currencyItem"><input type="text" name="varPostArrdContest" id="varPostArrdContest" value="{$contestData.varPostArrdContest}" /></td>
			</tr>
			<tr>
				<td class="contestTitle">Электронный адрес</td>
				<td class="currencyItem"><input type="text" name="varEmailContest" id="varEmailContest" value="{$contestData.varEmailContest}" /></td>
			</tr>
			<tr>
				<td class="contestTitle">Контактный телефон</td>
				<td class="currencyItem"><input type="text" name="varPhoneContest" id="varPhoneContest" value="{$contestData.varPhoneContest}" /></td>
			</tr>
			<tr>
				<td class="contestTitle" style="padding-bottom: 20px;">Другая информация</td>
				<td class="currencyItem" style="padding-bottom: 20px;">
					<textarea rows="5" cols="30" name="varInfoContest" id="varInfoContest">{$contestData.varInfoContest}</textarea>
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
	{elseif $contestFlag=='false'}
	<div style="width: 100%; text-align: center; font-size: 12px; color: red; padding: 20px 0px; font-family: Arial;">К сожалению, вы неправильно ответили на следующие вопросы:</div>
	<div style="width: 100%; text-align: left; font-size: 12px; padding: 20px 0px; font-family: Arial;">
		<ul>
		{foreach from=$errorQuestions item=item}
			<li style="line-height: 15px;">{$item}</li>
		{/foreach}
		</ul>
	</div>
	<div style="width: 100%; text-align: center; font-size: 12px; padding: 20px 0px; font-family: Arial;">
		<p class="archive"><a href="{php}echo $_SERVER['HTTP_REFERER'];{/php}">Назад</a></p>
	</div>
	{else}
	<form action="/" method="get" name="contestForm" id="contestForm">
		<input type="hidden" name="event" id="event" value="contest" />
		<input type="hidden" name="intContestID" id="intContestID" value="{$contest.intContestID}" />
		<table cellpadding="0" cellspacing="0" style="border-collapse: collapse; border: none; background-color: #e7e7e7; width: 100%; font-family: Arial;">
			{section name=contest loop=$contest.questions max=$contest.intCountQuestionsInPage start=0}
				{if $contest.questions[contest].intQuestionID}
			<tr>
				<td class="feedbackTdLeft">{$contest.questions[contest].varQuestionText}</td>
			</tr>
					{foreach from=$contest.questions[contest].answers item=item}
						{if $item.intQuestionID==$contest.questions[contest].intQuestionID}
			<tr>
				<td style="color: black; font-size: 12px; font-family: Arial; padding-left: 20px; padding-bottom: 10px; vertical-align: middle;">
					<div style="float: left;">
						<input type="radio"{foreach from=$contestResults item=it}{if $contest.questions[contest].intQuestionID==$it.question && $item.intAnswerID==$it.answer} checked="checked"{/if}{/foreach} name="q[{$item.intQuestionID}]" value="{$item.intAnswerID}" />
					</div>
					<div style="padding-top: 3px; padding-left: 5px;">{$item.varAnswerText}</div>
				</td>
			</tr>
						{/if}
					{/foreach}
				{/if}
				{if $contest.questions[contest].intQuestionID==$lastQuestionID}
			<tr>
				<td colspan="2" style="text-align: center; padding: 15px 0px;">
					<input type="button" value="Готово!" onclick="contestComplete()" />
				</td>
			</tr>
				{/if}
			{/section}
		</table>
		<br />
		<div align="left">
		{include file="scroller_for_public.tpl" pager=$contest.questions.pager script=1}
		</div>
	</form>
	{/if}
	</div>
</div>
{/if}