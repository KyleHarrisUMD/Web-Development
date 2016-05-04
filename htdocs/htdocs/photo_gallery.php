<?php session_start();?>
<?php
?>
<?php

$path = $_SERVER["DOCUMENT_ROOT"];
include $path."/bbl_framework/util/QueryRunner.php";
include $path."/bbl_framework/util/UserCreator.php";
$q_r = new QueryRunner();
$u_c = new UserCreator();


$id = '';
if(isset($_GET['id']))
{
    $id = $_GET['id'];
}


$current_user = $u_c->createNewUser($id);
$pictureRoots = $u_c->getPicturesArray($id);

?>
<!DOCTYPE html>
<html>
<head>
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet" type="text/css" />
    <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
    <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/init.js"></script>
    <script src="js/bjqs-1.3.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <noscript>
        <link rel="stylesheet" href="css/skel-noscript.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-wide.css" />
        <link rel="stylesheet" href="css/bjqs.css">
        <link rel="stylesheet" href="css/demo copy.css">
    </noscript>
</head>
<body>
<center><div id = "img_div" align="center">
        <ul id = "img_list">
            <?php
            for($x=0; $x<sizeof($pictureRoots); $x++)
            {?>
                <li style="display:inline;"> <span id = "img_span" style="padding:10px; margin:10px;" >
        <img class="img" src="user_images/<?php echo $pictureRoots[$x]?>">
      </span> </li>
            <?php }?>
        </ul>
    </div>
</center>
</body>
<style type="text/css">
    .img
    {
        height: 40%;
        width: 40%;
    }
    #img_list
    {
        display: inline;
        padding: 0;
        padding: 0;
        list-style: none;
        width: 300px;
    }
    #img_list li
    {
        padding: 0;
    }

</style>
</html>