<?php

$path = $_SERVER['DOCUMENT_ROOT'];
include $path.'/bbl_framework/util/QueryRunner.php';
$q_r = new QueryRunner();


$from = $_POST['sender'];
$to   = $_POST['to'];
$msg_txt = $_POST['msg_txt'];

$now = time();
$res = $q_r->runQueryWithRes("INSERT INTO messages VALUES('".$from."','".$to."','".$msg_txt."','FALSE',NOW(), '".$now."') ;");

return json_encode("success");


?>