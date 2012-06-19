<?php
include "include/menu-sub-sub-ser-add.php.inc";
$serviceDetails = sql::getServiceDetails($_GET['id']);
$vehicle = sql::getVehicle($_GET['vid']);
?>

<script language="JavaScript" type="text/javascript">
function CountLeft(field, label, max)
{
    if (field.value.length > max)
        field.value = field.value.substring(0, max);
    else
        document.getElementById(label).innerHTML = '<span class="sdCounter">'+(max - field.value.length) + ' Characters left</span>';
}
</script>

<div id="serviceEdit">
    <div><h2>Edit a Service Record for <?php echo $vehicle['plate_no']; ?></h2></div>
    <form id="frmSerEdit" name="frmSerEdit" method="post"
      enctype="multipart/form-data" action="service-edit-comp.php">

        <?php if(isset($_SESSION['errors']))
        {?>
        <div id="Errors" class="error">
            <?php
                $errArr = $_SESSION['errors'];
                unset ($_SESSION['errors']);

                foreach($errArr as $item)
                {
                    print $item.'<br />';
                }
            ?>
        </div>
        <?php }
        if(isset($_SESSION['postbackVals']))
        {
            $postback = $_SESSION['postbackVals'];
            unset($_SESSION['postbackVals']);
        }
        ?>
        <div id="reqLegend"><span class="required">*</span> - denotes required fields</div>
        <div id="odometer">
            <div class="rf_label"><label>Odometer<span class="required"></span></label></div>
            <div class="rf_input"><input type="textbox" id="odometer" name="odometer"
                                         maxlength="12" size="15"
                                         value="<?php echo (isset($postback['odometer']))?
                                         $postback['odometer']:$serviceDetails['odometer']; ?>"/></div>
        </div>
        <div id="serviceDesc">
                <div class="rf_label"><label>Service Description</label></div>
                <div class="rf_input"><textarea rows="10" cols="50" id="serviceDesc" name="serviceDesc"
                        onKeyDown="CountLeft(this.form.serviceDesc,'sdCounter1',500);"
                        onKeyUp="CountLeft(this.form.serviceDesc,'sdCounter1',500);"><?php
                        echo (isset($postback['serviceDesc']))?
                                         trim($postback['serviceDesc']):$serviceDetails['serviceDesc'];
                        ?></textarea>

                </div>
        </div>
        <div id="shortDescCounter">
                <div class="rf_label"></div>
                <div class="rf_input" id="sdCounter1"><span>&nbsp;</span></div>
        </div>

        <div id="notes">
                <div class="rf_label"><label>Notes</label></div>
                <div class="rf_input"><textarea rows="10" cols="50" id="notes" name="notes"
                        onKeyDown="CountLeft(this.form.notes,'sdCounter',500);"
                        onKeyUp="CountLeft(this.form.notes,'sdCounter',500);"><?php
                        echo (isset($postback['notes']))?
                                         trim($postback['notes']):$serviceDetails['notes']; ?></textarea>

                </div>
        </div>
        <div id="shortDescCounter">
                <div class="rf_label"></div>
                <div class="rf_input" id="sdCounter" ><span>&nbsp;</span></div>
        </div>
        <div id="nextService">
            <div class="rf_label"><label>Next Service</label></div>
            <div class="rf_input"><input type="textbox" id="nextService" name="nextService"
                                         maxlength="12" size="15"
                                         value="<?php echo (isset($postback['nextService']))?
                                         $postback['nextService']:$serviceDetails['nextService']; ?>"/>
            <span id="description">Ex: YYYY-MM-DD (2011-12-04)</span></div>
        </div>
        <div id="regBtn">
                <div class="rf_label"><input type="hidden" name="id"
                                             value="<?php echo $_GET['id']; ?>"><input type="hidden" name="vid"
                                             value="<?php echo $_GET['vid']; ?>"></div>
                <div class="rf_input"><input type="submit" name="btnRegister" value="Update Service">
                </div>
        </div>
    </form>
</div>
<?php
include "include/footer.php.inc";
?>