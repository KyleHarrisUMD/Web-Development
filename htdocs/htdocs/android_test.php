<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path.'/bbl_framework/util/QueryRunner.php';
$q_r = new QueryRunner();
$s = "SELECT * FROM users;";
$res = $q_r->runQueryWithRes($s);

$data = array();
while($row = mysqli_fetch_array($res))
{
 $data[] = $row;
}

print(json_encode($data));// this will print the output in json

?>