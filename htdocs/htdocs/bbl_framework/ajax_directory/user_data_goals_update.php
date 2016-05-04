<?php

$ins_id = $_POST['hidden_id'];
$path = $_SERVER['DOCUMENT_ROOT'];


include ($path.'/bbl_framework/util/QueryRunner.php');
include ($path.'/bbl_framework/util/UserCreator.php');

$qr = new QueryRunner();

$res2 = $qr->runQueryWithRes("DELETE FROM goals WHERE id = '".$ins_id."';");
$res3 = $qr->runQueryWithRes("DELETE FROM goals WHERE id = '".$ins_id."';");


$text = $_POST['goal'];
$value_arr = explode(',', $text);

$tem_a  = array();
foreach($value_arr as $elem)
{
    array_push($tem_a , trim($elem));
}

$value_arr = $tem_a;

for($y=0; $y<sizeof($value_arr); $y++)
{ 
	$res = $qr->runQueryWithRes("INSERT INTO goals VALUES ('".$ins_id."' , '".$value_arr[$y]."');");
} 


return json_encode("success");

?>