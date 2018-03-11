                                
 <?php

 echo "<div class=row>";
 
 if ($_SESSION['login']== false)
 {
  echo "<div class=\"alert alert-danger\">";
  echo "Pro práci s revíry musíte být přihlášen. Přihlaste se prosím";
  echo "</div>";
  exit;
  
 }
    // id je id radku v tabulce k editaci
  if (isset($_REQUEST["id"]))
      $id = $_REQUEST["id"];
  else
  {
    echo "chybné volání stránky bez id";
    exit;  
   }
  
   echo "<div class=col-md-5>"; 
  	 
	if (isset($_FILES["file"]["name"]))
  {
	 $pozice = 0;
	
	 for ($i=strlen($_FILES["file"]["name"]);$i > 1; $i--)
	 {
		 if (substr($_FILES["file"]["name"],$i,1) == "." ) $pozice = strlen($_FILES["file"]["name"])- $i;
	 }
 

   $pozice = ($pozice) * -1 ;
	 $ext =substr($_FILES["file"]["name"], $pozice); 
	 
	  
	 $dir = "obr/reviry/";  
 	 
	 $jmeno = $id;
	 $jmeno .=$ext;  
   
   
    if (is_file("$dir$id.jpg"))  unlink("$dir$id.jpg");
    if (is_file("$dir$id.jpeg")) unlink("$dir$id.jpeg");
    if (is_file("$dir$id.bmp"))  unlink("$dir$id.bmp");
    if (is_file("$dir$id.png"))  unlink("$dir$id.png");
    
	 if ($ext == ".jpg" or $ext == ".bmp" or $ext == ".jpeg" or $ext == ".png" )
  	 move_uploaded_file($_FILES['file']['tmp_name'],$dir.$jmeno);
   else
    {
      echo "<div class=\"alert alert-danger\">";
      echo "Tento typ souboru nelze nahrát";
      echo "</div>";
    } 
	 }
  
 
   
  echo "<br>";
  $jm = "obr/reviry/";
  $jm .=$id;
   
  if (is_file("$jm.jpg"))
      echo "<img src=$jm.jpg width=400>";
  if (is_file("$jm.bmp"))
      echo "<img src=$jm.bmp width=400>";
  if (is_file("$jm.png"))
      echo "<img src=$jm.png width=400>";
  if (is_file("$jm.jpeg"))
      echo "<img src=$jm.jpeg width=400>";                  
  
  echo "<br><br><br>";    
  echo "<form method = \"post\" enctype=\"multipart/form-data\">";  
	 	 echo "<input type=\"file\"  name=\"file\" size=\"60\"><br>";
      echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Nahrát obr</button> ";  
	echo "</form>"; 


  	   
      
  echo "</div>";
  
 
  
  require("../CONNECT/CONNECT.php");  
  $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
   $databaze->set_charset("utf8");
  if ($databaze->connect_errno){
    printf("Pripojeni spadlo: %s\n", $databaze->connect_error);
    exit();
  }   
  
   $sql="SELECT * FROM Revir WHERE idRevir = '".$id."'";
   $vysledek = mysqli_query($databaze,$sql);
   $radek= mysqli_fetch_array($vysledek); 
 
       

  echo "<div class=col-md-5 >";  

 echo "<form > ";
echo "<input type=hidden name=id1 value= $id>"; 
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"nazev\">Zadejte název revíru </label>  ";
 echo"   <input type=\"text\" name=\"nazev\" class=\"form-control\" id=\"nazev\" value=\"" .$radek['nazev'] ."\">  ";
 echo" </div>  ";
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"lokalita\">Zadejte, v jakém kraji se revír nachází </label>  ";
 echo"   <input type=\"text\" name=\"lokalita\" class=\"form-control\" id=\"lokalita\" value=\"" .$radek['kraj'] ."\">  ";
 echo" </div>    ";
  echo" <div class=\"form-group\"> ";
 echo"   <label for=\"popis\">Zadejte popis vašeho revíru </label> ";
 echo"   <input type=\"text\"  name=\"popis\" class=\"form-control\" id=\"popis\" value=\"" .$radek['popis'] ."\">  ";
 echo" </div>    ";
    echo" <div class=\"form-group\"> ";
 echo"   <label for=\"rozmer\">Zadejte rozměr vašeho revíru v kilometrech (povolena dvě desetinná místa) </label>  ";
 echo"   <input type=\"number\" name=\"rozmer\" class=\"form-control\" id=\"rozmer\"  value=\"" .$radek['velikost'] ."\">  ";
 echo" </div>    ";
 
 echo" <div class=\"form-group\"> ";
 echo"   <label for=\"svaz\">Zadejte k jakému svazu revír patří </label>  ";
 echo"   <input type=\"text\" name=\"svaz\" class=\"form-control\" id=\"svaz\" value=\"" .$radek['svaz'] ."\">  ";
 echo" </div>    ";
      
     
        
require("../CONNECT/CONNECT.php");  
  $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
   $databaze->set_charset("utf8");
  if ($databaze->connect_errno){
    printf("Pripojeni spadlo: %s\n", $databaze->connect_error);
    exit();
  }     
      
       
 				 
 
 echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Potvrď</button> ";
echo" </form>  ";
  echo "</div>";        
        
        
        
  echo "<div class=col-md-2 >";  
  echo "</div>";   
   echo "</div>";         
        
      
 
        
        
    
    
    echo "<br><br>";
    echo "<form action=novy.php?s=8>";
    echo" <button type=\"submit\" name=\"tlacitko\" class=\"btn btn-primary\">Návrat zpět</button> ";
    echo "</form>";
    
    
