<?php 
    define("DEBUG_MODE", true);
    define('DATABASE_HOST', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DATABASE_NAME', 'training');
    define('HOST_WWW_ROOT',"/training/" );
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);    
   // $apath=$root. "\\\\training\\error.php";
    function debug_print($message)
    {
        if (DEBUG_MODE)
        {
            echo $message;
        }
    }

   
    function handle_error($user_error_message, $system_error_message)
    {
        header("Location: " . $root . "/training/"."error.php?"."error_message={$user_error_message}&".
              "system_error_message={$system_error_message}");
        exit();
    }
?>