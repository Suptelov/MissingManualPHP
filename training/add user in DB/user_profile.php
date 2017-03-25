<?php
        // подключаемся к бд
 require_once("../database_connection.php");
   /* require("../app_config.php");
    $link=mysqli_connect(DATABASE_HOST, USERNAME, PASSWORD)
        or die("<p>Error, cant connect to selected database</p>");
    $db=mysqli_select_db($link,DATABASE_NAME)
        or die("Error then programm try choose database". mysql_error()."</p>");*/
        
        //нужен ид пользователя чтобы спросить у сервера его данные
    $user_id=$_REQUEST['user_id'];
        
    $select_user="SELECT first_name, last_name, email, facebook_url,twitter_handle, bio
    FROM users
    WHERE user_id=".$user_id.";";
        // запрос серверу "вытащить из таблицы users пользователя  с id какой передали в пременной user_id
    $selected_user=mysqli_query($link, $select_user);
        // преобразуем ответ сервера в массив, вытаскиваем из него требуемые для нас значения для заполнения полей формы
    if ($selected_user)
    {
        $row=mysqli_fetch_array($selected_user);
        $first_name=$row['first_name'];
        $last_name=$row['last_name'];
        $bio = preg_replace("/[\r\n]+/", "</p><p>", $row['bio']);
        $email=$row['email'];
        $facebook_url=$row['facebook_url'];
        $twitter_handle=$row['twitter_handle'];
    }
    $twitter_url="http://www.twitter.com/".$twitter_handle;
        $regexpVK='/vk.com/';
        $matches=preg_match($regexpVK, $facebook_url);
    if ($matches===0){
        $facebook_url="http://www.vk.com/".$facebook_url;
    }
 
?>
<html>
    
    <head>
        <title>User profile</title>
        <style>
            img{
                display: block;
                width: 200px;
                margin:40px;
                margin-left:300px;              
                
            }
            li{
                border:2px solid grey;
                display: inline-block;
                padding 10px;
                margin:20px;
                
            }
            
        </style>
    </head>
    <body>
        
        
       <h1><?php echo "{$first_name} {$last_name}"; ?>,hello,  This is Your profile page in our web site</h1>
        <div>
            <p><img src="<?php echo $user_image; ?>" alt="user avatar"/>
               <?php echo $bio; ?> 
            </p>
            <p>You can contact with <?php echo $first_name; ?>   by:</p>
            <ul>
                <li>
                    <a href="<?php echo $email; ?>">Email</a>
                </li>
                <li>
                    <a href="<?php echo $facebook_url;?>">The vk page</a>
                </li>
                <li>
                    <a href="<?php echo "$twitter_url";?> ">Twitter account of <?php echo "$first_name"; ?></a>
                </li>
            </ul>
            
   
        </div>
    </body>


</html>