<?php
include "include/menu-sub-sub-make-add.php.inc";
?>
<div id="MakeAdd">
    <div><h2>Add Make</h2></div>
    <form id="frmMakeAdd" name="frmMakeAdd" method="post"
      enctype="multipart/form-data" action="make-add-comp.php">

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
            <div class="rf_label"><label>Make<span class="required">*</span></label></div>
            <div class="rf_input"><input type="textbox" id="make" name="make"
                                         maxlength="30" size="20"
                                         value="<?php echo (isset($postback['make']))?
                                         $postback['make']:""; ?>"/>
                <span id="description">Ex: Toyota   /   Nissan  /   Audi</span></div>
        </div>
        <div id="regBtn">
                <div class="rf_label"></div>
                <div class="rf_input"><input type="submit" name="btnRegister" value="Add Make">
                </div>
        </div>
    </form>
</div>
<?php
include "include/footer.php.inc";
?>