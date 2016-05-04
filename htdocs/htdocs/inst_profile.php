<?php session_start(); ?>
<?php $id = '';?>
<?php
if(isset($_SESSION['inst_id_num']))
{
    $id = $_SESSION['inst_id_num'];
}
else
{
    header('Location: http:/index.php');
}

$id = substr($id , 5 );

?>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/bbl_framework/util/QueryRunner.php");
include($path."/bbl_framework/util/UserCreator.php");

$user_creator = new UserCreator();
$query_runner = new QueryRunner();

$user = $user_creator->createNewUser($id);


$data_query = "SELECT * FROM inst_users WHERE id = '".$id."' ;";
echo "<h1> Query :".$data_query;

$data = array();
$data_res = $query_runner->runQueryWithRes($data_query);
while($row = mysqli_fetch_array($data_res))
{
    array_push($data, $row['name']);

    array_push($data, $row['services']);
    array_push($data, $row['address']);
    array_push($data,$row['about']);
}

//var_dump($data);

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Bubble Profile </title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="http://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-panels.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/new_nav_style.css"/>
    <link rel = "stylesheet" href="css/style-mobile.css">
    <noscript>

    </noscript>
    <!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
</head>

<script type="text/javascript">
    $(document).ready(function()
    {
        $('#close_li').hide();
    });
</script>
<body>
<div id = "main_nav" class="navigation" >
    <ul class="nav_ul">
        <center><li class="skel-panels"><h2 style="color: white;"><strong style="color: #ffffff;">User Navigation</strong></h2></li></center>
        <hr>
        <li><a href="inst_profile.php" target="_self" id="edit-info-link" class="skel-panels" ><span>&nbspHome</span></a></li>
        <hr>
        <li><a href="inst_edit.php" target="_self" id="edit-info-link" class="skel-panels" ><span>&nbspEdit Our Information</span></a></li>
        <hr>
        <li><a href="inst_contact.php" target="_self" id="findfriends-link" class="skel-panels"><span>&nbspContact</span></a></li>
        <hr>
        <li><a href="upload_images.php" target="_self" id="upload_imgs-link" class="skel-panels"><span>&nbspUpload to Gallery</span></a></li>
        <hr>
        <li><a href="inst_posts.php" target="_self" id="my-posts-link" class="skel-panels"><span>&nbspPoster Board</span></a></li>
        <hr>
        <li><a href="Core.php" target="_blank" id="my-posts-link" class="skel-panels"><span>&nbspGoal Assist</span></a></li>
        <hr>
   </ul>
</div>

<!-- ********************************************************* -->

<div class = "main-content">
<span>
    <ul style="list-style-type:none; padding: 0; margin: 0;">
        <li id = "menu_li" style="list-style-type:none; font-size:200%;" class="_scroll_link" style="font-size:300%;"><a href="#main_nav" id ="menu_link" class="skel-panels" style="color: #ffffff; font-size: 200%;  text-decoration: none;"><span class="fa fa-expand-o"  style="color: #ffffff"></span>+</a></li>
        <li style="font-size:200%;" id = "close_li" style="list-style-type:none; font-size:200%;" class="_scroll_link" style="font-size:300%;" ><a href="#" id= "close_link" class="skel-panels" style="color: #ffffff; font-size: 200%;  text-decoration: none;"><span class="fa fa-expand-o"  style="color: #ffffff"></span>-</a></li>
    </ul>
</span>


    <center>
        <header>
<span>
<div>
    <h3 id = "heading_title">Bubbl </h3>
    <div align = "right">
        <button id = "logout">Log-out</button>
        <script type="text/javascript">
            $('#logout').click(function(event)
            {
                $.ajax
                (
                    {
                        type: 'POST',
                        url: '../bbl_framework/library/process_logout.php',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function (data)
                        {
                            window.location.replace("http:/index.php");

                        }
                    });
            });
        </script>
    </div>
    <script type="text/javascript">

    </script>
</div>
</span>
            <div id ="tbl_div" align="center">
                <table id = "nav_table">
                    <tr>
                        <td  class="nav_section" style="font-size:150%"><a href="view_inst_profile.php?tgt_usr=<?php echo $id;?>">About </a></td>
                        <td  class="nav_section" style="font-size:150%"><a href="view_inst_gallery.php?tgt_usr=<?php echo $id;?>">Gallery </a></td>
                        <td  class="nav_section" style="font-size:150%"><a href="view_inst_posts.php?tgt_usr=<?php echo $id;?>">Posts </a></td>
                    </tr>
                </table>
            </div>
        </header>
    </center>

    <section>
        <!-- now we can add profile elements -->
        <div id = "body_header">
            <div>
                <p>&nbsp;</p>
            </div>

            <div align="center" id = "div_in_header" style="width:80%; margin-left:auto; margin-right:auto; ">
                <br>
                <br>
                <h1><?php echo $data[0];?></h1> <br><p>&nbsp;</p>
            </div>

            <div algin = "center" id = "information_div" style="display: inline-block; width:80%;">
                <p>&NonBreakingSpace;</p>
                <div align="center" style="width:100%; margin-right:auto; margin-left: auto; padding-left:10%">
                    <h1 style="text-decoration: underline; font-size: 300%;">Services</h1>
                    <br>
                    <?php
                    // code to parse into array //
                    $array_of_services = explode(',',$data[1]);
                    ?>

                    <ul class="info_list" style="list-style-type: circle">
                    <?php foreach($array_of_services as $elem){?>
                        <li style="align-items: baseline"><?php echo $elem."<br><br>";?></li>
                        <?php }?>
                    </ul>

                    <hr>

                </div>
                <div align="center" style="width:100%; margin-right:auto; margin-left: auto; padding-left:10%">
                    <h1 style="text-decoration: underline; font-size: 300%;">Location(s)</h1>
                    <ul class="info_list">

                        <li><?php echo $data[2];?></li>

                    </ul>

                    <hr>
                </div>


                <div align="center" style="width:100%; margin-right:auto; margin-left: auto; padding-left:10%">
                    <h1 style="text-decoration: underline; font-size: 300%;">What makes you different?</h1>
                    <p>&nbsp;</p>
                    <p style="padding: 2%; border : 3px solid gray; width:60%; margin-left:auto; margin-right: auto; border-radius:20px;"><?php echo $data[3]?></p>
                    <hr>
                </div>


            </div>
            <p>&nbsp;</p>
        </div>
    </section>


</div>
<script type="text/javascript">
    $('#menu_link').click(function ()
    {
        $("#menu_li").hide();
        $("#close_li").show();
    });

    $('#close_link').click(function ()
    {
        $("#menu_li").show();
        $("#close_li").hide();
    });
</script>
</body>

</html>