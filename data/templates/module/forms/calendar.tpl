{assign var="prefix" value="form_`$data.intFormID`_field_`$data.intFieldID`"}
{assign var="form_name" value="auto_form_`$data.intFormID`"}
{if !$data_active}
	{assign var="data_active" value=$data.varDefaultValue}
{/if}

{html_select_date field_order=DMY prefix=$prefix time=$data_active start_year="2010" end_year="+5" month_format=%m}
<input 
	type="button" 
	class="iconize" 
	rel="95" 
	value="Календарь" 
	onclick="displayCalendarSelectBox(document.{$form_name}.{$prefix}Year,document.{$form_name}.{$prefix}Month,document.{$form_name}.{$prefix}Day,false,false,this);"/></td>
			