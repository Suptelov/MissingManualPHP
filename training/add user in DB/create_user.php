<?php

// require_once проверяет подключен ли этот файл к сценарию, если нет то подключает.
 require_once("../database_connection.php");
    /*$link=mysqli_connect(DATABASE_HOST, USERNAME, PASSWORD)
        or die("<p>Error, cant connect to selected database</p>");
    $db=mysqli_select_db($link,DATABASE_NAME)
        or die("Error then programm try choose database". mysql_error()."</p>");*/
   

    $first_name=trim($_REQUEST['first-name']);
    $last_name=trim($_REQUEST['last-name']);
    $email=trim($_REQUEST['email']);
    $bio=trim($_REQUEST['bio']);
    $facebook_url=trim($_REQUEST['facebook-url']);
    
    $regexpF='/vk\.com/i';
    if (!preg_match($regexpF, $facebook_url)){
        $facebook_url="http://www.vk.com/".$facebook_url;
    }
    $twitter_handle=trim($_REQUEST['twitter-handle']);
    $twitter_url="http://www.twitter.com/";
    $regexpT='/@/';
        if (preg_match($regexpT, $twitter_handle)){            
            $twitter_url=$twitter_url.$twitter_handle;
        }
        else    {
            $twitter_handle=substr($twitter_handle,1) ;
            $twitter_url=$twitter_url.$twitter_handle;
        }
// вставляем в базу данных вышеперданный набор значений
$insert_sql="INSERT INTO users(first_name, last_name, email, facebook_url, twitter_handle, bio)"."VALUES('{$first_name}','{$last_name}','{$email}','{$facebook_url}','{$twitter_handle}','{$bio}');";
mysqli_query($link, $insert_sql)
    or handle_error($user_error_message, mysqli_error());
      
  
   header("Location: user_profile.php?user_id=".mysqli_insert_id($link));
       ?>
<html>
    <head>
        <style>
            a{
                padding: 50px;
                display: inline-block;
                clear:both;
            }
            .bio{
                display: inline-block;
                border: 2px solid grey;
                margin:20px;
                padding:20px;
                
            }
        </style>
    </head>
    <body>
        <p>This is data structure from form</p>
    <div>
    <--!!-->Ох уж эти комментарии  в  HTML какой человек их придумал</--!!-->
        <p>
            Full Name:<?php echo $first_name." ". $last_name; ?>      <br/>
           
            Email:<?php echo $email ;?><br/>
            
        <p class="bio">   Biography : <?php echo $bio;?></p> 
           <a href="<?php echo $facebook_url;?>">Link on your vk page
               <img src="../images/vk.svg" width="80px">
            </a>  <br/>
            <a href="<?php echo $twitter_url;?>"> Link on your twitter page
                <img src="../images/twitter.svg" width="80px">
            </a>  
            <br/>
        </p>
    </div>
    </body>


</html>