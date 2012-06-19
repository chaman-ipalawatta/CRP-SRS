<?php
session_start();
include_once('sql.php');
?>
<html>
    <head>
        <title>CRP Engineering Service Record System</title>
        <link href="assets/style.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <div id="menu">
            <ul>
                <li><a href="services.php?vid=<?php echo $_GET['vid']; ?>">Back</a></li>
                <li><a href="index.php">Dashboard</a></li>
            </ul>
        </div>
