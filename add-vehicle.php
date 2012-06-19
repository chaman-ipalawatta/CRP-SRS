<?php
include "include/menu-sub-sub-veh-add.php.inc";
$customerNameArr = sql::getAllCustomerNames();
$makeArr = sql::getAllMakes();
$oilTypesArr = sql::getOilTypes();
if(isset($_SESSION['errors']))
{
    $modelArr = sql::getModelOfMake($_SESSION['postbackVals']['makes']);
}
?>

<script language="JavaScript" type="text/javascript">
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange(src, val) {
    
     var req = Inint_AJAX();
     req.onreadystatechange = function () {
          if (req.readyState==4) {
               if (req.status==200) {
                    document.getElementById(src).innerHTML=req.responseText; //retuen value
               }
          }
     };
     req.open("GET", "model-ajax.php?val="+val); //make connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=iso-8859-1"); // set Header
     req.send(null); //send value
}

function CountLeft(field, label, max)
{
    if (field.value.length > max)
        field.value = field.value.substring(0, max);
    else
        document.getElementById(label).innerHTML = '<span>'+(max - field.value.length) + ' Characters left</span>';
}
</script>

<div id="vehicleAdd">
    <div><h2>Add a Vehicle</h2></div>
    <form id="frmVehAdd" name="frmVehAdd" method="post"
      enctype="multipart/form-data" action="vehicle-add-comp.php">
        
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
        <div>
            <div class="rf_label"><label  id="customerNames" name="customerNames">
                    Customer<span class="required">*</span></label></div>
            <div class="rf_input"><select name="customerNames" id="customerNames">
                <?php
                    foreach ($customerNameArr as $array): ?>
                    <?php foreach ($array as $key=>$val): ?>
                        <?php if((isset($postback['customerNames']))&&($key == $postback['customerNames'])):?>
                            <option value="<?php echo $key ?>" selected="select"><?php echo $val ?></option>
                        <?php else: ?>
                            <option value="<?php echo $key ?>"><?php echo $val ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                 <?php endforeach; ?>
            </select></div>
        </div>
        <div id="plate">
            <div class="rf_label"><label>Plate No<span class="required">*</span></label></div>
            <div class="rf_input"><input type="textbox" id="plateNo" name="plateNo"
                                         maxlength="12" size="15"
                                         value="<?php echo (isset($postback['plate_no']))?
                                         $postback['plate_no']:""; ?>"/>
                <span id="description">Ex: 18-1234  /   WP-AA-1234  /   8-SRI-1234</span></div>
        </div>
        <div id="make">
            <div class="rf_label"><label>Make</label></div>
            <div class="rf_input"><select name="makes" id="makes" onchange="dochange('model',this.value)">
                    <option value="0">Select Make</option>
                <?php
                    foreach ($makeArr as $array): ?>
                    <?php foreach ($array as $key=>$val): ?>
                        <?php if((isset($postback['makes']))&&($key == $postback['makes'])):?>
                            <option value="<?php echo $key ?>" selected="select"><?php echo $val ?></option>
                        <?php else: ?>
                            <option value="<?php echo $key ?>"><?php echo $val ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                 <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div id="models">
            <div class="rf_label"><label>Model</label></div>
            <div class="rf_input">
                <select name="model" id="model">
                    <?php if(isset($postback['model'])): ?>
                    <?php
                        foreach ($modelArr as $array)
                        {
                            foreach ($array as $key=>$val)
                            {
                                if($key == $postback['model'])
                                {
                                    echo '<option value="'. $key .'" selected="select">'.$val.'</option>';
                                }
                                else
                                {
                                    echo '<option value="'. $key .'">'.$val.'</option>';
                                }
                            }
                        }
                    ?>
                    <?php else: ?>
                        <option value="0">No Models</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div>
            <div class="rf_label"><label  id="oilType" name="oilType">
                     Oil Type<span class="required"></span></label></div>
            <div class="rf_input"><select name="oilType" id="oilType">
                    <option value="0">Select Oil Type</option>
                <?php
                    foreach ($oilTypesArr as $array): ?>
                    <?php foreach ($array as $key=>$val): ?>
                        <?php if((isset($postback['oilType']))&&($key == $postback['oilType'])):?>
                            <option value="<?php echo $key ?>" selected="select"><?php echo $val ?></option>
                        <?php else: ?>
                            <option value="<?php echo $key ?>"><?php echo $val ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                 <?php endforeach; ?>
            </select></div>
        </div>
        <div id="notes">
                <div class="rf_label"><label>Notes</label></div>
                <div class="rf_input"><textarea rows="10" cols="50" id="notes" name="notes"
                        onKeyDown="CountLeft(this.form.notes,'sdCounter',500);"
                        onKeyUp="CountLeft(this.form.notes,'sdCounter',500);"><?php
                        echo (isset($postback['notes']))?trim($postback['notes']):""; ?></textarea>

                </div>
        </div>
        <div id="shortDescCounter">
                <div class="rf_label"></div>
                <div class="rf_input" id="sdCounter"><span>&nbsp;</span></div>
        </div>
        <div id="regBtn">
                <div class="rf_label"></div>
                <div class="rf_input"><input type="submit" name="btnRegister" value="Add Vehicle">
                </div>
        </div>
    </form>
</div>
<?php
include "include/footer.php.inc";
?>