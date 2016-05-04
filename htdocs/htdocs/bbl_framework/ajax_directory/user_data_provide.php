<?php 
// now insert into

$path  = $_SERVER['DOCUMENT_ROOT'];
include $path.'/bbl_framework/util/QueryRunner.php';
$q_r = new QueryRunner();

$ins_id = $_POST['hidden_id'];



$res2 = $q_r->runQueryWithRes("DELETE FROM providing WHERE id = '".$ins_id."';");


$text = $_POST['providing'];
$value_arr = explode(',', $text);

// take out spaces //

$no_space_arr  = array();

foreach($value_arr as $elem)
{
   array_push($no_space_arr,trim($elem));
}


for($y=0; $y<sizeof($no_space_arr); $y++)
{ 
	$res = $q_r->runQueryWithRes("INSERT INTO providing VALUES ('".$ins_id."' , '".$no_space_arr[$y]."');");
} 

return json_encode("success");

?>