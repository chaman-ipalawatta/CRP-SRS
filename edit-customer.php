<?php
include "include/menu-sub-sub-cust-add.php.inc";

$customer = sql::getCustomer($_GET['id']);
//var_dump($customer);
?>
<div id="customerAddForm">
    <div><h2>Edit Customer</h2></div>
    <form id="frmCustEdit" name="frmCustEdit" method="post"
      enctype="multipart/form-data" action="cust-edit-comp.php">
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

        <div id="name">
            <div class="rf_label"><label>Full Name<span class="required">*</span></label></div>
            <div class="rf_input"><input type="textbox" id="name" name="name"
                                         maxlength="120" size="30"
                                         value="<?php echo (isset($postback['name']))?
                                         $postback['name']:$customer['name']; ?>"/></div>
        </div>
        <div id="address">
            <div class="rf_label"><label>Address</label></div>
            <div class="rf_input"><input type="textbox" id="address" name="address"
                                         maxlength="200" size="30"
                                         value="<?php echo (isset($postback['address']))?
                                         $postback['address']:$customer['address']; ?>"/></div>
        </div>
        <div id="tele1">
            <div class="rf_label"><label>Telephone 1</label></div>
            <div class="rf_input"><input type="textbox" id="tele1" name="tele1"
                                         maxlength="10" size="10"
                                         value="<?php echo (isset($postback['tele1']))?
                                         $postback['tele1']:$customer['tele1']; ?>"/>
            <span id="description">Ex: 0112123456</span></div>
        </div>
        <div id="tele2">
            <div class="rf_label"><label>Telephone 2</label></div>
            <div class="rf_input"><input type="textbox" id="tele2" name="tele2"
                                         maxlength="10" size="10"
                                         value="<?php echo (isset($postback['tele2']))?
                                         $postback['tele2']:$customer['tele2']; ?>"/>
            <span id="description">Ex: 0112123456</span></div>
        </div>
        <div id="mobile">
            <div class="rf_label"><label>Mobile</label></div>
            <div class="rf_input"><input type="textbox" id="mobile" name="mobile"
                                         maxlength="10" size="10"
                                         value="<?php echo (isset($postback['mobile']))?
                                         $postback['mobile']:$customer['mobile']; ?>"/>
        <span id="description">Ex: 0777123456</span></div>
        </div>
        <div id="email">
            <div class="rf_label"><label>Email</label></div>
            <div class="rf_input"><input type="textbox" id="email" name="email"
                                         maxlength="120" size="30"
                                         value="<?php echo (isset($postback['email']))?
                                         $postback['email']:$customer['email']; ?>"/>
            <span id="description">Ex: my.name@company.com</span></div>
        </div>
        <div id="notes">
                <div class="rf_label"><label>Notes</label></div>
                <div class="rf_input"><textarea rows="10" cols="50" id="notes" name="notes"
                        onKeyDown="CountLeft(this.form.notes,'sdCounter',500);"
                        onKeyUp="CountLeft(this.form.notes,'sdCounter',500);"><?php 
                        echo (isset($postback['notes']))?trim($postback['notes']):$customer['notes'];
                        ?></textarea>

                </div>
        </div>
        <div id="shortDescCounter">
                <div class="rf_label"></div>
                <div class="rf_input" id="sdCounter"><span>&nbsp;</span></div>
        </div>
        <div id="regBtn">
                <div class="rf_label"><input type="hidden" name="id"
                                             value="<?php echo $_GET['id']; ?>"></div>
                <div class="rf_input"><input type="submit" name="btnUpdate" value="Update Customer">
                </div>
        </div>
    </form>
</div>
<?php
include "include/footer.php.inc";
?>