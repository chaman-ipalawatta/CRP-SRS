<?php session_start(); ?>
<?php
require_once('validation.php');
require_once('sql.php');

if(isset($_POST['btnRegister']))
{
    //We put all the user input into the session
    $_SESSION['postbackVals']['odometer'] = $_POST['odometer'];
    $_SESSION['postbackVals']['serviceDesc'] = $_POST['serviceDesc'];
    $_SESSION['postbackVals']['serviceDate'] = $_POST['serviceDate'];
    $_SESSION['postbackVals']['nextService'] = $_POST['nextService'];
    $_SESSION['postbackVals']['notes'] = trim($_POST['notes']);

    //if the error session is set from a previous submit, then we remove that...
    if(isset($_SESSION['errors']))
    {
        unset($_SESSION['errors']);
    }
    //Checking for errors
    validation::isValidNumberRange($_POST['odometer'], 1, 6, 'odometer', 'Odometer');
    validation::isValidDate($_POST['nextService'], 'nextService', 'Next Service');
    validation::isValidDate($_POST['serviceDate'], 'serviceDate', 'Service Date ');
    validation::isEmpty($_POST['serviceDate'], 'serviceDate', 'Service Date ');

    //If there is a error in the input, we send the user back to the register
    //page to correct issues.
    if(isset($_SESSION['errors']))
    {
        echo "<script type=\"text/javascript\">window.location = \"add-service.php?vid=".$_POST['id']."\"</script>";
    }

    if((!isset($_SESSION['errors']))&&(isset($_POST['btnRegister']))) //If there are no errors we execute this...
    {
        unset($_SESSION['postbackVals']);
        //Lets save the user information...
        if(sql::saveService() > 0)
        {
            echo "<script type=\"text/javascript\">window.location = \"services.php?vid=".$_POST['id']."&s=1\"</script>";
        }
    }
}
?>
