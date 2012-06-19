<?php
class validation
{
    function validation()
    {

    }
    public static function isValidFile($file,$allowedExtensions,$size,$control,$controlName)
    {
        if($file['profile']['name'] != '')
        {
            if(!in_array($file['profile']['type'], $allowedExtensions))
            {
                $errMsg = '<span><strong>'.$controlName.'</strong> must be either in jpg, gif, png or bmp format</span>';
                $_SESSION['errors'][$control] = $errMsg;
            }
            else if($file['profile']['size'] > $size)
            {
                $errMsg = '<span><strong>'.$controlName.'</strong> must be less than '.($size/1024).'KB in size</span>';
                $_SESSION['errors'][$control] = $errMsg;
            }
        }
    }
    public static function isValidFileBulk(
            $error,
            $fileName,
            $fileType,
            $fileSize,
            $tmpName,
            $allowedExtensions,
            $size)
    {
        $isValid = true;
        if($error == 0)
        {
            if(!in_array($fileType, $allowedExtensions))
            {
                $errMsg = '<span><strong>'.$fileName.'</strong> file must be either in jpg, gif, png or bmp format</span>';
                $_SESSION['errors'][$tmpName] = $errMsg;
                $isValid = false;
            }
            else if($fileSize > $size)
            {
                $errMsg = '<span><strong>'.$fileName.'</strong> must be less than '.($size/1024).'KB in size</span>';
                $_SESSION['errors'][$tmpName] = $errMsg;
                $isValid = false;
            }
        }
        return $isValid;
    }
    public static function isEmpty($param, $control, $controlName)
    {
        if($param == '')
        {
            $errMsg = '<span><strong>'.$controlName.'</strong> cannot be empty</span>';
            $_SESSION['errors'][$control] = $errMsg;
        }
    }
    public static function isTelephone($param, $control, $controlName)
    {
        if(($param != '')&&(!preg_match('/[0]{1}\d{9}/', $param)))
        {

            $errMsg = '<span><strong>'.$controlName.'</strong> needs to be a number like 0712345678 or 0112123456</span>';
            $_SESSION['errors'][$control] = $errMsg;            
        }
    }
    public static function isValidNIC($param, $control, $controlName)
    {
        if($param == '')
        {
            $errMsg = '<span><strong>'.$controlName.'</strong> cannot be empty</span>';
            $_SESSION['errors'][$control] = $errMsg;
        }
        else if(!preg_match('/\d{9}v/', $param))
        {
            $errMsg = '<span><strong>'.$controlName.'</strong> needs to be a number like 701234567v</span>';
            $_SESSION['errors'][$control] = $errMsg;
        }
    }
    public static function isValidPassword($param, $param2, $len, $control, $controlName)
    {
        if($param == '')
        {
            $errMsg = '<span><strong>'.$controlName.'</strong> cannot be empty</span>';
            $_SESSION['errors'][$control] = $errMsg;
        }
        else if(strlen($param) < $len)
        {
            $errMsg = '<span><strong>'.$controlName.'</strong> needs to be more than '.$len.' characters</span>';
            $_SESSION['errors'][$control] = $errMsg;
        }
        else if($param != $param2)
        {
            $errMsg = '<span><strong>'.$controlName.'</strong> and re-typed password needs to match</span>';
            $_SESSION['errors'][$control] = $errMsg;
        }
    }
    public static function isValidEmail($param, $control, $controlName)
    {
        $exp = '/[a-z0-9_\-]+(\.[_a-z0-9\-]+)*@([_a-z0-9\-]+\.)+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)/';
        if(($param != '')&&(!preg_match($exp, $param)))
        {
            $errMsg = '<span><strong>'.$controlName.'</strong> needs to be a valid email address</span>';
            $_SESSION['errors'][$control] = $errMsg;
        }
        
    }
    public static function isValidURL($param, $control, $controlName)
    {
        $exp = '/([a-z]+:\/\/)?([a-z]([a-z0-9\-]*\.)+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}[0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])(:[0-9]{1,5})?(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&amp;]*)?)?(#[a-z][a-z0-9_]*)?/';
        if(($param != '')&&(!preg_match($exp, $param)))
        {
            $errMsg = '<span><strong>'.$controlName.'</strong> needs to be a valid website address</span>';
            $_SESSION['errors'][$control] = $errMsg;
        }

    }
    public static function isValidNumberRange($param, $min, $max ,$control, $controlName)
    {
        $exp = '/^[0-9]{'.$min.','.$max.'}$/';
        if(($param != '')&&(!preg_match($exp, $param)))
        {
            $errMsg = '<span><strong>'.$controlName.'</strong> needs to be a valid number in the range 0-999999</span>';
            $_SESSION['errors'][$control] = $errMsg;
        }

    }
    public static function isValidDate($param, $control, $controlName)
    {
        $exp = '/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/';
        if(($param != '')&&(!preg_match($exp, $param)))
        {
            $errMsg = '<span><strong>'.$controlName.'</strong> needs to be a valid date.</span>';
            $_SESSION['errors'][$control] = $errMsg;
        }

    }
}
?>
