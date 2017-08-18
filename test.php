<?php
date_default_timezone_set("Europe/Kiev");
$conn=odbc_connect("SQLOnLine", "spominprice", "!@CgjVby", SQL_CUR_USE_ODBC);
//$query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE';";
$query = "exec dbo.up_currate";
$res = odbc_exec($conn,$query); 
while( $row = odbc_fetch_array($res) ) { 
	print_r($row); 
} 
    

?>
