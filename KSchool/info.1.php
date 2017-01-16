<?php
require('lib/lib.php');
session_start();

// Check the session.
if (isset($_SESSION['STU_Fname'])) {
	$fname = $_SESSION['STU_Fname'];
} else {
	$fname = false;
}

output_header('info');





$smt=$db->prepare("SELECT * FROM STUDENT stu
JOIN AGE_Group a ON a.AGE_ID = stu.STU_Age
JOIN RANK r ON r.RANK_ID = stu.STU_Status
	  
	  WHERE stu.STU_ID = ? ");
	$smt->execute(array($USER->STU_ID));
	
	
	echo "<h2>Student Status:</h2>";
	
	echo "<br><table class='table table-hover table-responsive table-bordered'><tr><th>Belt Color</th><th>Form Rank</th><th>Age Group</th></tr>";
	while ($row = $smt->fetch(PDO::FETCH_OBJ)) {
	
	
	echo "<tr><td class='col-xs-3'>" . $row->RANK_Belt_Color. "</td><td class='col-xs-3'>" . $row->RANK_Form_Name. "</td><td class='col-xs-3'>" . $row->AGE_Descrip. "</td></tr>";
	echo "</tr>";
	
	}
	echo "</table><br><br><br><br>";


$smt=$db->prepare("SELECT cf.*, sf.*, i.INST_Name FROM STUDENT stu
JOIN COURSE_Form cf ON cf.RANK_ID = stu.STU_Status AND cf.AGE_ID = stu.STU_Age
JOIN SESSION_Form sf ON sf.Course_Form_ID = cf.COURSE_Form_ID
JOIN INSTRUCTOR i ON i.INST_ID = sf.INST_ID

WHERE stu.STU_ID = ? ");


	$smt->execute(array($USER->STU_ID));
	//$result=$smt->fetchAll(PDO::FETCH_OBJ);
	//print "<pre>";var_dump($result);print "</pre>";
	
	echo "<h3>Form Sessions Available:</h3>";
	
	echo "<br><table class='table table-hover table-responsive table-bordered'><tr><th>Form Session Time</th><th>Form Session Date</th><th>Instructor Name</th></tr>";
	while ($row = $smt->fetch(PDO::FETCH_OBJ)) {
	
	  
	echo "<tr><td class='col-xs-3'>" . $row->SESS_Time. "</td><td class='col-xs-3'>" . $row->SESS_Date. " </td><td class='col-xs-3'>" . $row->INST_Name."</td></tr>"; 
	echo "</tr>";
	  
	
	}
	echo "</table>";
	
	
	$smt=$db->prepare("SELECT tf.*, i.INST_Name FROM STUDENT stu
JOIN TEST_Form tf ON tf.TEST_Form_ID = stu.STU_Status
JOIN INSTRUCTOR i ON i.INST_ID = tf.INST_ID

WHERE stu.STU_ID = ? ");


	$smt->execute(array($USER->STU_ID));
	//$result=$smt->fetchAll(PDO::FETCH_OBJ);
	//print "<pre>";var_dump($result);print "</pre>";
	
	echo "<h3>Form Tests Available:</h3>";
	
	echo "<br><table class='table table-hover table-responsive table-bordered'><tr><th>Form Test Time</th><th>Form Test Date</th><th>Instructor Name</th></tr>";
	while ($row = $smt->fetch(PDO::FETCH_OBJ)) {
	
	  
	echo "<tr><td class='col-xs-3'>" . $row->TEST_Time. "</td><td class='col-xs-3'>" . $row->TEST_Date. " </td><td class='col-xs-3'>" . $row->INST_Name."</td></tr>"; 
	echo "</tr>";
	  
	
	}
	echo "</table><br><br><br><br><br>";
	
	
	
	
	
	
	$smt=$db->prepare("SELECT cw.*, sw.*, i.INST_Name, w.* FROM STUDENT stu
JOIN COURSE_Weap cw ON cw.AGE_ID = stu.STU_Age
JOIN SESSION_Weap sw ON sw.COURSE_Weap_ID = cw.COURSE_Weap_ID
JOIN INSTRUCTOR i ON i.INST_ID = sw.INST_ID
JOIN WEAPON w ON w.WEAP_ID = cw.COURSE_Weap_ID

WHERE stu.STU_ID = ? ");


	$smt->execute(array($USER->STU_ID));
	//$result=$smt->fetchAll(PDO::FETCH_OBJ);
	//print "<pre>";var_dump($result);print "</pre>";
	
	echo "<h3>Weapon Sessions Available:</h3>";
	
	echo "<br><table class='table table-hover table-responsive table-bordered'><tr><th>Weapon Session Time</th><th>Weapon Session Date</th><th>Weapon</th><th>Instructor Name</th></tr>";
	while ($row = $smt->fetch(PDO::FETCH_OBJ)) {
	
	  
	echo "<tr><td class='col-xs-3'>" . $row->SESS_Time_2. "</td><td class='col-xs-3'>" . $row->SESS_Date_2. " </td><td class='col-xs-3'>" . $row->WEAP_Descrip. " </td><td class='col-xs-3'>" . $row->INST_Name."</td></tr>"; 
	echo "</tr>";
	  
	
	}
	echo "</table>";
	
	$smt=$db->prepare("SELECT cw.*, tw.*, i.INST_Name, w.* FROM STUDENT stu
JOIN COURSE_Weap cw ON cw.AGE_ID = stu.STU_Age
JOIN TEST_Weap tw ON tw.TEST_Weap_ID = cw.COURSE_Weap_ID
JOIN INSTRUCTOR i ON i.INST_ID = tw.INST_ID
JOIN WEAPON w ON w.WEAP_ID = cw.COURSE_Weap_ID

WHERE stu.STU_ID = ? ");


	$smt->execute(array($USER->STU_ID));
	//$result=$smt->fetchAll(PDO::FETCH_OBJ);
	//print "<pre>";var_dump($result);print "</pre>";
	
	echo "<h3>Weapon Tests Available:</h3>";
	
	echo "<br><table class='table table-hover table-responsive table-bordered'><tr><th>Weapon Test Time</th><th>Weapon Test Date</th><th>Weapon</th><th>Instructor Name</th></tr>";
	while ($row = $smt->fetch(PDO::FETCH_OBJ)) {
	
	  
	echo "<tr><td class='col-xs-3'>" . $row->TEST_Time_2. "</td><td class='col-xs-3'>" . $row->TEST_Date_2. " </td><td class='col-xs-3'>" . $row->WEAP_Descrip. " </td><td class='col-xs-3'>" . $row->INST_Name."</td></tr>"; 
	echo "</tr>";
	  
	
	}
	echo "</table><br>";
	
?>

        
</body>
</html>