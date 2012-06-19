<?php
include "include/menu-sub-sub-make-add.php.inc";
$makeArr = sql::getMakeDetails($_GET['id']);
?>
<div id="makeEdit">
    <div><h2>Edit Make</h2></div>
    <form id="frmMakeEdit" name="frmMakeEdit" method="post"
      enctype="multipart/form-data" action="make-edit-comp.php">

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
                                         $postback['make']:$makeArr['name']; ?>"/>
            <span id="description">Ex: Toyota   /   Nissan  /   Audi</span></div>
        </div>
        <div id="regBtn">
                <div class="rf_label"><input type="hidden" name="id"
                                             value="<?php echo $_GET['id']; ?>"></div>
                <div class="rf_input"><input type="submit" name="btnRegister" value="Update Make">
                </div>
        </div>
    </form>
</div>
<?php
include "include/footer.php.inc";
?>