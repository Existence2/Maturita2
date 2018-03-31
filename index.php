<!DOCTYPE html>
<html lang="cz">
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
<br> 
 

      
    <?php
    
     
  session_start();
  
  if (!isset($_SESSION["strana"]))    $_SESSION["strana"]=0;
  if (!isset($_SESSION["login"]))     $_SESSION["login"]=false;
  if (!isset($_SESSION["pravo"]))     $_SESSION["pravo"]=0;
  if (!isset($_SESSION["aktpozice"]))     $_SESSION["aktpozice"]=0;
  if (!isset($_SESSION["aktautor"]))      $_SESSION["aktautor"]="";
  if (!isset($_SESSION["aktklicslova"]))      $_SESSION["aktklicslova"] ="";

  
    
    
 ?>
 	


 <nav class="navbar navbar-inverse">
   <div class="container-fluid">
    <ul class="nav navbar-nav">
    
      <li class="active"><a href="index.php?s=0">Home</a></li>
	  <li class="active"><a href="index.php?s=00">Články</a></li>
       
      
     
  <?php    
  if($_SESSION["login"]== true)
  {
  
  echo '
 
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="index.php?s=4">Moje Články
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="index.php?s=4">Články</a></li>
          <li><a href="index.php?s=13"> Vložit článek</a></li>
        </ul>
      </li>
      
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="index.php?s=5">Úlovky
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="index.php?s=5"> Úlovky</a></li>
          <li><a href="index.php?s=6"> Vložit úlovek</a></li>
        </ul>
      </li>
      
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="index.php?s=8">Revíry
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="index.php?s=8"> Revíry</a></li>
          <li><a href="index.php?s=9"> Vložit revír</a></li>
        </ul>
      </li>
      
         <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="index.php?s=10">Ryby
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="index.php?s=10"> Ryby</a></li>
          <li><a href="index.php?s=11"> Vložit rybu</a></li>
        </ul>
      </li>
       </ul>
       
       <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php?s=7"><span class="glyphicon glyphicon-user"></span> Odhlásit se</a></li>
    </ul>
       
       
    ';  
       
  

  }
  else
  
  echo '
   <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php?s=3"><span class="glyphicon glyphicon-log-in"></span> Přihlásit se</a></li>

    </ul>
   
    <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php?s=2"><span class="glyphicon glyphicon-log-in"></span> Registrace</a></li>

    </ul>
  ';
  
  ?>
  
  
      
      
  <?php    
  if($_SESSION["login"]== true){
    $pravo = $_SESSION['pravo'];
     if($pravo>1){
    echo "<ul class=\"nav navbar-nav navbar-right\">";
     echo" <li class='dropdown'>";
     echo"   <a class='dropdown-toggle' data-toggle='dropdown' href='index.php?s=15'>Uživatelé  ";
     echo"   <span class='caret'></span></a> ";
    echo"    <ul class='dropdown-menu'>     ";
     echo"     <li><a href='index.php?s=15'> Spravovat uživatele</a></li>    ";
   echo"     </ul>  ";
   echo"    </li>   ";
   echo"     </ul>  ";
      }
      }  

      ?>

  
    
    
    
  </div>
</nav>
 
  
    
  
 <?php
 
  if (isset($_REQUEST["s"]))
             $_SESSION["strana"] =$_REQUEST["s"];
             

  
 
 $strana = $_SESSION["strana"]; 
 $stranka = $strana .".php";
 if (file_exists("$stranka")) include($stranka);
  
 ?>        
       
</div>

</body>
</html>

 
 
