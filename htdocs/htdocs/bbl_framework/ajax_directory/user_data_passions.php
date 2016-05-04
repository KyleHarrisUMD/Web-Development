<?php 
// now insert into

$ins_id = $_POST['hidden_id'];
$text = $_POST['passion'];

$value_arr = explode(',', $text);


include('dAl.php'); 
$x = new DataAccessProtocol();


for($y=0; $y<sizeof($value_arr); $y++)
{ 
	$res = $x->runQueryWithRes("INSERT INTO passions VALUES ('".$ins_id."' , '".$value_arr[$y]."');");
} 
return json_encode("success");


?>