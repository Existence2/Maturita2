<?php 
   echo "<div class=\"panel panel-primary\">";
	echo "<div class=\"panel-heading\"> ";
	echo "<h3 class=\"panel-title\">Registrace</h3>";
	echo "</div>";
	echo "<div class=\"panel-body\"> ";
	echo "<form role\"form\" method=post >";

	 echo "<div class=\"form-group\"> ";
	  echo "<label for=\"jmeno\">Jméno</label>";
	  echo "<input type=\"text\" class=\"form-control\" id=\"jmeno\" name=\"jmeno\"   placeholder=\"Jméno\"> ";
     echo "</div>";
	 echo "<div class=\"form-group\">";
	  echo "<label for=\"heslo\">Heslo</label>";
	  echo "<input type=\"password\" class=\"form-control\" id=\"heslo\" name=\"heslo\" placeholder=\"Heslo\">";
	 echo "</div>";
   	 echo "<div class=\"form-group\">";
	  echo "<label for=\"reheslo\">Heslo</label>";
	  echo "<input type=\"password\" class=\"form-control\" id=\"reheslo\" name=\"reheslo\" placeholder=\"Zadejte znovu heslo\">";
	 echo "</div>";
	 echo "<button type=\"submit\" name= \"registrace\" class=\"btn btn-primary\">Registrovat</button> ";
	 echo "</form>";
	echo "</div>";
   echo "</div>";
  

  
  


require("../CONNECT/CONNECT.php");


  
  $databaze=new mysqli($host, $user, $password, $db) or die("connect ERROR");
  $databaze->set_charset("utf8");
  if ($databaze->connect_errno){
    printf("Připojení spadlo: %s\n", $databaze->connect_error);
    exit();
  }

if (isset($_REQUEST['registrace']))
{
   
  if($_REQUEST['heslo'] <> "" and  $_REQUEST['jmeno'] <>""){
  
  	$jmeno= $_REQUEST['jmeno'];
		$heslo= $_REQUEST['heslo'];
    $reheslo= $_REQUEST['reheslo'];
    $pravo= 1;
 
    $prikaz="SELECT * from Uzivatel";
    $vysledek = $databaze->query($prikaz);
   While($radek=$vysledek->fetch_object())
  
   {
    
    if($radek->jmeno ==$jmeno ){
      echo "Toto jméno je již obsazené, zvolte prosím jiné. " ;
      exit();
      }
      
    if ($heslo != $reheslo ){
     echo "Vaše heslo se neshoduje " ;
      exit();
   }
   }
    $heslo=md5($heslo);
		$prikaz="INSERT into Uzivatel VALUES('Null',?,?,?)";
    $vysledek=$databaze->prepare($prikaz);
		$vysledek->bind_param("ssi",$jmeno,$heslo,$pravo);
		$vysledek->execute();           
		echo '<div class="alert alert-success">  
  <strong>Success!</strong> Váš účet byl vytvořen </div>';
  
    $prikaz = "SELECT idUzivatel, jmeno, heslo FROM Uzivatel WHERE jmeno = '$jmeno' AND heslo = '$heslo'";
    $tabulka=$databaze->query($prikaz);
    
     While($radek=$tabulka->fetch_object())
   {
    echo"$radek->jmeno, jste úspěšně přihlášen.";
     $id_uzivatele=$radek->idUzivatel;
   }


  $_SESSION['jmeno']="$jmeno";
  $_SESSION['id']=$id_uzivatele; 
  $_SESSION['login']=true;
  
  
  
    }
   
               
   else
        echo"Jméno a heslo nebylo zadané, registrace neproběhla<br><br>";
        exit();
   
 
 

        
}  
  


?>
