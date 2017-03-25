<html>
    <body>
        <div>
           <h1>This is all information in array</h1>
            <?php 
                   
                foreach($_REQUEST as $key=>$value)
                    {
                        
                        echo "<p>".$key."  For value=".$value."<p>";
                      
                    }
            
            ?>
        
        
        </div>
        
    </body>
</html>