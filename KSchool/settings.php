<?php
require('lib/lib.php');
session_start();


$con = mysql_connect("localhost","npmcwherter","");
if (!$con){
    die("Unable to connect to the database: " . mysql_error());
}
mysql_select_db("c9",$con);


output_header('settings');



if (isset($_POST['update'])){
    $update = "UPDATE STUDENT SET STU_Email='$_POST[email]', STU_Address='$_POST[address]', STU_Phonenum='$_POST[phonenum]' WHERE STU_ID='$_POST[hidden]'";
    mysql_query($update, $con);
     //echo "Successfully updated"; } else { die('Invalid query: '.mysql_error());
}



//$sql = "SELECT * FROM STUDENT WHERE STU_ID=2  ";
$sql = "SELECT * FROM STUDENT WHERE STU_ID=" .$_SESSION['STU_ID'];
$data = mysql_query($sql, $con);

echo "<table border=1>
<tr>
<th>Email</th>
<th>Address</th>
<th>Phone Number</th></tr>";

while($record = mysql_fetch_array($data)) {
    echo "<form action=settings.php method=post>";
    echo "<tr>";
    echo "<td>" . "<input type=text name=email value=" . $record['STU_Email'] . " </td>";
    echo "<td>" . "<input type=text name=address value=" . $record['STU_Address'] . " </td>";
    echo "<td>" . "<input type=text name=phonenum value=" . $record['STU_Phonenum'] . " </td>";
    echo "<td>" . "<input type=hidden name=hidden value=" . $record['STU_ID'] . "</td>";
    echo "<td>" . "<input onclick='alert(\"Successfully updated\");' type=submit name=update value=update" . " </td>";
    //if($update) { echo "Successfully updated"; } else { die('Invalid query: '.mysql_error());
    echo "</form>";
}

echo "</table>";
mysql_close($con);

?>



</body>
</html>