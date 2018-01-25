                                
 <?php
     if($_SESSION["login"]==true){
        echo $_SESSION['jmeno']." jste přihlášený";
 echo "<div class=row>";
 
  echo "<div class=col-md-2 >";  
  echo "</div>";
  
  
  echo "<div class=col-md-8 >";  

     
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"rozmer\">Zadejte rozměr vašeho úlovku </label>  ";
 echo"   <input type=\"text\" class=\"form-control\" id=\"rozmer\">  ";
 echo" </div>  ";
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"vaha\">Zadejte váhu vašeho úlovku (dvě desetinná místa) </label>  ";
 echo"   <input type=\"number\" class=\"form-control\" id=\"vaha\"> ";
 echo" </div>    ";
  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"datum\">Zadejte datum vašeho úlovku</label>  ";
 echo"   <input type=\"date\" class=\"form-control\" id=\"datum\"> ";
 echo" </div>    ";

    echo" <div class=\"form-group\"> ";
 echo"   <label for=\"lov\">Zadejte způsob lovu vašeho úlovku</label>  ";
 echo"   <input type=\"text\" class=\"form-control\" id=\"lov\"> ";
 echo" </div>    ";
 
    
    echo" <div class=\"form-group\"> ";
 echo"   <label for=\"ryba\">Vyberte rybu </label>  ";
 echo"   <input type=\"text\" class=\"form-control\" id=\"ryba\"> ";
 echo" </div>    ";
 
 
    echo" <div class=\"form-group\"> ";
 echo"   <label for=\"revir\">Vyberte revír </label>  ";
 echo"   <input type=\"text\" class=\"form-control\" id=\"revir\"> ";
 echo" </div>    ";
 
 echo" <button type=\"submit\" class=\"btn btn-primary\">Submit</button> ";
echo" </form>  ";
  echo "</div>";        
        
        
        
  echo "<div class=col-md-2 >";  
  echo "</div>";   
   echo "</div>";         
        
        
        
        } 
    if($_SESSION["login"]==false){
      echo "Nejste přihlášený";
      exit();
    }