<?php session_start(); ?>
<?php
require_once('validation.php');
require_once('sql.php');

if(isset($_POST['btnUpdate']))
{
    //We put all the user input into the session
    $_SESSION['postbackVals']['name'] = $_POST['name'];
    $_SESSION['postbackVals']['address'] = $_POST['address'];
    $_SESSION['postbackVals']['tele1'] = $_POST['tele1'];
    $_SESSION['postbackVals']['tele2'] = $_POST['tele2'];
    $_SESSION['postbackVals']['mobile'] = $_POST['mobile'];
    $_SESSION['postbackVals']['email'] = $_POST['email'];
    $_SESSION['postbackVals']['notes'] = trim($_POST['notes']);

    //if the error session is set from a previous submit, then we remove that...
    if(isset($_SESSION['errors']))
    {
        unset($_SESSION['errors']);
    }
    //Checking for errors
    validation::isTelephone($_POST['tele1'], 'tele1', 'Telephone 1');
    validation::isTelephone($_POST['tele2'], 'tele2', 'Telephone 2');
    validation::isTelephone($_POST['mobile'], 'mobile', 'Mobile');
    validation::isValidEmail($_POST['email'], 'email', 'Email');
    validation::isEmpty($_POST['name'], 'name', 'Name');

    //If there is a error in the input, we send the user back to the register
    //page to correct issues.
    if(isset($_SESSION['errors']))
    {
        echo "<script type=\"text/javascript\">window.location = \"edit-customer.php?id=".$_POST['id']."\"</script>";
    }

    if((!isset($_SESSION['errors']))&&(isset($_POST['btnUpdate']))) //If there are no errors we execute this...
    {
        unset($_SESSION['postbackVals']);
        //Lets save the user information...
        sql::updateCustomer($_POST['id']);
        echo "<script type=\"text/javascript\">window.location = \"customers.php?s=2\"</script>";
    }
}
?>