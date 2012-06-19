<?php session_start(); ?>
<?php
require_once('validation.php');
require_once('sql.php');

if(isset($_POST['btnRegister']))
{
    //We put all the user input into the session
    $_SESSION['postbackVals']['make'] = $_POST['make'];
    //if the error session is set from a previous submit, then we remove that...
    if(isset($_SESSION['errors']))
    {
        unset($_SESSION['errors']);
    }
    //Checking for errors
    validation::isEmpty($_POST['make'], 'make', 'Make');

    //If there is a error in the input, we send the user back to the register
    //page to correct issues.
    if(isset($_SESSION['errors']))
    {
        echo '<script type="text/javascript">window.location = "edit-make.php?id='.$_POST['id'].'"</script>';
    }

    if((!isset($_SESSION['errors']))&&(isset($_POST['btnRegister']))) //If there are no errors we execute this...
    {
        unset($_SESSION['postbackVals']);
        //Lets save the user information...
        sql::updateMake($_POST['id']);
        
        echo "<script type=\"text/javascript\">window.location = \"make.php?s=2\"</script>";
        
    }
}
?>
