<?php
include "include/menu-sub-sub-ser-add.php.inc";
$vehicle = sql::getVehicle($_GET['vid']);
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
        document.getElementById(label).innerHTML = '<span class="sdCounter">'+(max - field.value.length) + ' Characters left</span>';
}
</script>

<div id="serviceAdd">
    <div><h2>Add a Service Record for <?php echo $vehicle['plate_no']; ?></h2></div>
    <form id="frmSerAdd" name="frmSerAdd" method="post"
      enctype="multipart/form-data" action="service-add-comp.php">

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
            <div class="rf_label"><label>Odometer</label></div>
            <div class="rf_input"><input type="textbox" id="odometer" name="odometer"
                                         maxlength="12" size="15"
                                         value="<?php echo (isset($postback['odometer']))?
                                         $postback['odometer']:""; ?>"/></div>
        </div>
        <div id="serviceDesc">
                <div class="rf_label"><label>Service Description</label></div>
                <div class="rf_input"><textarea rows="10" cols="50" id="serviceDesc" name="serviceDesc"
                        onKeyDown="CountLeft(this.form.serviceDesc,'sdCounter1',500);"
                        onKeyUp="CountLeft(this.form.serviceDesc,'sdCounter1',500);"><?php
                        echo (isset($postback['serviceDesc']))?trim($postback['serviceDesc']):""; ?></textarea>

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
                        echo (isset($postback['notes']))?trim($postback['notes']):""; ?></textarea>

                </div>
        </div>
        <div id="shortDescCounter">
                <div class="rf_label"></div>
                <div class="rf_input" id="sdCounter" ><span>&nbsp;</span></div>
        </div>
        <div id="serviceDate">
            <div class="rf_label"><label>Service Date</label><span class="required">*</span></div>
            <div class="rf_input"><input type="textbox" id="serviceDate" name="serviceDate"
                                         maxlength="12" size="15"
                                         value="<?php echo (isset($postback['serviceDate']))?
                                         $postback['serviceDate']:""; ?>"/>
            <span id="description">Ex: YYYY-MM-DD (2011-12-04)</span></div>
        </div>
        <div id="nextService">
            <div class="rf_label"><label>Next Service</label></div>
            <div class="rf_input"><input type="textbox" id="nextService" name="nextService"
                                         maxlength="12" size="15"
                                         value="<?php echo (isset($postback['nextService']))?
                                         $postback['nextService']:""; ?>"/>
            <span id="description">Ex: YYYY-MM-DD (2011-12-04)</span></div>
        </div>
        <div id="regBtn">
                <div class="rf_label"><input type="hidden" name="id"
                                             value="<?php echo $_GET['vid']; ?>"></div>
                <div class="rf_input"><input type="submit" name="btnRegister" value="Add Service">
                </div>
        </div>
    </form>
</div>
<?php
include "include/footer.php.inc";
?>