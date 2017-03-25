<?php
    $first_name=trim($_REQUEST['first-name']);
    $last_name=trim($_REQUEST['last-name']);
    $email=trim($_REQUEST['email']);
    $facebook_url=trim($_REQUEST['facebook-url']);
    $position=strpos($facebook_url, "vk.com");
    if ($position===false){
        $facebook_url="http://www.vk.com".$facebook_url;
    }
    $twitter_handle=trim($_REQUEST['twitter-handle']);
    $twitter_url="http://www.twitter.com/";
    $positionTwitter=strpos($twitter_handle, "@");
        if ($positionTwitter===false){            
            $twitter_url=$twitter_url.$twitter_handle;
        }
        else    {
            $twitter_handle=substr($twitter_handle,1) ;
            $twitter_url=$twitter_url.$twitter_handle;
        }

?>




<html>
    <body>
        <p>This is data structure from form</p>
    <div>
        <p>
            Full Name:<?php echo $first_name." ". $last_name; ?>      <br/>
           
            Email:<?php echo $email ;?><br/>
           <a href="<?php echo $facebook_url;?>"> your vk page</a>  <br/>
            <a href="<?php echo $twitter_url;?>"> your twitter account</a>  <br/>
        </p>
    </div>
    </body>


</html>