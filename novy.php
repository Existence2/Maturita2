<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ryby</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  
<div class="container">
<h1>Ryby</h1>
 


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="active"><a href="novy.php?s=1">Home</a></li>
      <li><a href="novy.php?s=2">Registrace</a></li>
      <li><a href="novy.php?s=3">Přihlášení</a></li>
       <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="novy.php?s=4">Články
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="novy.php?s=4">Články</a></li>
          <li><a href="novy.php?s=13"> Vložit článek</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="novy.php?s=5">Úlovky
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="novy.php?s=5"> Úlovky</a></li>
          <li><a href="novy.php?s=6"> Vložit úlovek</a></li>
        </ul>
      </li>
      
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="novy.php?s=8">Revíry
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="novy.php?s=8"> Revíry</a></li>
          <li><a href="novy.php?s=9"> Vložit revír</a></li>
        </ul>
      </li>
      
         <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="novy.php?s=10">Ryby
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="novy.php?s=10"> Ryby</a></li>
          <li><a href="novy.php?s=11"> Vložit rybu</a></li>
        </ul>
      </li>
    </ul>
       <ul class="nav navbar-nav navbar-right">
      <li><a href="novy.php?s=7"><span class="glyphicon glyphicon-user"></span> Odhlásit se</a></li>
    <!--  <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>      !-->
    </ul>
    
  </div>
</nav>
 
  
    
  
 <?php
  session_start();
  
  if (!isset($_SESSION["strana"]))    $_SESSION["strana"]=1;
  if (!isset($_SESSION["login"]))     $_SESSION["login"]=false;
  
  if (isset($_REQUEST["s"]))
             $_SESSION["strana"] =$_REQUEST["s"];
             
//  if ($_SESSION["login"]==false)    { $_SESSION["strana"]=0; echo "neprihlasen";}
//  if ($_SESSION["login"]==true)     echo  "prihlasen"; 
  
// if (isset($_REQUEST["email"])) prihlaseni();

  
 
 $strana = $_SESSION["strana"]; 
 $stranka = $strana .".php";
 if (file_exists("$stranka")) include($stranka); 
 ?>        
       
</div>

</body>
</html>

 
 
<?php 

function prihlaseni()
{
  $email =   $_REQUEST["email"];
  $pwd =     $_REQUEST["pwd"];
  if ($pwd == "12345")
  { 
   $_SESSION["login"]=true;
   echo '
    <div class="alert alert-success">
    <strong>Success!</strong>Byl jste prihlasen.
    </div> 
    ';
    $_SESSION["strana"]=1;
  }
  else
  { 
   echo '
    <div class="alert alert-danger">
    <strong>UnSuccess!</strong>NEBYL jste prihlasen.
    </div> 
    ';
  }
  
  
}



