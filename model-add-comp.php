<?php session_start(); ?>
<?php
require_once('validation.php');
require_once('sql.php');

if(isset($_POST['btnRegister']))
{
    //We put all the user input into the session
    $_SESSION['postbackVals']['model'] = $_POST['model'];
    //if the error session is set from a previous submit, then we remove that...
    if(isset($_SESSION['errors']))
    {
        unset($_SESSION['errors']);
    }
    //Checking for errors
    validation::isEmpty($_POST['model'], 'model', 'Model');

    //If there is a error in the input, we send the user back to the register
    //page to correct issues.
    if(isset($_SESSION['errors']))
    {
        echo "<script type=\"text/javascript\">window.location = \"add-model.php?makeid=".$_POST['makeid']."\"</script>";
    }

    if((!isset($_SESSION['errors']))&&(isset($_POST['btnRegister']))) //If there are no errors we execute this...
    {
        unset($_SESSION['postbackVals']);
        //Lets save the user information...
        if(sql::saveModel($_POST['makeid']) > 0)
        {
            echo "<script type=\"text/javascript\">window.location = \"models.php?makeid=".$_POST['makeid']."&s=1\"</script>";
        }
    }
}
?>
