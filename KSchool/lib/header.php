<!DOCTYPE html>
<html lang="en">
    <head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>KSchool!</title>

<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<style type="text/css">
    body {
        background-color: #fff;
        padding-top:71px;
    }
    .q {
        font-style:italic;
    }
    .glyphicon {
        font-size:12px;
        padding-right:3px;
    }
    select.form-control {
        padding:6px 7px!important;
    }
    td {
        padding:15px!important;
        border-right:1px #ddd solid;
    }
    td:last-child {
        border-right:none!important;
    }
    th {
        padding:15px!important;
        border-bottom-width:1px!important;
        border-right:1px #ddd solid;
    }
    th:last-child {
        border-right:none!important;
    }
    tr:nth-child(odd) td {
        background:#f5f5f5!important;
    }
    tr:last-child {
        border-bottom:1px #ddd solid!important;
    }
    .jumbotron {
        margin:-20px 0px 0px 0px!important;
        padding:40px 0px 55px 0px!important;
        border-bottom:1px #ddd solid!important;
        background:#f5f5f5;
    }
    .jumbotron p {
        color:#999;
        font-style:italic;
        font-size:17px;
    }
    .navbar {
        background:#fff;
        border-radius:0px!important;
        border-width:0px 0px 1px 0px!important;
        box-shadow:none!important;
                
    }
    button {
        box-shadow:none!important;
        background:#fff!important;
        border-color:#ddd!important;
    }
    .navbar li.active a {
        background:#f8f8f8!important;
        box-shadow: inset 0 3px 9px rgba(0,0,0,.04)!important;
        border:#e1e1e1 solid; border-width:0px 1px;
    }
</style>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">KSchool!</a>
        </div>
    <div>
    <ul class="nav navbar-nav">
        <li <?= ($pageid == 'home') ? 'class="active"' : '' ?>><a href="index.php">
            <span class="glyphicon glyphicon-home"></span> Home</a></li>
    <?php if ($USER->STU_Username) { ?>
        <li <?= ($pageid == 'info') ? 'class="active"' : '' ?>>
            <a href="info.php">Information </a></li>
    <?php } ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <?php if ($USER->STU_Username) { ?>
        <li><a style="cursor:default!important; color:#777!important" href="#">
        <span class="glyphicon glyphicon-user"></span> Hello, <?= $USER->STU_Fname ? $USER->STU_Fname : "you" ?>!</a></li>
        <li <?= ($pageid == 'settings') ? 'class="active"' : '' ?>><a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
        <li><a href="login.php?logout=1&url=index.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        <?php } else { ?>
        <li <?= ($pageid == 'login') ? 'class="active"' : '' ?>><a href="login.php">Login</a></li>
        <li <?= ($pageid == 'register') ? 'class="active"' : '' ?>><a href="register.php">
        <span class="glyphicon glyphicon-check"></span> Register</a></li>
    <?php } ?>
    </ul>
    </div>
        </div>
    </nav>
</body>



