<?php session_start(); ?>
<?php
require_once('validation.php');
require_once('sql.php');

if(isset($_POST['btnRegister']))
{
    //We put all the user input into the session
    $_SESSION['postbackVals']['customerNames'] = $_POST['customerNames'];
    $_SESSION['postbackVals']['plateNo'] = $_POST['plateNo'];
    $_SESSION['postbackVals']['makes'] = $_POST['makes'];
    $_SESSION['postbackVals']['model'] = $_POST['model'];
    $_SESSION['postbackVals']['oilType'] = $_POST['oilType'];
    $_SESSION['postbackVals']['notes'] = trim($_POST['notes']);

    //if the error session is set from a previous submit, then we remove that...
    if(isset($_SESSION['errors']))
    {
        unset($_SESSION['errors']);
    }
    //Checking for errors
    validation::isEmpty($_POST['plateNo'], 'plateNo', 'Plate No');

    //If there is a error in the input, we send the user back to the register
    //page to correct issues.
    if(isset($_SESSION['errors']))
    {
        echo "<script type=\"text/javascript\">window.location = \"add-vehicle.php\"</script>";
    }

    if((!isset($_SESSION['errors']))&&(isset($_POST['btnRegister']))) //If there are no errors we execute this...
    {
        unset($_SESSION['postbackVals']);
        //Lets save the user information...
        if(sql::saveVehicle() > 0)
        {
            echo "<script type=\"text/javascript\">window.location = \"vehicles.php?s=1\"</script>";
        }
    }
}
?>
