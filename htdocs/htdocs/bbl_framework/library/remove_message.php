<?php

$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path.'/bbl_framework/util/QueryRunner.php';
$q_r  = new QueryRunner();

$to      = $_POST['to'];
$from    = $_POST['from'];
$message = $_POST['message'];


$sql   = "DELETE FROM formal_messages WHERE id_to = '".$to."'   AND id_from = '".$from."' AND offset = '".$message."' ;";
$sql_2 = "DELETE FROM formal_messages WHERE id_to = '".$from."' AND id_from = '".$to."'   AND offset = '".$message."' ;";


$q_r->runQueryWithRes($sql);

$q_r->runQueryWithRes($sql_2);

echo json_encode("success");

?>