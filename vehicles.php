<?php
include "include/menu-sub-veh.php.inc";


//Delete selected customer
if(isset($_GET['delid']))
{
    sql::deleteVehicle($_GET['delid']);
}
//Get all customers
$customerArr = sql::GetAllCustomers();
$customerNameArr = sql::getAllCustomerNames();

//Load vehicle for selected customer
if(isset($_POST['btnSearch']))
{
    unset ($_SESSION['selectedCustomer']);
    $vehicleArr = sql::GetAllCustomerVehiclesSearch();
}
else if(isset($_GET['cvid']))
{
    $_SESSION['selectedCustomer'] = $_GET['cvid'];
    if($_GET['cvid'] == 0)
    {
        $vehicleArr = sql::GetAllCustomerVehicles();
    }
    else
    {
        $vehicleArr = sql::GetCustomerVehicles($_GET['cvid']);
    }
}
else if(isset($_SESSION['selectedCustomer']))
{
    $vehicleArr = sql::GetCustomerVehicles($_SESSION['selectedCustomer']);
}
else //Get all vehicles
{
    $vehicleArr = sql::GetAllCustomerVehicles();
}


?>
<script language="JavaScript" type="text/javascript">
function loadCustomerVehicles(id)
{
    window.location = "vehicles.php?cvid="+id;
}
function editVehicle(id)
{
   window.location = "edit-vehicle.php?id="+id;

}
function delVehicle(id)
{
    var r=confirm("Do you really want to delete this vehicle from the system?");
    if (r==true)
    {
        window.location = "vehicles.php?delid="+id;
    }
}
function serviceVehicle(id)
{
    window.location = "services.php?vid="+id;
}
function serviceReport(id)
{
    window.location = "vehicleServiceRec.php?vid="+id;
}

</script>

<div id="vehiclesList">
<div><h2>Vehicles</h2></div>
    <form id="frmSearch" name="frmSearch" method="post"
      enctype="multipart/form-data" action="vehicles.php">
<?php
if((isset($_GET['s']))&&($_GET['s'] == 1))
{?>
    <div id="uploaderMessages" class="message">
        <p>New vehicle added to the system successfully!</p>
    </div>
<?php }
else if ((isset($_GET['s']))&&($_GET['s'] == 2))
{?>
<div id="uploaderMessages" class="message">
        <p>Vehicle updated on the system successfully!</p>
    </div>
<?php } else if ((isset($_GET['s']))&&($_GET['s'] == 3))
{?>
<div id="uploaderMessages" class="message">
        <p>Vehicle report generated successfully!</p>
    </div>
<?php } ?>
<div id="veh-top-controls">
    <div id="veh-top-cont-left">
    <label id="customerNames" name="customerNames">Customer</label>
    <select name="customerNames" id="customerNames" onchange="loadCustomerVehicles(this.value)">
        <option value="0" selected="selected">Select</option>
        <?php
            foreach ($customerNameArr as $array): ?>
            <?php foreach ($array as $key=>$val): ?>
                    <?php if($key == $_SESSION['selectedCustomer']): ?>
                            <option value="<?php echo $key ?>" selected="select"><?php echo $val ?></option>
                    <?php else: ?>
                            <option value="<?php echo $key ?>"><?php echo $val ?></option>
                    <?php endif; ?>
            <?php endforeach; ?>
         <?php endforeach; ?>
    </select>
    </div>
    <div id="veh-top-cont-right">
    <label id="searchLbl" name="searchLbl">Search by Plate No</label>
    <input type="textbox" id="searchBox" name="searchBox"
                                         maxlength="45" size="30"
                                         value=""/>
    <input type="submit" id="btnSearch" name="btnSearch" value="Search">
    </div>
</div>
<div id="vehicles">
    <?php if(isset($_POST['btnSearch'])){?>
        <div><span id="searchMsg">Search results for keyword "<?php echo $_POST['searchBox']; ?>"</span></div>
    <?php } ?>
    <?php if($vehicleArr != null): ?>
    <table border="0px" cellspacing="0px">
        <thead>
            <tr>
                <td>Plate No</td>
                <td>Make</td>
                <td>Model</td>
                <td>Oil Type</td>
                <td>Notes</td>
                <td>Last Service</td>
                <td>Last Update</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach($vehicleArr as $vehicle)
            {
                extract($vehicle);
                if($i % 2 == 0)
                {
                    echo '<tr id="rowColor">';
                    echo    '<td>'.$plate_no.'</td>';
                    echo    '<td>'.$make.'</td>';
                    echo    '<td>'.$model.'</td>';
                    echo    '<td>'.$oil_type.'</td>';
                    echo    '<td><div style="word-wrap:break-word;">'.$notes.'</div></td>';
                    echo    '<td>'.$last_service.'</td>';
                    echo    '<td>'.$update_date.'</td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="editVehicle('.$id.')">
                        <img src="assets/images/edit-icon.jpg" class="image"
                        alt="Edit Vehicle" height="24px" width="24px"></a></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="delVehicle('.$id.')">
                        <img src="assets/images/delete-icon.jpg" class="image"
                        alt="Delete Vehicle" height="24px" width="24px"></a></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="serviceVehicle('.$id.')">
                        <img src="assets/images/service-icon.jpg" class="image"
                        alt="Service Vehicle" height="24px" width="24px"></a></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="serviceReport('.$id.')">
                        <img src="assets/images/record-icon.jpg" class="image"
                        alt="Service Record" height="24px" width="24px"></a></td>';
                    echo '</tr>';
                }
                else
                {
                    echo '<tr id="rowColorAlt">';
                    echo    '<td>'.$plate_no.'</td>';
                    echo    '<td>'.$make.'</td>';
                    echo    '<td>'.$model.'</td>';
                    echo    '<td>'.$oil_type.'</td>';
                    echo    '<td><div style="word-wrap:break-word;">'.$notes.'</div></td>';
                    echo    '<td>'.$last_service.'</td>';
                    echo    '<td>'.$update_date.'</td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="editVehicle('.$id.')">
                        <img src="assets/images/edit-icon.jpg" class="image"
                        alt="Edit Vehicle" height="24px" width="24px"></a></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="delVehicle('.$id.')">
                        <img src="assets/images/delete-icon.jpg" class="image"
                        alt="Delete Vehicle" height="24px" width="24px"></a></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="serviceVehicle('.$id.')">
                        <img src="assets/images/service-icon.jpg" class="image"
                        alt="Service Vehicle" height="24px" width="24px"></a></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="serviceReport('.$id.')">
                        <img src="assets/images/record-icon.jpg" class="image"
                        alt="Service Record" height="24px" width="24px"></a></td>';
                    echo '</tr>';
                }
                $i++;
                $navigation = $nav;
            }
            ?>
        </tbody>
        <tfoot>
            <tr id="navigation">
                <td colspan="11"><?php echo $navigation; ?></td>
            </tr>
        </tfoot>
    </table>
    <?php else: ?>
        <p>There are no vehicles for this customer.</p>
    <?php endif;?>
</div>
</form>
</div>
<?php
include "include/footer.php.inc";
?>