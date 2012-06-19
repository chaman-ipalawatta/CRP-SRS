<?php
session_start();
include_once('sql.php');
require_once 'gChart.php';
?>
<html>
    <head>
        <title>CRP Engineering Service Record System</title>
        <link href="assets/style.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <div id="menu">
            <ul>
                <li><span><a href="vehicles.php">Vehicles</a></span></li>
                <li>| -- |</li>
                <li><a href="customers.php">Customers</a></li>
                <li><a href="make.php">Make/Model</a></li>
                <li><a href="sql_backup.php">Backup Database</a></li>
            </ul>
        </div>
