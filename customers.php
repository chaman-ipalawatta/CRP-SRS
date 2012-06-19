<?php
include "include/menu-sub-cust.php.inc";

//Delete selected customer
if(isset($_GET['delid']))
{
    sql::deleteCustomer($_GET['delid']);

}
//Get all customers
$customerArr = sql::GetAllCustomers();
?>
<script language="JavaScript" type="text/javascript">
function editCustomer(id)
{
   window.location = "edit-customer.php?id="+id;

}
function delCustomer(id)
{
    var r=confirm("Do you really want to delete this customer from the system?");
    if (r==true)
    {
        window.location = "customers.php?delid="+id;
    }
}
</script>

<div id="customers">
    <div><h2>Customers</h2></div>
    <?php
    if((isset($_GET['s']))&&($_GET['s'] == 1))
    {?>
        <div id="uploaderMessages" class="message">
            <p>New customer added to the system successfully!</p>
        </div>
    <?php }
    else if ((isset($_GET['s']))&&($_GET['s'] == 2))
    {?>
    <div id="uploaderMessages" class="message">
            <p>Customer updated on the system successfully!</p>
        </div>
    <?php } 
    if($customerArr != null) {
    ?>

    <table border="0px" cellspacing="0px">
        <thead>
            <tr>
                <td><a href="customers.php">Name</a></td>
                <td>Address</td>
                <td>Telephone</td>
                <td>Telephone 2</td>
                <td>Mobile</td>
                <td>Email Address</td>
                <td>Notes</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach($customerArr as $customer)
            {
                extract($customer);
                if($i % 2 == 0)
                {
                    echo '<tr id="rowColor">';
                    echo    '<td>'.$name.'</td>';
                    echo    '<td>'.$address.'</td>';
                    echo    '<td>'.$tele1.'</td>';
                    echo    '<td>'.$tele2.'</td>';
                    echo    '<td>'.$mobile.'</td>';
                    echo    '<td>'.$email.'</td>';
                    echo    '<td><div style="word-wrap:break-word;">'.$notes.'</div></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="editCustomer('.$id.')">
                        <img src="assets/images/edit-icon.jpg" class="image"
                        alt="Edit Customer" height="24px" width="24px"></a></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="delCustomer('.$id.')">
                        <img src="assets/images/delete-icon.jpg" class="image"
                        alt="Delete Customer" height="24px" width="24px"></a></td>';
                    echo '</tr>';
                }
                else
                {
                    echo '<tr id="rowColorAlt">';
                    echo    '<td>'.$name.'</td>';
                    echo    '<td>'.$address.'</td>';
                    echo    '<td>'.$tele1.'</td>';
                    echo    '<td>'.$tele2.'</td>';
                    echo    '<td>'.$mobile.'</td>';
                    echo    '<td>'.$email.'</td>';
                    echo    '<td><div style="word-wrap:break-word;">'.$notes.'</div></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="editCustomer('.$id.')">
                        <img src="assets/images/edit-icon.jpg" class="image"
                        alt="Edit Customer" height="24px" width="24px"></a></td>';
                    echo    '<td style="width:24px;"><a href="#" onclick="delCustomer('.$id.')">
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
                <td colspan="9"><?php echo $navigation; ?></td>
            </tr>
        </tfoot>
    </table>
    <?php } else { ?>
    <span>There are no Customers available to display.</span>
    <?php } ?>
</div>
<?php
include "include/footer.php.inc";
?>