<?php
 $t1 = "Přihlaste se prosím";
	   $t2 = "Heslo";
	   $t4 = "Přihlásit";
	   $t5 = "Jméno";
 
 
echo "<div class=\"row\">";
echo "<div class=\"col-md-3\"></div>";
echo "<div class=\"col-md-6\">";
echo "<h2>Přihlášení uživatele</h2><br>";

   
	 
	 
   echo "<div class=\"panel panel-primary\">";
	echo "<div class=\"panel-heading\"> ";
	echo "<h3 class=\"panel-title\">$t1</h3>";
	echo "</div>";
	echo "<div class=\"panel-body\"> ";
	echo "<form role\"form\" method=post >";

	 echo "<div class=\"form-group\"> ";
	  echo "<label for=\"jmeno\">Jméno</label>";
	  echo "<input type=\"text\" class=\"form-control\" id=\"jmeno\" name=\"jmeno\"   placeholder=\"$t5\"> ";
     echo "</div>";
	 echo "<div class=\"form-group\">";
	  echo "<label for=\"heslo\">$t2</label>";
	  echo "<input type=\"password\" class=\"form-control\" id=\"heslo\" name=\"heslo\" placeholder=\"$t2\">";
	 echo "</div>";
	 echo "<button type=\"submit\" name= \"prihlasit\" class=\"btn btn-primary\">$t4</button> ";
	 echo "</form>";
	echo "</div>";
   echo "</div>";
  

echo "</div>";
echo "</div>";

require_once("MySQL.php"); 

if (isset($_REQUEST['prihlasit'])){

  if($_REQUEST['heslo'] <> "" and  $_REQUEST['jmeno'] <>"")
   {$jmeno=htmlspecialchars($_REQUEST["jmeno"]);
    $heslo=htmlspecialchars($_REQUEST["heslo"]);
    $heslo=md5($heslo);
    $prikaz = "SELECT idUzivatel, jmeno, heslo, pravo, blokace FROM Uzivatel WHERE jmeno = '$jmeno' AND heslo = '$heslo'";
    $tabulka=$databaze->query($prikaz);
    if ($tabulka->num_rows==0)
   {  
    echo "<div class=\"row\">";
  echo "<div class=\"col-md-3\"></div>";
  echo "<div class=\"col-md-6\">";
   echo '<div class="alert alert-danger">  
  Přihlášení <strong>neprovedeno.</strong> Musíte se registrovat</div>';
    echo "</div>";
  echo "</div>";
  exit;}
    
    
     While($radek=$tabulka->fetch_object())
   {
   
   if($radek->blokace==1){
      echo "<div class=\"row\">";
  echo "<div class=\"col-md-3\"></div>";
  echo "<div class=\"col-md-6\">";
  	echo '<div class="alert alert-danger">  
  <strong>POZOR!</strong> Váš účet byl zablokován pro porušení pravidel vkládání članků</div>';
    echo "</div>";
  echo "</div>";
  exit;
 }
   if($radek->blokace==0){
   echo "<div class=\"row\">";
  echo "<div class=\"col-md-3\"></div>";
  echo "<div class=\"col-md-6\">";
    echo"<div class='alert alert-success'> <strong>$radek->jmeno</strong> 
  přihlášení bylo úspěšné</div>";
   echo "</div>";
  echo "</div>";
     $id_uzivatele=$radek->idUzivatel;
     $pravo=$radek->pravo;
     $blokace=$radek->blokace;
   }
   }

 if($blokace==0){
  
  $_SESSION['jmeno']="$jmeno";
  $_SESSION['id']="$id_uzivatele"; 
  $_SESSION['login']=true;
  $_SESSION['pravo']="$pravo";

  if ($id_uzivatele=" "){
  $_SESSION['id']==" ";
    }
 } 
  }
  else {
     echo "<div class=\"row\">";
  echo "<div class=\"col-md-3\"></div>";
  echo "<div class=\"col-md-6\">";
    echo '<div class="alert alert-danger">  
  Přihlášení <strong>neprovedeno.</strong> Heslo a jméno nebylo zadáno</div>';
  echo "</div>";
  echo "</div>";
  exit;
    
   }

  
 
            
}  
  
