<?php
require_once('configuration.php');

class helper
{
    function helper()
    {

    }
    public static function getFileCountInAlbumFolder($userId)
    {
        $folder = helper::getServerBasePath().'assets/images/users/'.$userId.'/album';
        $file = scandir($folder);
        foreach($file as $key => $value)
        {
            if(is_file($folder.'/'.$value))
            {
                $total++; // Counter
            }

        }

        return $total;
    }
    public static function getAllowedFileExts()
    {
        return array("image/pjpeg", "image/gif", "image/png",
        "image/pjpg", "image/bmp", "image/jpeg", "image/jpg");
    }
    public static function findexts($filename)
    {
        $filename = strtolower($filename);
        $exts = split("[/\\.]", $filename);
        $n = count($exts)-1;
        $exts = $exts[$n];
        return $exts;
    }
    public static function getServerBasePath()
    {
        return $GLOBALS['configuration']['abspath'];
    }
    public static function getDomain()
    {
        return $GLOBALS['configuration']['domain'];
    }
    public static function getAllowedImageLimit()
    {
        return $GLOBALS['configuration']['photolimit'];
    }
    public static function urlEncode($string)
    {
        $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', 
            '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F',
            '%3F', '%25', '%23', '%5B', '%5D');
        $replacements = array('!', '*', "'", "(", ")",
            ";", ":", "@", "&", "=", "+", "$",
            ",", "/", "?", "%", "#", "[", "]");
        return str_replace($entities, $replacements, urlencode($string));
    }
}

?>
