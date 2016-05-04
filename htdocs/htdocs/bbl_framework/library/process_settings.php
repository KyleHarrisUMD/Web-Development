<?php session_start() ?>
<?php

  $id = '';
  if(isset($_SESSION['id_num']))
  {
      $id = $_SESSION['id_num'];
  }


?>
<?php

$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path.'/bbl_framework/util/QueryRunner.php';
$q_r = new QueryRunner();

try
{
$mentor_assist = $_POST['assist_mentor_area'];
$assist_mentor_array = explode(",",$mentor_assist);
$assist_mentor_array = trimmer($assist_mentor_array);

if(sizeof($assist_mentor_array)>0)
{
        $delete_mentor_query = "DELETE FROM mentors WHERE id = '".$id."' and s_o_p = 'PROVIDE'; ";
        $q_r->runQueryWithRes($delete_mentor_query);
}
foreach($assist_mentor_array as $element)
{
    $t_s = "INSERT INTO mentors VALUES('".$id."','PROVIDE','".$element."');";
    $q_r->runQueryWithRes($t_s);
}

}catch (Exception $e)
{
    echo "Nobody seeking mentors";
}





try
{
    $job_assist = $_POST['assist_job_area'];
    $assist_job_array = explode(",",$job_assist);
    $assist_job_array = trimmer($assist_job_array);

    if(sizeof($assist_job_array)>0)
    {
        $delete_job_query = "DELETE FROM jobs WHERE id = '".$id."' and s_o_p = 'PROVIDE'; ";
        $q_r->runQueryWithRes($delete_job_query);
    }
    foreach($assist_job_array as $element)
    {
        $j_q = "INSERT INTO jobs VALUES('".$id."','PROVIDE','".$element."');";
        $q_r->runQueryWithRes($j_q);
    }

}catch (Exception $e)
{
    echo "Nobody seeking mentors";
}





$instruct_assist = $_POST['assist_instruct_area'];
$assist_instruct_array = explode(",",$instruct_assist);
$assist_instruct_array = trimmer($assist_instruct_array);


if(sizeof($assist_instruct_array)>0)
{
$delete_instruct_query = "DELETE FROM instructor WHERE id = '".$id."' and s_o_p = 'PROVIDE'; ";
$q_r->runQueryWithRes($delete_instruct_query);
}
foreach($assist_instruct_array as $e)
{
    $t = "INSERT INTO instructor VALUES('".$id."','PROVIDE','".$e."');";
    echo $t."<br>";
    $q_r->runQueryWithRes($t);
}

$rent = $_POST['a_p'];
if($rent =="Yes")
{
    $d_r = "DELETE FROM rent WHERE id = '".$id."'";
    $q_r->runQueryWithRes($d_r);
    $a_p = "INSERT INTO rent VALUES('".$id."' , 'PROVIDE');";
    $q_r->runQueryWithRes($a_p);

}





function trimmer($array)
{
    $temp_arr = array();
    foreach($array as $elem)
    {
        $temp_trim = trim($elem);
        array_push($temp_arr, $temp_trim);
    }
    return $temp_arr;

}
?>