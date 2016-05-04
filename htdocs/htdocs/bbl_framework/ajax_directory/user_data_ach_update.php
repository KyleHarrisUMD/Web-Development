<?php 

$ins_id = $_POST['hidden_id'];
$text = $_POST['ach'];


$path = $_SERVER['DOCUMENT_ROOT'];


include ($path.'/bbl_framework/util/QueryRunner.php');
include ($path.'/bbl_framework/util/UserCreator.php');

$qr = new QueryRunner();


$res_2 = $qr->runQueryWithRes("DELETE FROM achivements WHERE id = '".$ins_id."';");
$res = $qr->runQueryWithRes("UPDATE achivements SET achi ='".$text."' WHERE id ='".$ins_id."' ; ");



$text = $_POST['ach'];
$value_arr = explode(',', $text);


for($y=0; $y<sizeof($value_arr); $y++)
{ 
	$res = $qr->runQueryWithRes("INSERT INTO achivements VALUES ('".$ins_id."' , '".$value_arr[$y]."');");
} 


return json_encode("success");

?>