<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path.'/bbl_framework/util/QueryRunner.php';
$q_r = new QueryRunner();



$from = $_POST['from'];
$to   = $_POST['to'];
$msg_txt = $_POST['message'];

$now = time();
$res = $q_r->runQueryWithRes("INSERT INTO formal_messages VALUES('".$from."','".$to."','".$msg_txt."','FALSE',NOW(), '".$now."') ;");

return json_encode("success");

?>