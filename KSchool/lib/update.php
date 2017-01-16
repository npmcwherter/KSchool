<?php

require "dbinfo.php";
$stu_rec

$stuid = $_POST[STU_ID];
$email = $_POST[STU_Email];
$address = $_POST[STU_Address];
$phonenum = $_POST[STU_Address];

$sql = "UPDATE STUDENT SET STU_Email = '$email', STU_Address = '$address', STU_Phonenum = '$phonenum' WHERE STU_ID = '$stuid' ";

$result = mysql_query($sql, $db) or die (mysql_error());
	if (!$result) {
		print "<h3>There is an issue!</h3>";
	} else {
		while ($rec = mysql_fetch_array($result)) {
			$stuid = $rec['STU_ID'];
			$email = $rec['STU_Email'];
			$address = $rec['STU_Address'];
			$phonenum = $rec['STU_Phonenum'];

print "<html><head><title>Updated Results</title></head><body>";

//include "header.php";

<h3>Updated Information:</h3>
<p>Email: $email</p>
<p>Address: $address</p>
<p>Phone Number: $phonenum</p>