<!DOCTYPE html>
<html>
<head>
    <style>
        html{background-color: lightslategrey;}
        p{
            margin-left: 120px;
            font-size:20px;           
        
        }
        
        i{
            display:inline-block;
            background-color:lightslategrey;            
            padding:10px;
        }
        
        i:hover{background-color:slategrey;}
        input{
            background-color:darkgrey;
            color:red;
        }
    
    </style>
    
    </head>
<body>
    
    <p>Gretings on the PHP learn book</p>
    <form action="sayHelloWeb.php" method="post">
    <p>
        <bold>enter your name:</bold><input type="text" name="username" size="20"/>    
    </p>
    <p>>
        <input type="submit" value="Say hello to me" /> 
      
    </p>
    
    </form>
    
        
    
    
    </body>

</html>

