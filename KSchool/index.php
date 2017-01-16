<?php
require('lib/lib.php');
session_start();

// Check the session.
if (isset($_SESSION['STU_Fname'])) {
	$fname = $_SESSION['STU_Fname'];
} else {
	$fname = false;
}

output_header('home');


if (isset($_REQUEST['logout'])) {
    session_unset();
    session_destroy();
    if (isset($_REQUEST['url'])) {
      $url = $_REQUEST['url'];
    } else {
      $url = 'index.php';
    }
    header( 'Location: '.$url, true, '307');
}

?>

        <div class="jumbotron">
          <div class="container">
	          <h1 class="text-center">Welcome to KSchool, <?= $fname ? $fname : "friend" ?>!</h1>
          </div>
        </div>
</body>
</html>