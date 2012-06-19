<?php
include "include/menu.php.inc";
include "include/footer.php.inc";
?>
<div id="report-pos1"><?php include "include/monthlyRepairCount.php"; ?></div>
<div id="report-pos2"><?php include "include/mostServicedVehicles.php"; ?></div>
<div id="report-pos3-head"><h3>Due Services - Next 7 Days</h3></div>
<div id="report-pos3"><?php include "include/serviceDues.php"; ?></div>