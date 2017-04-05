<?php
  
//session_start();

try {
    $handler = new PDO('mysql:host=localhost;dbname=restaurant', 'root', '');
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){$e->getMessage(); echo $e->getMessage();}

?>
