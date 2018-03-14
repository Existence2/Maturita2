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
  

  
  


require_once("MySQL.php"); 

if (isset($_REQUEST['registrace']))
{
   
  if($_REQUEST['heslo'] <> "" and  $_REQUEST['jmeno'] <>""){
  
  	$jmeno= htmlspecialchars($_REQUEST['jmeno']);
		$heslo= htmlspecialchars($_REQUEST['heslo']);
    $reheslo= htmlspecialchars($_REQUEST['reheslo']);

if (ereg("([A-Za-z0-9])", $jmeno)){
    
    $pravo= 1;
    $blokace= 0;
    $prikaz="SELECT * from Uzivatel";
    $vysledek = $databaze->query($prikaz);
   While($radek=$vysledek->fetch_object())
  
   {
    
    if(htmlspecialchars($radek->jmeno) ==$jmeno ){
      echo '<div class="alert alert-danger">  
  <strong>Neprovedeno!</strong> Toto jméno je již obsazené, zvolte prosím jiné. </div>';
      exit();
      }
      
    if ($heslo != $reheslo ){
    echo '<div class="alert alert-danger">  
  <strong>Neprovedeno!</strong> Vaše heslo se neshoduje. </div>';
      exit();
   }
   }
    $heslo=md5($heslo);
		$prikaz="INSERT into Uzivatel VALUES('Null',?,?,?,?)";
    $vysledek=$databaze->prepare($prikaz);
		$vysledek->bind_param("ssii",$jmeno,$heslo,$pravo,$blokace);
		$vysledek->execute();           
		echo '<div class="alert alert-success">  
  <strong>Provedeno!</strong> Váš účet byl vytvořen </div>';
  
    $prikaz = "SELECT idUzivatel, jmeno, heslo, pravo FROM Uzivatel WHERE jmeno = '$jmeno' AND heslo = '$heslo'";
    $tabulka=$databaze->query($prikaz);
    
     While($radek=$tabulka->fetch_object())
   {
   
    
   echo '<div class="alert alert-success">  
  Jste úspěšně přihlášen </div>';
     $id_uzivatele=$radek->idUzivatel;
     $pravo=$radek->pravo;
   }


  $_SESSION['jmeno']="$jmeno";
  $_SESSION['id']=$id_uzivatele; 
  $_SESSION['login']=true;
  $_SESSION["pravo"]="$pravo";
  
  
  
    }
    
else {

 echo '<div class="alert alert-danger">  
  <strong>Neprovedeno!</strong> Pro jméno mohou být použity pouze malá a velká písmena či číslice. </div>';
      exit();

}
 }  
               
   else
        echo '<div class="alert alert-danger">  
  <strong>Neprovedeno!</strong> Jméno a heslo nebylo zadáno.</div>';
  echo"<br><br>";
        exit();
   
 
 

        
}  
  


?>
