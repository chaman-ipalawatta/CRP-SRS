<?php session_start(); ?>
<?php
require_once('validation.php');
require_once('sql.php');
if(isset($_POST['btnRegister']))
{
    //We put all the user input into the session
    $_SESSION['postbackVals']['odometer'] = $_POST['odometer'];
    $_SESSION['postbackVals']['serviceDesc'] = $_POST['serviceDesc'];
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
    //If there is a error in the input, we send the user back to the register
    //page to correct issues.
    if(isset($_SESSION['errors']))
    {
        echo "<script type=\"text/javascript\">window.location = \"edit-service.php?id=".
        $_POST['id']."&vid=".$_POST['vid']."\"</script>";
    }

    if((!isset($_SESSION['errors']))&&(isset($_POST['btnRegister']))) //If there are no errors we execute this...
    {
        unset($_SESSION['postbackVals']);
        //Lets save the user information...
        sql::updateService($_POST['id']);
        echo "<script type=\"text/javascript\">window.location = \"services.php?vid=".$_POST['vid']."&s=2\"</script>";
    }
}
?>
