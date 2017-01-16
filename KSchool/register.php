<?php
require('lib/lib.php');
// Setup an array of data that will be used to re-display to the user if needed.

$data = array('STU_Username' => '', 'STU_Password' => '', 'STU_Fname' => '', 'STU_Lname' => '', 'STU_Email' => '', 'STU_DOB' => '', 'STU_Address' => '', 'STU_Phonenum' => '', 'STU_Guard' => '', 'STU_Status' => '', 'STU_Age' => '');
$error = false;
$success = false;
$sqlerror = false;

if (isset($_REQUEST['submission'])) {
	// Variable that we will insert a string into if there is an error to display.
	
	// An array that will hold parameters to insert the record.
	$sql_params = array();
	// For each input check if it set, if so set the data object and the params object.
	if (isset($_REQUEST['STU_Username']) && $_REQUEST['STU_Username']) {
		$data['STU_Username'] = strip_tags($_REQUEST['STU_Username']);
		$sql_params['STU_Username'] = $data['STU_Username'];
		
		// For the username, we need to check if another user already exists.
		$statement = $db->prepare("SELECT * FROM STUDENT WHERE STU_Username = ?");
		$statement->execute(array($_REQUEST['STU_Username']));
		// If the count of rows is more than 0, then the username is taken.
		if ($statement->rowCount() > 0) {
			$error = "Username Taken";
		}
	} else {
		$error = "Username Required";
	}
	
	if (isset($_REQUEST['STU_Password']) && $_REQUEST['STU_Password']) {
		$sql_params['STU_Password'] = password_hash($_REQUEST['STU_Password'], PASSWORD_DEFAULT);
	} else {
		$error = "Password Required";
	}
	
	if (isset($_REQUEST['STU_Fname']) && $_REQUEST['STU_Fname']) {
		$data['STU_Fname'] = strip_tags($_REQUEST['STU_Fname']);
		$sql_params['STU_Fname'] = $data['STU_Fname'];
	} else {
		$error = "First Name is Required";
	}
	
	if (isset($_REQUEST['STU_Lname']) && $_REQUEST['STU_Lname']) {
		$data['STU_Lname'] = strip_tags($_REQUEST['STU_Lname']);
		$sql_params['STU_Lname'] = $data['STU_Lname'];
	} else {
		$error = "Last Name is Required";
	}
	
	if (isset($_REQUEST['STU_Email']) && $_REQUEST['STU_Email']) {
		$data['STU_Email'] = strip_tags($_REQUEST['STU_Email']);
		$sql_params['STU_Email'] = $data['STU_Email'];
	} else {
		$error = "Email Required";
	}
	
	if (isset($_REQUEST['STU_DOB']) && $_REQUEST['STU_DOB']) {
		$data['STU_DOB'] = strip_tags($_REQUEST['STU_DOB']);
		$sql_params['STU_DOB'] = $data['STU_DOB'];
	} else {
		$error = "Date of Birth is Required";
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
	
	if (isset($_REQUEST['STU_Guard']) && $_REQUEST['STU_Guard']) {
		$data['STU_Guard'] = strip_tags($_REQUEST['STU_Guard']);
		$sql_params['STU_Guard'] = $data['STU_Guard'];
	} else {
		$error = "Guardian/Parent Name is Required";
	}
	
	if (isset($_REQUEST['STU_Status']) && $_REQUEST['STU_Status']) {
		$data['STU_Status'] = strip_tags($_REQUEST['STU_Status']);
		$sql_params['STU_Status'] = $data['STU_Status'];
	} 
	
	
	if (isset($_REQUEST['STU_Age']) && $_REQUEST['STU_Age']) {
		$data['STU_Age'] = strip_tags($_REQUEST['STU_Age']);
		$sql_params['STU_Age'] = $data['STU_Age'];
	} 
	
	$belt = $_POST['STU_Status'];
	$query="INSERT INTO STUDENT (STU_Status)VALUE ('".$belt."')";
	
	$age = $_POST['STU_Age'];
	$query="INSERT INTO STUDENT (STU_Age)VALUE ('".$age."')";
	
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
		                    <label class="control-label col-sm-3" for="STU_Username">Username:</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" name="STU_Username" placeholder="Username" value="<?= $data['STU_Username'] ?>">
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-sm-3" for="STU_Password">Password:</label>
		                    <div class="col-sm-9">
		                        <input type="password" class="form-control" name="STU_Password" placeholder="Password" value="">
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-sm-3" for="STU_Fname">First Name:</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" name="STU_Fname" placeholder="First Name" value="<?= $data['STU_Fname'] ?>">
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-sm-3" for="STU_Lname">Last Name:</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" name="STU_Lname" placeholder="Last Name" value="<?= $data['STU_Lname'] ?>">
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-sm-3" for="STU_Email">Email:</label>
		                    <div class="col-sm-9">
		                        <input type="STU_Email" class="form-control" name="STU_Email" placeholder="Email" value="<?= $data['STU_Email'] ?>">
		                    </div>
		                </div>
		                
		                <div class="form-group">
		                    <label class="control-label col-sm-3" for="STU_DOB">Date of Birth:</label>
		                    <div class="col-sm-9">
		                        <input type="date" class="form-control" name="STU_DOB" placeholder="Date of Birth" value="<?= $data['STU_DOB'] ?>">
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-sm-3" for="STU_Address">Address:</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" name="STU_Address" placeholder="Full Address" value="<?= $data['STU_Address'] ?>">
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-sm-3" for="STU_Phonenum">Phone Number:</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" name="STU_Phonenum" placeholder="Phone Number" value="<?= $data['STU_Phonenum'] ?>">
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="control-label col-sm-3" for="STU_Guard">Guardian/Parent Name:</label>
		                    <div class="col-sm-9">
		                        <input type="text" class="form-control" name="STU_Guard" placeholder="Name of Parent/Guardian" value="<?= $data['STU_Guard'] ?>">
		                    </div>
		                </div>
		                
		               
		            <div class="form-group">
					<label class="control-label col-sm-3" for="STU_Status">Belt Color:</label>
					<div class="col-sm-9">
						<form action='' method='post'>
							<select class="form-control" name="STU_Status" value="<?= $data['STU_Status'] ?>">
								<option name="White" value="1">White</option>
								<option name="Orange" value="2">Orange</option>
								<option name="Yellow" value="3">Yellow</option>
								<option name="Camo" value="4">Camo</option>
								<option name="Green" value="5">Green</option>
								<option name="Purple" value="6">Purple</option>
								<option name="Blue" value="7">Blue</option>
								<option name="Brown" value="8">Brown</option>
								<option name="Red" value="9">Red</option>
								<option name="Black 1" value="10">Black 1</option>
								<option name="Black 2" value="11">Black 2</option>
								<option name="Black 3" value="12">Black 3</option>
								<option name="Black 4" value="13">Black 4</option>
								<option name="Black 5" value="14">Black 5</option>
								<option name="Black 6" value="15">Black 6</option>
								<option name="Black 7" value="16">Black 7</option>
								<option name="Black 8" value="17">Black 8</option>
								<option name="Black 9" value="18">Black 9</option>
						</form>
						</select>
					</div>
				</div>
		               
		            <div class="form-group">
					<label class="control-label col-sm-3" for="STU_Age">Age:</label>
					<div class="col-sm-9">
						<form action='' method='post'>
							<select class="form-control" name="STU_Age" value="<?= $data['STU_Age'] ?>">
								<option name="4-6" value="1">4-6</option>
								<option name="7-9" value="2">7-9</option>
								<option name="10-12" value="3">10-12</option>
								<option name="13-15" value="4">13-15</option>
								<option name="16-17" value="5">16-17</option>
								<option name="18+" value="6">18+</option>
								</form>
								</select>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <div class="col-sm-offset-3 col-sm-7">
		                        <button type="submit" name="submission" class="btn btn-default">Submit</button>
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