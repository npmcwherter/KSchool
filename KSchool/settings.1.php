<?php
require('lib/lib.php');
// Setup an array of data that will be used to re-display to the user if needed.


$data = array('STU_Email' => '', 'STU_Address' => '', 'STU_Phonenum' => '');
$error = false;
$success = false;
$sqlerror = false;




update_info();

if (isset($_POST['STU_Username'])) {
	$STU_Username = $_POST['STU_Username'];
	$STU_Password = $_POST['STU_Password'];

	$smt=$db->prepare("SELECT * FROM STUDENT WHERE STU_Username = ? ");
	$smt->execute(array($STU_Username));
	$result=$smt->fetch(PDO::FETCH_OBJ);
	$Pass=$result->STU_Password;
	$User=$result->STU_Username;
	$STU_Fname=$result->STU_Fname;
	$STU_ID=$result->STU_ID;
		if(password_verify($STU_Password,$Pass)& $STU_Username===$User) {
        	$_SESSION['STU_Username'] = $STU_Username;
        	$_SESSION['STU_Fname'] = $STU_Fname;
        	$_SESSION['STU_ID'] = $STU_ID;
		header('location:index.php');
    }
}




if (isset($_REQUEST['update'])) {
	// Variable that we will insert a string into if there is an error to display.
	
	// An array that will hold parameters to insert the record.
	$sql_params = array();
	// For each input check if it set, if so set the data object and the params object.
	
	if (isset($_REQUEST['STU_Email']) && $_REQUEST['STU_Email']) {
		$data['STU_Email'] = strip_tags($_REQUEST['STU_Email']);
		$sql_params['STU_Email'] = $data['STU_Email'];
	} else {
		$error = "Email Required";
	}
	
	if (isset($_REQUEST['STU_Address']) && $_REQUEST['STU_Address']) {
		$data['STU_Address'] = strip_tags($_REQUEST['STU_Address']);
		$sql_params['STU_Address'] = $data['STU_Address'];
	} else {
		$error = "Address is Required";
	}
	
	if (isset($_REQUEST['STU_Phonenum']) && $_REQUEST['STU_Phonenum']) {
		$data['STU_Phonenum'] = strip_tags($_REQUEST['STU_Phonenum']);
		$sql_params['STU_Phonenum'] = $data['STU_Phonenum'];
	} else {
		$error = "Phone Number is Required";
	}




if (!$error) {
		// Takes the paramter keys and makes a string in the form of "key1, key2, key3"
		$columns = implode(', ', array_keys($sql_params));
		// Takes the paramter keys and makes a string in the form of ":key1, :key2, :key3"
		$placeholders = ':'.implode(', :', array_keys($sql_params));
		
		// Build the SQL.
		$sql = "INSERT INTO STUDENT ({$columns}) VALUES ({$placeholders})";
		
		// Insert the record.
		$statement = $db->prepare($sql);
		if ($statement->execute($sql_params)) {
			$success = "Created user ".$sql_params['STU_Username'];
		} else {
			$sqlerror = $statement->errorInfo()[2];
		}
		
		
	}
	
	
}


output_header('register');



?>

        <div class="container">
	        <div class="row" id="main">
		        <div class="col-sm-6 col-sm-offset-3">
		        	<?php
	        		if ($success) {
	        			echo '<div class="alert alert-success text-center" role="alert">'.$success.'</div>';
	        		} else if ($sqlerror) {
	        			echo '<div class="alert alert-danger text-center" role="alert">'.$sqlerror.'</div>';
	        		} else {
		        	?>
		            <form class="form-horizontal" method="post">
		            	<?php
		            	if ($error) {
		            		echo '<div class="col-xs-12"><div class="alert alert-danger text-center" role="alert">'.$error.'</div></div>';
		            		
		            	}
		            	?>
		            	
		                <div class="form-group">
		                    <label class="control-label col-sm-3" for="email">Email:</label>
		                    <div class="col-sm-9">
		                        <input type="STU_Email" class="form-control" name="STU_Email" placeholder="Email" value="<?= $data['STU_Email'] ?>">
		                    </div>
		                </div>
		                
		                <div class="form-group">
		                    <label class="control-label col-sm-3" for="STU_Address">Address:</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" name="STU_Address" placeholder="Address" value="<?= $data['STU_Address'] ?>">
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-sm-3" for="STU_Phonenum">Phone Number:</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" name="STU_Phonenum" placeholder="Phone number" value="<?= $data['STU_Phonenum'] ?>">
		                    </div>
		                </div>
		                <div class="form-group">
		                    <div class="col-sm-offset-3 col-sm-7">
		                        <button type="update" name="update" class="btn btn-default">Update</button>
		                    </div>
		                </div>
		            </form>
		            <?php
	        		}
		            ?>
		        </div>
	        </div>
        </div>

</body>
</html>