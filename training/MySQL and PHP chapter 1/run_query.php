<?php
    require("../app_config.php");
    $link=mysqli_connect(DATABASE_HOST, USERNAME, PASSWORD)
        or die("<p>Error, cant connect to selected database</p>");
    echo "Succesfull conection";
        $db=mysqli_select_db($link,DATABASE_NAME)
       or handle_error($user_error_message, mysqli_error());
    echo "<p> You was connected MySQL database @".DATABASE_NAME."@</p>";

    $query_text=$_REQUEST['query'];
    $query_text_copy=$query_text;
    $result=mysqli_query($link,$query_text);       
    $regexp="/^*(CREATE|UPDATE|DELETE|DROP|INSERT)/i";

// Регулярные варажения IN DA BUILDING
// MUST SEE
// Вот ЗДЕСЬ РЕГУЛЯРНЫЕ ВЫРАЖЕНИЯ
// * - говорит не важно сколько пробелов
// i - говорит, не важно какой регистр
// ^ - Искать регулярку в начале строки
     $return_rows = true;
     if ( preg_match("/^[\t\n\r ]* *(CREATE|INSERT|UPDATE|DELETE|DROP)/i", $query_text))
     {
         $return_rows=false;
     }        


    if(! $result )
    {
        die("<p>I can not execute this query @".$query_text."@ </p>");
    }
    if(!$return_rows)
    { 
        echo "<p>SQL query Successfully completed: ".$query_text."</p>" ;
    }
    else
    {        
        echo "<p>The Result of this requery</p>";
        echo "<ul>";
        while ($row=mysqli_fetch_assoc($result))
        {// вывод значений в html с отрисовкой по блокам и ненумированному списку
            foreach($row as $value)
            {   
                if(is_numeric($value))
                {
                    echo "<p>_____________________</p></br>";
                };
                echo "<li>".$value."</li>";
                            
            }
        }  
        echo "</ul>";
    }

?>