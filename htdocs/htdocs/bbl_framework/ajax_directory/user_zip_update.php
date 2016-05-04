<?php 


$path = $_SERVER['DOCUMENT_ROOT'];
include $path.'/bbl_framework/util/QueryRunner.php';
$q_r = new QueryRunner();

$ins_id = $_POST['hidden_id'];
$text = $_POST['zip'];

$text = trim($text);

$res_one = $q_r->runQueryWithRes("DELETE FROM zips WHERE id = '".$ins_id."';");

$res_two = $q_r->runQueryWithRes("INSERT INTO zips VALUES('".$ins_id."', '".$text."');");
return json_encode("success");

?>