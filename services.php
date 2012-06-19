<?php
include "include/menu-sub-ser.php.inc";

//Delete selected customer
if(isset($_GET['delid']))
{
    sql::deleteService($_GET['delid']);

}
//Get all customers
$serviceArr = sql::GetAllServices($_GET['vid']);
$vehicle = sql::getVehicle($_GET['vid']);

?>
<script language="JavaScript" type="text/javascript">
function editService(id,vid)
{
   window.location = "edit-service.php?id="+id+"&vid="+vid;

}
function delService(id)
{
    var r=confirm("Do you really want to delete this service record from the system?");
    if (r==true)
    {
        window.location = "services.php?delid="+id+"&vid=<?php echo $_GET['vid']; ?>";
    }
}
</script>

<div id="services">
    <div><h2>Service Records for <?php echo $vehicle['plate_no']; ?></h2></div>
    <?php
    if((isset($_GET['s']))&&($_GET['s'] == 1))
    {?>
        <div id="uploaderMessages" class="message">
            <p>New service record added to the system successfully!</p>
        </div>
    <?php }
    else if ((isset($_GET['s']))&&($_GET['s'] == 2))
    {?>
    <div id="uploaderMessages" class="message">
            <p>Service record updated on the system successfully!</p>
        </div>
    <?php } ?>

<?php if($serviceArr != null){ ?>
    <table border="0px" cellspacing="0px">
        <thead>
            <tr>
                <td>Odometer</td>
                <td>Next Service</td>
                <td>Service Date</td>
                <td>Service Description</td>
                <td>Notes</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach($serviceArr as $service)
            {
                extract($service);
                if($next_service != '0000-00-00')
                {
                    $next_service_date = $next_service;
                }
                else
                {
                    $next_service_date = '';
                }
                if($i % 2 == 0)
                {
                    echo '<tr id="rowColor">';
                    echo    '<td>'.$odometer.'</td>';
                    echo    '<td>'.$next_service_date.'</td>';
                    echo    '<td>'.$create_date.'</td>';
                    echo    '<td>'.$service_desc.'</td>';
                    echo    '<td><div style="word-wrap:break-word;">'.$notes.'</div></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="editService('.$id.','.$vehicle_id.')">
                        <img src="assets/images/edit-icon.jpg" class="image"
                        alt="Edit Customer" height="24px" width="24px"></a></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="delService('.$id.')">
                        <img src="assets/images/delete-icon.jpg" class="image"
                        alt="Delete Customer" height="24px" width="24px"></a></td>';
                    echo '</tr>';
                }
                else
                {
                    echo '<tr id="rowColorAlt">';
                    echo    '<td>'.$odometer.'</td>';
                    echo    '<td>'.$next_service_date.'</td>';
                    echo    '<td>'.$create_date.'</td>';
                    echo    '<td>'.$service_desc.'</td>';
                    echo    '<td><div style="word-wrap:break-word;">'.$notes.'</div></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="editService('.$id.','.$vehicle_id.')">
                        <img src="assets/images/edit-icon.jpg" class="image"
                        alt="Edit Customer" height="24px" width="24px"></a></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="delService('.$id.')">
                        <img src="assets/images/delete-icon.jpg" class="image"
                        alt="Delete Customer" height="24px" width="24px"></a></td>';
                    echo '</tr>';
                }
                $i++;
                $navigation = $nav;
            }
            ?>
        </tbody>
        <tfoot>
            <tr id="navigation">
                <td colspan="8"><?php echo $navigation; ?></td>
            </tr>
        </tfoot>
    </table>
    <?php } else { ?>
    <p>There are no service records for this vehicle.</p>
    <?php } ?>
</div>

<?php
include "include/footer.php.inc";
?>