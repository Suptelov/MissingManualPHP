<?php

require'../app_config.php';
define('MYSQL_SERVER', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DB', 'training');

    $link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) 
        or die("Error: ".mysqli_error($link));
    if(!mysqli_set_charset($link, "utf8"))
    {
        printf("Error: ".mysqli_error($link));
    }
   
  echo "<p>Successfull connection</p>" ;

$db=mysqli_select_db($link,MYSQL_DB )
    or die("Error then programm try choose database". mysql_error()."</p>");
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