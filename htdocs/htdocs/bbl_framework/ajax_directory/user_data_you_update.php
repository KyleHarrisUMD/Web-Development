<?php 
// now insert into

$path = $_SERVER['DOCUMENT_ROOT'];


include ($path.'/bbl_framework/util/QueryRunner.php');
include ($path.'/bbl_framework/util/UserCreator.php');

$qr = new QueryRunner();

$ins_id = $_POST['hidden_id'];
$text = $_POST['you'];

$res_2 = $qr->runQueryWithRes("DELETE FROM uq WHERE id = '".$ins_id."';");
$res = $qr->runQueryWithRes("INSERT INTO uq VALUES ('".$ins_id."' , '".$text."');");


return json_encode("success");


?>