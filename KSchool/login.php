<?php
require('lib/lib.php');


if (isset($_REQUEST['logout'])) {
    session_unset();
    session_destroy();
    $url = 'index.php';
    header( 'Location: '.$url, true, '307');
}


output_header('login');
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



