<?php
require('config.php');

session_start();

try {
    $db = new pdo( $CFG->dbDSN, $CFG->dbUserName, $CFG->dbPassword);
} catch ( PDOException $ex ) {
    die("Failed to connect to the database.");
}

$USER = new stdClass();

update_info();

function output_header($pageid = false) {
    global $USER;
    include('header.php');
}

function update_info() {
    global $USER;
    // Check the session.
    if (isset($_SESSION['STU_Username'])) {
        $USER->STU_Username = $_SESSION['STU_Username'];
    } else {
        $USER->STU_Username = false;
    }
    if (isset($_SESSION['STU_ID'])) {
        $USER->STU_ID = $_SESSION['STU_ID'];
    } else {
        $USER->STU_ID = false;
    }
    if (isset($_SESSION['STU_Password'])) {
        $USER->STU_Password = $_SESSION['STU_Password'];
    } else {
        $USER->Password = false;
    }
    if (isset($_SESSION['STU_Fname'])) {
        $USER->STU_Fname = $_SESSION['STU_Fname'];
    } else {
        $USER->STU_Fname = false;
    }
    if (isset($_SESSION['STU_Lname'])) {
        $USER->STU_Lname = $_SESSION['STU_Lname'];
    } else {
        $USER->STU_Lname = false;
    }
    if (isset($_SESSION['STU_Email'])) {
        $USER->STU_Email = $_SESSION['STU_Email'];
    } else {
        $USER->STU_Email = false;
    }
    if (isset($_SESSION['STU_DOB'])) {
        $USER->STU_DOB = $_SESSION['STU_DOB'];
    } else {
        $USER->STU_DOB = false;
    }
    if (isset($_SESSION['STU_Address'])) {
        $USER->STU_Address = $_SESSION['STU_Address'];
    } else {
        $USER->STU_Address = false;
    }
    if (isset($_SESSION['STU_Phonenum'])) {
        $USER->STU_Phonenum = $_SESSION['STU_Phonenum'];
    } else {
        $USER->STU_Phonenum = false;
    }
    if (isset($_SESSION['STU_Guard'])) {
        $USER->STU_Guard = $_SESSION['STU_Guard'];
    } else {
        $USER->STU_Guard = false;
    }
    if (isset($_SESSION['STU_Status'])) {
        $USER->STU_Status = $_SESSION['STU_Status'];
    } else {
        $USER->STU_Status = false;
    }
    if (isset($_SESSION['STU_Age'])) {
        $USER->STU_Age = $_SESSION['STU_Age'];
    } else {
        $USER->STU_Age = false;
    }
}

?>