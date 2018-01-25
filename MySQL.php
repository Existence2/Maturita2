<?php
require_once "MySQL_chyby.class.php";
    
    /* 1. vytvoření instance mysqli, sočasně se připojí k serveru a zaktivní databázi */
    require_once "../CONNECT/CONNECT.php";
    $conn = new mysqli($host, $user, $pass, $db) or die("ERROR - Not conected to database");
    /* 2. nastavení, v jakém kódování se mají data z databáze prezentovat */
    $conn->set_charset("UTF8");
  
    function vypis($tabulka, $sloupce = array() ) {
    /* 3. Zadání příkazu SQL */
    $retezec = implode(", ", $sloupce);
    $dotaz = "SELECT ".$retezec." FROM ".$tabulka;
    try {
      $vysledek = $conn->query($dotaz);
    }
    catch(Chyba_dotazu $e) {
      echo $e->getMessage();
      exit;
    }
    catch(Exception $e) {
      echo $e->getMessage();
    }
    
    $hlavicka = "<table border='1'><tr>";
    foreach ($sloupce as $s) {
      $hlavicka .= "<th>".$s."</th>";     
    }
    $hlavicka .= "</tr>";
    echo $hlavicka;
        
    /* 4. Zpracování výsledku dotazu, fce fetch_object() vrací objekt, ne pole */      
    while ($radek=$vysledek->fetch_object()):
      echo "<tr>";
      foreach ($sloupce as $s) {
        echo "<td>".htmlspecialchars($radek->$s)."</td>";     
      }
      echo "</tr>";
    endwhile;
    echo "</table>";
    
    /* 5. Uvolnění sady výsledků */
    $vysledek->free_result();    
  }
    
    function vrat_data($tabulka, $sloupce = array()) {
    /* Zadání příkazu SQL */
    $retezec = implode(", ", $sloupce);
    $dotaz = "SELECT ".$retezec." FROM ".$tabulka;    
    try {
      $vysledek = $conn->query($dotaz);
    }
    catch(Chyba_dotazu $e) {
      echo $e->getMessage();
      exit;
    }
    catch(Exception $e) {
      echo $e->getMessage();
    }                   
    /* Zpracování výsledku dotazu, fce fetch_object() vrací objekt */ 
    $i=0; 
    $data = array(array());    
    while ($radek=$vysledek->fetch_object()):      
      foreach ($sloupce as $s) {        
        $data[$i][$s] = $radek->$s;
      }
      $i++;
    endwhile; 
    /* 5. Uvolnění sady výsledků */
    $vysledek->free_result();
    return $data;
  }
  
    function zapis($tabulka, $sloupce = array(), $hodnoty = array()) {
    /* 1. Zadání příkazu SQL */
    $retezec = implode(", ", $sloupce);
    $dotaz = "INSERT INTO ".$tabulka."(".$retezec.") VALUES(";
    foreach ($hodnoty as $hodnota) {
      $dotaz .= "'".addslashes($hodnota)."', ";
    }
    $dotaz = substr($dotaz,0,strlen($dotaz)-2).")";    
    try {
      $vysledek = $conn->query($dotaz);
      if (!$vysledek) throw new Chyba_dotazu;
    }
    catch(Chyba_dotazu $e) {
      echo $e->getMessage();
      echo $dotaz;
      exit;
    }
  }
  
  function smaz_radek($tabulka, $podminka) {
    /* 1. Zadání příkazu SQL */
    $dotaz = "DELETE FROM ".$tabulka." WHERE ".$podminka;         
    try {
      $vysledek = $conn->query($dotaz);
      if (!$vysledek) throw new Chyba_dotazu;
    }
    catch(Chyba_dotazu $e) {
      echo $e->getMessage();
      echo $dotaz;
      exit;
    }
  }
  
  function __destruct() { 
    /* 6. Ukončení spojení */
    $conn->close();
  }	
		
?>
