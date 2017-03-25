<?php

// require_once проверяет подключен ли этот файл к сценарию, если нет то подключает.
    require_once("../database_connection.php");
    require_once( "../app_config.php");
// константа объявленная в app_config
   // $upload_dir= HOST_WWW_ROOT. "uploads/profile_pics/"; 
$upload_dir = "C:/Server/data/htdocs/training/uploads/profile_pics/";
    $image_fieldname="user_pic";

//создаем массив для отлова ошибок, но индексация ведется с 1 элта, а не 0, так как
// для работы программы php, если переменная error = 0, то все ок
// следовательно для того, чтобы не было конфликтов создается массив с индексами 1 и 
//более
    $php_errors=array(
            1=>'More then max size in php.ini',
            2=>'More then max size in php.ini',
            3=>'Not full file',
            4=>'User dont choose the file'
        );
// режем поля, чтобы не было пробелов
    $first_name =   trim($_REQUEST['first-name']);
    $last_name =    trim($_REQUEST['last-name']);
    $email =        trim($_REQUEST['email']);
    $bio =          trim($_REQUEST['bio']);
    $facebook_url = trim($_REQUEST['facebook-url']);
// определяем есть ли в урлах имена доменов и собака в случае твиттера
    $regexpF    =   '/vk\.com/i';

    if (!preg_match($regexpF, $facebook_url))
        {        
            $facebook_url="http://www.vk.com/".$facebook_url;
        }
    $twitter_handle  =  trim($_REQUEST['twitter-handle']);
    $twitter_url  =  "http://www.twitter.com/";

    $regexpT='/@/';
        if (preg_match($regexpT, $twitter_handle)){            
            $twitter_url=$twitter_url.$twitter_handle;
        }
        else    {
            $twitter_handle=substr($twitter_handle,1) ;
            $twitter_url=$twitter_url.$twitter_handle;
        }
    ($_FILES[$image_fieldname]['error']==0) 
        or handle_error("server can not take your image because", $php_errors[$_FILES[$image_fieldname]['error']]);


// проверка имени файла, чтобы функция не выкидывала встроенное сообщение ошибки 
//ставится @ в начало, если что-то не так то исполняется функция handle error
@is_uploaded_file($_FILES[$image_fieldname]['tmp_name'])
    or handle_error("what are u doing, bastard !","your name"."'{$_FILES[$image_fieldname]['tmp_name']}'" );

//Consolas
//для проверки является ил данный фалй изображением, проверяем его размер
// так как если это не изображение, то функция вернет ошибку
@getimagesize($_FILES[$image_fieldname]['tmp_name'])
    or handle_error("this is not pic","{$_FILES[$image_fieldname]['tmp_name']} ");


// именем файла на сервере будет служить тек время $now
// для создания уникального файла
// пока истина (ФайлСуществует (дирректория. текВремя.-. имяКотороеДалUSER)){ТекВремя++} 
$now=time();
while (file_exists($upload_filename=$upload_dir . $now . '-' . $_FILES[$image_fieldname]['name']))
    {$now++;}
@move_uploaded_file($_FILES[$image_fieldname]['tmp_name'], $upload_filename)
    or handle_error("возникла проблема сохранения вашего изображения " .
 "в его постоянном месте.",
 "ошибка, связанная с правами доступа при перемещении " .
 "файла в {$upload_filename}");
/*@move_uploaded_file($_FILES[$image_fieldname]['tmp_name'], $upload_filename)
 or handle_error("возникла проблема сохранения вашего изображения " .
 "в его постоянном месте.",
 "ошибка, связанная с правами доступа при перемещении " .
 "файла в {$_FILES[$image_fieldname]['error']}");
 */

// вставляем в базу данных вышеперданный набор значений
    $insert_sql="INSERT INTO users(first_name, last_name, email, facebook_url, twitter_handle, bio,user_pic_path)"."VALUES('{$first_name}','{$last_name}','{$email}','{$facebook_url}','{$twitter_handle}','{$bio}','{$upload_filename}');";
    mysqli_query($link, $insert_sql)
        or die("<p>Something goes wrong</p>");
    header("Location: user_profile.php?user_id=".mysqli_insert_id($link));
           exit();?>
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
    <--!!-->Ох уж эти комментарии  в  HTML, какой человек их придумал</--!!-->
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