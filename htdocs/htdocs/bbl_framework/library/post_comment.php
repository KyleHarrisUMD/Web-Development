<?php
$id      = $_POST['hidden_id'];
$author  = $_POST['hidden_author'];
$comment = $_POST['hidden_comment'];

$path = $_SERVER['DOCUMENT_ROOT'];
include($path.'/bbl_framework/util/QueryRunner.php');
$q_r = new QueryRunner();

$sql = "INSERT INTO comments VALUES('".$id."','".$author."','".$comment."');";
$res = $q_r->runQueryWithRes($sql);

 echo json_encode("success");


?>