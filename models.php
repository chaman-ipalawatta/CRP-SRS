<?php
include "include/menu-sub-model.php.inc";

//Delete selected customer
if(isset($_GET['delid']))
{
    sql::deleteModel($_GET['delid']);

}
$make = sql::getMakeDetails($_GET['makeid']);
//Get all models
$modelArr = sql::getModelOfMakeWithPagination($_GET['makeid']);
?>
<script language="JavaScript" type="text/javascript">
function editMake(id)
{
   window.location = "edit-model.php?modelid="+id;

}
function listModels(id)
{
   window.location = "models.php?makeid="+id;

}
function delMake(id,makeid)
{
    var r=confirm("Do you really want to delete this model from the system?");
    if (r==true)
    {
        window.location = "models.php?makeid="+makeid+"&delid="+id;
    }
}
</script>

<div id="modelsList">
    <div><h2>Models of <?php echo $make['name']; ?></h2></div>
    <?php
    if((isset($_GET['s']))&&($_GET['s'] == 1))
    {?>
        <div id="uploaderMessages" class="message">
            <p>New model added to the system successfully!</p>
        </div>
    <?php }
    else if ((isset($_GET['s']))&&($_GET['s'] == 2))
    {?>
    <div id="uploaderMessages" class="message">
            <p>Model updated on the system successfully!</p>
        </div>
    <?php } ?>

    <?php if($modelArr != null) { ?>
    <table border="0px" cellspacing="0px">
        <thead>
            <tr>
                <td>Name</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach($modelArr as $model)
            {
                 extract($model);
                    if($i % 2 == 0)
                    {
                        echo '<tr id="rowColor">';
                        echo    '<td>'.$name.'</td>';
                        echo    '<td style="width:24px;"><a href="#" onclick="editMake('.$id.')">
                            <img src="assets/images/edit-icon.jpg" class="image"
                            alt="Edit Make" height="24px" width="24px"></a></td>';
                        echo    '<td style="width:24px;"><a href="#" onclick="delMake('.$id.','.$_GET['makeid'].')">
                            <img src="assets/images/delete-icon.jpg" class="image"
                            alt="Delete Make" height="24px" width="24px"></a></td>';
                        echo '</tr>';
                    }
                    else
                    {
                        echo '<tr id="rowColorAlt">';
                        echo    '<td>'.$name.'</td>';
                        echo    '<td style="width:24px;"><a href="#" onclick="editMake('.$id.')">
                            <img src="assets/images/edit-icon.jpg" class="image"
                            alt="Edit Customer" height="24px" width="24px"></a></td>';
                        echo    '<td style="width:24px;"><a href="#" onclick="delMake('.$id.','.$_GET['makeid'].')">
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
    <p>There are no models available to display.</p>
    <?php } ?>
</div>
<?php
include "include/footer.php.inc";
?>