<?php session_start(); ?>
<?php $id = '';?>
<?php
if(isset($_GET['tgt_usr']))
{
    $id = $_GET['tgt_usr'];
}
$temp_id = $id;
$id = "inst_".$id;
?>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/bbl_framework/util/QueryRunner.php");
include($path."/bbl_framework/util/UserCreator.php");

$user_creator = new UserCreator();
$query_runner = new QueryRunner();

$user = $user_creator->createNewUser($id);
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Posts</title>
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

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="application/javascript">
        // by default hide video and sound //
        $(document).ready(function()
        {
            $('#video_preview').hide();
            $('#audio_preview').hide();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#close_li').hide();
        });
    </script>

</head>
<body>
<div id = "main_nav" class="navigation" >
    <?php if(isset($_SESSION['id_num']))
    {?>
        <ul class="nav_ul">
            <center><li class="skel-panels"><h2 style="color: white;"><strong style="color: #ffffff;">User Navigation</strong></h2></li></center>
            <hr>
            <li><a href="edit.php" target="_self" id="edit-info-link" class="skel-panels" ><span>&nbspEdit My Information</span></a></li>
            <hr>
            <li><a href="connect.php" target="_self" id="findfriends-link" class="skel-panels"><span>&nbspConnect.</span></a></li>
            <hr>
            <li><a href="upload_images.php" target="_self" id="upload_imgs-link" class="skel-panels"><span>&nbspUpload to Gallery</span></a></li>
            <hr>
            <li><a href="posts.php" target="_self" id="my-posts-link" class="skel-panels"><span>&nbspPoster</span></a></li>
            <hr>
            <li><a href="interest_feed.php" target="_blank" id="my-posts-link" class="skel-panels"><span>&nbspBulletin</span></a></li>
            <hr>
            <li><a href="friends.php" target="_blank" id="my-posts-link" class="skel-panels"><span>&nbspFriends</span></a></li>
            <hr>
            <li><a href="Core.php" target="_blank" id="my-posts-link" class="skel-panels"><span>&nbspCore</span></a></li>
            <hr>
        </ul>
    <?php } else { ?>
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
    <?php } ?>
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
</div>
</span>
            <div id ="tbl_div" align="center">
                <table id = "nav_table">
                    <tr>
                        <td  class="nav_section" style="font-size:150%"><a href="view_inst_profile.php?tgt_usr=<?php echo $temp_id;?>">About</a></td>
                        <td  class="nav_section" style="font-size:150%"><a href="view_inst_gallery.php?tgt_usr=<?php echo $temp_id;?>">Gallery </a></td>
                        <td  class="nav_section" style="font-size:150%"><a href="view_inst_posts.php?tgt_usr=<?php echo $temp_id;?>">Posts </a></td>
                    </tr>
                </table>
            </div>
        </header>
    </center>


    <div id = "body_header">
        <div>
            <p>&nbsp;</p>
        </div>

        <div align="center" id = "div_in_header" style="width:80%; margin-left:auto; margin-right:auto; ">
            <br>
            <br>
            <h1> Posts</h1> <br><p>&nbsp;</p>
        </div>


        <section>
            <div id="body_header">
                <br>
                <br>
                <br>
                <?php $posts = $user_creator->getPosts($id); // now posts is a 4-D array [0]= fileroots [1] = text [2 ] = likes [3] = type?>
                <?php $fileroots = $posts[0]; $assoc_text = $posts[1]; $assoc_likes = $posts[2]; $assoc_type = $posts[3];?>
                <!--------------------------------------------------------------------------------------------------------->
                <!--------------------------------------------------------------------------------------------------------->
                <!--------------------------------------------------------------------------------------------------------->
                <!--------------------------------------------------------------------------------------------------------->
                <?php
                for($num_posts = sizeof($fileroots)-1; $num_posts>0; $num_posts--)
                {
                    if($assoc_type[$num_posts] == "img")
                    {
                        ?>
                        <div class ="img_post">
                            <img src="/js_img_test/<?php echo $fileroots[$num_posts];?>" class = "post_img">
                            <br>
                            <br>
                            <h3 class = "post_decript"><?php echo $assoc_text[$num_posts]; ?></h3>
                        </div>
                        <br>
                        <br>
                        <br>
                    <?php } else if ($assoc_type[$num_posts] == "vid")
                    {?>
                        <div class ="img_post">
                            <video controls="controls" src="/js_img_test/<?php echo $fileroots[$num_posts];?>" class = "post_vid"> </video>
                            <br>
                            <br>
                            <h3 class = "post_decript"><?php echo $assoc_text[$num_posts]; ?></h3>
                        </div>
                        <br>
                        <br>
                        <br>
                    <?php } else if ($assoc_type[$num_posts] == "sound") {?>
                        <div class ="img_post">
                            <audio controls="controls" src="/js_img_test/<?php echo $fileroots[$num_posts];?>" class = "post_vid"> </audio>
                            <br>
                            <br>
                            <h3 class = "post_decript"><?php echo $assoc_text[$num_posts]; ?></h3>
                        </div>
                        <br>
                        <br>
                        <br>
                    <?php }} ?>

            </div>

    </div>
    </section>

    <div id="footer-wrapper">
        <div class="container">
            <div class="row">
                <div class="8u">

                    <section>

                    </section>

                </div>
                <div class="4u">

                    <section>

                    </section>

                </div>
            </div>
            <div class="row">
                <div class="12u">

                    <div id="copyright">
                        &copy; Untitled. All rights reserved. | Design: <a href="http://html5up.net">HTML5 UP</a> | Images: <a href="http://fotogrph.com">fotogrph</a>
                    </div>

                </div>
            </div>
        </div>
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

    <!-- ********************************************************* -->
</body>
</html>