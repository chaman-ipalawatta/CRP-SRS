<?php
include "include/menu-sub-make.php.inc";

//Delete selected customer
if(isset($_GET['delid']))
{
    sql::deleteMake($_GET['delid']);

}
//Get all customers
$makeArr = sql::GetAllVehicleMakes();
?>
<script language="JavaScript" type="text/javascript">
function editMake(id)
{
   window.location = "edit-make.php?id="+id;

}
function listModels(id)
{
   window.location = "models.php?makeid="+id;

}
function delMake(id)
{
    var r=confirm("Do you really want to delete this make from the system?");
    if (r==true)
    {
        window.location = "make.php?delid="+id;
    }
}
</script>

<div id="makesList">
    <div><h2>Make</h2></div>
    <?php
    if((isset($_GET['s']))&&($_GET['s'] == 1))
    {?>
        <div id="uploaderMessages" class="message">
            <p>New make added to the system successfully!</p>
        </div>
    <?php }
    else if ((isset($_GET['s']))&&($_GET['s'] == 2))
    {?>
    <div id="uploaderMessages" class="message">
            <p>Make updated on the system successfully!</p>
        </div>
    <?php } ?>
    <?php if($makeArr != null){ ?>
    <table border="0px" cellspacing="0px">
        <thead>
            <tr>
                <td>Name</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach($makeArr as $make)
            {
                extract($make);
                if($i % 2 == 0)
                {
                    echo '<tr id="rowColor">';
                    echo    '<td>'.$name.'</td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="editMake('.$id.')">
                        <img src="assets/images/edit-icon.jpg" class="image"
                        alt="Edit Make" height="24px" width="24px"></a></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="delMake('.$id.')">
                        <img src="assets/images/delete-icon.jpg" class="image"
                        alt="Delete Make" height="24px" width="24px"></a></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="listModels('.$id.')">
                        <img src="assets/images/list-icon.jpg" class="image"
                        alt="List Models" height="24px" width="24px"></a></td>';
                    echo '</tr>';
                }
                else
                {
                    echo '<tr id="rowColorAlt">';
                    echo    '<td>'.$name.'</td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="editMake('.$id.')">
                        <img src="assets/images/edit-icon.jpg" class="image"
                        alt="Edit Customer" height="24px" width="24px"></a></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="delMake('.$id.')">
                        <img src="assets/images/delete-icon.jpg" class="image"
                        alt="Delete Customer" height="24px" width="24px"></a></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="listModels('.$id.')">
                        <img src="assets/images/list-icon.jpg" class="image"
                        alt="List Models" height="24px" width="24px"></a></td>';
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
    <p>There are no makes available to display.</p>
    <?php } ?>
</div>
<?php
include "include/footer.php.inc";
?>