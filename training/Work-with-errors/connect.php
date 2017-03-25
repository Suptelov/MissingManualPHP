<?php

require_once '../app_config.php';

    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once($root."\\\\training\database_connection.php");
    if (!$link) 
        
   {    
        handle_error($user_error_message, $system_error_message);
       /*// в случае ошибки пользовательской
        $user_error_message = "we have some problem with our db ";
        // перенапрвляем на сценарий с ошибкой, и передаем в урле саму ошибку
        $system_error_message = mysqli_error();
        header("Location: ../error.php?" .
        "error_message={$user_error_message}&" .
        "system_error_message={$system_error_message}");
        exit(); */
   }
    echo "<p>Successfull connection</p>" ;
    $db=mysqli_select_db($link,DATABASE_NAME )
        or die("Error then programm try choose database". mysqli_error()."</p>");
    echo "<p> You was connected MySQL database @training@ </p>";



    $res=mysqli_query($link,"SHOW TABLES;");
    if(!$res){die ("<p>Error in da building</p>");};
    echo "<p>Table exist on that moment in DB</p>";
    echo"<ul>";
        while ($row=mysqli_fetch_row($res))
        {
            echo "<li>Table:{$row[0]} </li>";  
        }
    echo"</ul>";


?>