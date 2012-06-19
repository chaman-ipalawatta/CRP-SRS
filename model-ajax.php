<?php
include_once('sql.php');
//echo $_GET['val'];
$modelArr = sql::getModelOfMake($_GET['val']);
//var_dump($modelArr);exit();
    //set IE read from page only not read from cache
    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");

    header("content-type: application/x-javascript; charset=tis-620");

     
    foreach ($modelArr as $array)
    {
        foreach ($array as $key=>$val)
        {
            echo '<option value="'. $key .'">'.$val.'</option>';
        }
    }
?>