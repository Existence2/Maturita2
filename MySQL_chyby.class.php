<?php
class Chyba_pripojeni extends Exception {
  protected $message = 'Chyba připojení se k databázi'; // zpráva výjimky    
}	
class Chyba_kodovani extends Exception {
  protected $message = 'Nelze nastavit kódování'; // zpráva výjimky    
}	
class Chyba_dotazu extends Exception {
  protected $message = 'Nelze položit dotaz: '; // zpráva výjimky    
}		
?>
