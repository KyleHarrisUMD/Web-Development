<?php 
// now insert into

$ins_id = $_POST['hidden_id'];
$text = $_POST['you'];

include('dAl.php'); 
$x = new DataAccessProtocol();

$res = $x->runQueryWithRes("INSERT INTO uq VALUES ('".$ins_id."' , '".$text."');");

return json_encode("success");


?>