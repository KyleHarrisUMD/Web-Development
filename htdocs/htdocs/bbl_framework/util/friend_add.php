<?php
$id_1 = $_POST['id_1'];
$id_2 = $_POST['id_2'];
$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path.'/bbl_framework/util/QueryRunner.php';
$q_r = new QueryRunner();
$res = $q_r->runQueryWithRes("INSERT INTO friends VALUES('".$id_2."', '".$id_1."', 'PENDING');");
// SO ID_1 IS REQUESTING ID_2 TO BE FRIENDS //
return json_encode("success");
?>