<?php

$path = $_SERVER['DOCUMENT_ROOT'];

include ($path.'/bbl_framework/util/QueryRunner.php');
include ($path.'/bbl_framework/util/UserCreator.php');


$ins_id = $_POST['hidden_id'];
$text = $_POST['passion'];
$value_arr = explode(',', $text);

$qr = new QueryRunner();

$res2 = $qr->runQueryWithRes("DELETE FROM passions WHERE id = '".$ins_id."';");

$temp_value_arr = array();
foreach($value_arr as $elem)
{
    array_push($temp_value_arr , trim($elem));
}
$value_arr  = $temp_value_arr;

for($y=0; $y<sizeof($value_arr); $y++)
{ 
	$res = $qr->runQueryWithRes("INSERT INTO passions VALUES ('".$ins_id."' , '".$value_arr[$y]."');");
	$res_2 = $qr->runQueryWithRes("INSERT INTO flep_passions_test VALUES ('".$ins_id."' , '".$value_arr[$y]."');");

} 
return json_encode("success");
?>