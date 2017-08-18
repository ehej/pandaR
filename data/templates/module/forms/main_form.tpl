{foreach name=script from=$scripts item=item key=key}
	{$item}
{/foreach}
<form action="/form_sender.php" method="post" id="auto_form_{$data_form.intFormID}" name="auto_form_{$data_form.intFormID}">
	<input type="hidden" value="{$data_form.intFormID}" name="intFormID">
	{$template_html}
</form>