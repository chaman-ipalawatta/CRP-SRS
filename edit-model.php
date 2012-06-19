<?php
include "include/menu-sub-sub-model-add.php.inc";
$model = sql::getModelDetails($_GET['modelid']);
$make = sql::getMakeDetails($model['make_id']);
?>
<div id="modelEdit">
    <div><h2>Edit Model for <?php echo $make['name']; ?></h2></div>
    <form id="frmModelEdit" name="frmModelEdit" method="post"
      enctype="multipart/form-data" action="model-edit-comp.php">

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
            <div class="rf_label"><label>Model<span class="required">*</span></label></div>
            <div class="rf_input"><input type="textbox" id="model" name="model"
                                         maxlength="45" size="30"
                                         value="<?php echo (isset($postback['model']))?
                                         $postback['model']:$model['name']; ?>"/>
            <span id="description">Ex: 121  / B14   / A4    /   Sunny</span></div>
        </div>
        <div id="regBtn">
                <div class="rf_label"><input type="hidden" name="modelid"
                                             value="<?php echo $_GET['modelid']; ?>">
                    <input type="hidden" name="makeid"
                                             value="<?php echo $model['make_id']; ?>"></div>
                <div class="rf_input"><input type="submit" name="btnRegister" value="Update Model">
                </div>
        </div>
    </form>
</div>
<?php
include "include/footer.php.inc";
?>