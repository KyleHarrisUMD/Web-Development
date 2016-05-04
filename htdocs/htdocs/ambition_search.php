<?php session_start()?>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once($path."/bbl_framework/util/QueryRunner.php");
require_once($path.'/bbl_framework/util/UserCreator.php');

$q_r = new QueryRunner();
$u_c = new UserCreator();


$s_o_p = $_GET['memtype'];
$critera = $_GET['crit'];
$critera = trim($critera);
$type    = $_GET['search_type'];

//echo "SOP :".$s_o_p."<br>";
//echo "Critera:".$critera."<br>";
//echo "Type :".$type."<br>";

$sq = "SELECT * FROM ".$type." WHERE s_o_p = '".$s_o_p."' and critera = '".$critera."';";
$results = $q_r->runQueryWithRes($sq);
$users_array = array();
while($row = mysqli_fetch_array($results))
{
  $temp_usr = $u_c->createNewUser($row['id']);
  array_push($users_array, $temp_usr);
}
//var_dump($users_array);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/iframe_css_style.css">
</head>
<body>
<div id = "results_div">
    <?php
    if(sizeof($users_array)<1)
    {
        echo("<center> <h4 style= 'color : steelblue;'> No results found. Expand your search radius </h4> </center>");
    }
    ?>
    <?php for($s =0; $s<sizeof($users_array); $s++)
    { ?>
        <div class = "user_div">
            <!-- link this image with the view profile page -->
            <div class="inner_data">
                <p> <?php echo $users_array[$s]->getFirstName()." ".$users_array[$s]->getLastName();;
                    $cur_id = $users_array[$s]->getId();
                    ?>
                    <br> <br>
                    <?php $root = $u_c->getProfilePicture($users_array[$s]->getID());?>
                    <a href="viewprofile.php?tgt_usr=<?php echo $users_array[$s]->getId();?>" target = "_parent"> <img class="user_pro_pic" src="/user_images/<?php echo $root ;?>" /></a>
                <h4> Zip Code : <?php $z = $u_c->getZipCode($users_array[$s]->getId()); echo $z; ?> </h4>
                <br>
                </p>
            </div>
        </div>
    <?php }?>
</div>

<style type="text/css">
    .user_div
    {
        border : 5px solid white;
        border-radius:20px;
        margin-left: auto;
        margin-right: auto;
        width : 30%;
        display: inline-flex;
        flex-wrap: wrap;
        margin: 2%;

    }

    .inner_data
    {
        width: 70%;
        padding-left: 10%;
    }


    .user_pro_pic
    {
        width: 100%;
    }


</style>
</body>
</html>