<?php
date_default_timezone_set("Europe/Kiev");
$conn=odbc_connect("SQLOnLine", "spominprice", "!@CgjVby");
//$query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE';";
$query = "select 1; select 2;";
$res = odbc_exec($conn,$query); 
if (odbc_next_result($res)){
    while ($row = odbc_fetch_array($res)) {
                print_r($row);
                }
                }

?>
