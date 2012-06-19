<?php
include_once('sql.php');
sql::nextServInformed($_GET['val']);
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");

    header("content-type: application/x-javascript; charset=tis-620");


    echo 'Client Informed';
?>
