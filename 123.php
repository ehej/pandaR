<?php
$login = 'rost1';
$password = 'NHbjpg';

$c = curl_init();
curl_setopt($c, CURLOPT_URL, 'http://online.mibs.kiev.ua/login.aspx');
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($c, CURLOPT_POSTFIELDS, '__EVENTTARGET=&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=&ctl00%24pageMessenger%24hidMessage=&ctl00%24pageMessenger%24hidRedirect=&ctl00%24Login%24ctl01='.$login.'&ctl00%24Login%24ctl02='.$password.'&ctl00%24Login%24ctl03=OK&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24ddlDepartFrom=0&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24ddlCountry=1860&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24ddlTourType=&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24chkAnyResort=on&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24chkAnyRegion=on&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24ddlTour=&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24chkAnyHotel=on&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24ctrlCalendar%24TxtMultiDatepickerFrom=13.12.2010&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24ctrlCalendar%24TxtMultiDatepickerTo=13.12.2010&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24ctrlCalendar%24DaysShift=0&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24ctrlCalendar%24hidErrDate=%D0%9D%D0%B0%D1%87%D0%B0%D0%BB%D1%8C%D0%BD%D0%B0%D1%8F+%D0%B4%D0%B0%D1%82%D0%B0+%D0%BD%D0%B5+%D0%BC%D0%BE%D0%B6%D0%B5%D1%82+%D0%B1%D1%8B%D1%82%D1%8C+%D0%B1%D0%BE%D0%BB%D1%8C%D1%88%D0%B5+%D0%BA%D0%BE%D0%BD%D0%B5%D1%87%D0%BD%D0%BE%D0%B9%21&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24ddlRoom=&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24chkAnyDuration=on&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24chkAnyCategory=on&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24chkAnyBoard=on&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24txtPriceMaximum=&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24currencySelector%24currencies=rbTour&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24qListHotel%24cbYes=on&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24qListHotel%24cbRequest=on&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24qListFlight%24cbYes=on&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24qListFlight%24cbRequest=on&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24ddlPageSize=20&ctl00%24generalContent%24QuotedDynamicControl%24DynamicOffersFilter%24chkAnyKindOfTour=on');
curl_exec ($c);
curl_close ($c); 