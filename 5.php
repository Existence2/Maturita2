 
 <?php
     if($_SESSION["login"]==true){
        echo $_SESSION['jmeno']." jste přihlášený";
        
        
        
        
        
        
        
        
        
        } 
    if($_SESSION["login"]==false){
      echo "Nejste přihlášený";
      exit();
    }