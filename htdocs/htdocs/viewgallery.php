<?php session_start();?>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path.'/bbl_framework/util/UserCreator.php';
include $path.'/bbl_framework/util/QueryRunner.php';
$q_r = new QueryRunner();
$u_c = new UserCreator();
?>
<?php
?>
<?php
$id = '';
if (isset($_GET['tgt_usr']))
{
    $id = $_GET['tgt_usr'];
}
$user = $u_c->createNewUser($id);
$pictureRoots = $u_c->getPicturesArray($id);
$video_roots   = $u_c->getVideosArray($id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>BestBrightLight</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet" type="text/css" />
    <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->

    <script src="js/skel.min.js"></script>
    <script src="js/skel-panels.min.js"></script>
    <script src="js/init.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-panels.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bjqs-1.3.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
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
    <?php if(isset($_SESSION['id_num']))
    {?>
        <ul class="nav_ul">
            <center><li class="skel-panels"><h2 style="color: white;"><strong style="color: #ffffff;">User Navigation</strong></h2></li></center>
            <hr>
            <li><a href="profile.php" target="_self" id="edit-info-link" class="skel-panels" ><span>&nbspHome</span></a></li>
            <hr>
            <li><a href="edit.php" target="_self" id="edit-info-link" class="skel-panels" ><span>&nbspEdit My Information</span></a></li>
            <hr>
            <li><a href="contact.php" target="_self" id="findfriends-link" class="skel-panels"><span>&nbspContact</span></a></li>
            <hr>
            <li><a href="connect.php" target="_self" id="findfriends-link" class="skel-panels"><span>&nbspLinker</span></a></li>
            <hr>
            <li><a href="upload_images.php" target="_self" id="upload_imgs-link" class="skel-panels"><span>&nbspUpload to Gallery</span></a></li>
            <hr>
            <li><a href="posts.php" target="_self" id="my-posts-link" class="skel-panels"><span>&nbspPoster Board</span></a></li>
            <hr>
            <li><a href="interest_feed.php" target="_self" id="my-posts-link" class="skel-panels"><span>&nbsp Interest Feed</span></a></li>
            <hr>
            <li><a href="friends.php" target="_blank" id="my-posts-link" class="skel-panels"><span>&nbspFriends</span></a></li>
            <hr>
            <li><a href="Core.php" target="_blank" id="my-posts-link" class="skel-panels"><span>&nbspGoal Assist</span></a></li>
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








<div class = "main-content">
<span>
    <ul style="list-style-type:none; padding: 0; margin: 0;">
        <li id = "menu_li" style="list-style-type:none; font-size:200%;" class="_scroll_link" style="font-size:300%;"><a href="#main_nav" id ="menu_link" class="skel-panels" style="color: #ffffff; font-size: 200%;  text-decoration: none;"><span class="fa fa-expand-o"  style="color: #ffffff"></span>+</a></li>
        <li style="font-size:200%;" id = "close_li" style="list-style-type:none; font-size:200%;" class="_scroll_link" style="font-size:300%;" ><a href="#" id= "close_link" class="skel-panels" style="color: #ffffff; font-size: 200%;  text-decoration: none;"><span class="fa fa-expand-o"  style="color: #ffffff"></span>-</a></li>
    </ul>
</span>

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

    <center>
        <header>
<span>
<div>
    <h3 id = "heading_title">Bubbl </h3>
</div>
</span>
            <div id ="tbl_div" align="center" style="width: 100%;">
                <table id = "nav_table">
                    <tr>
                        <td  class="nav_section" style="font-size:150%"><a href="viewprofile.php?tgt_usr=<?php echo $id;?>">About <?php echo $user->getFirstName()?> </a></td>
                        <td  class="nav_section" style="font-size:150%"><a href="viewgallery.php?tgt_usr=<?php echo $id;?>">Gallery </a></td>
                        <td  class="nav_section" style="font-size:150%"><a href="viewposts.php?tgt_usr=<?php echo $id;?>">Posts </a></td>
                        <td  class="nav_section" style="font-size:150%"><a href="viewfriends.php?tgt_usr=<?php echo $id;?>">Friends </a></td>
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
                <h1><?php echo $user->getFirstName();?>'s Gallery</h1> <br><p>&nbsp;</p>
            </div>
            <!----------------------------------------------------------------------->
            <!----------------------------------------------------------------------->            <!----------------------------------------------------------------------->
            <!------------------------CONTENT GOES BELOW----------------------------->
            <!----------------------------------------------------------------------->
            <!----------------------------------------------------------------------->
            <!----------------------------------------------------------------------->



            <section id="portfolio" class="two">
                <br>
                <h1> <center> Image Gallery </center> </h1>
                <br>
                <div style="width: 100%; margin-left: auto; margin-right: auto">
                    <iframe src="photo_gallery.php?id=<?php echo $id;?>" seamless="true" scrolling="yes" style="width: 100%; height: 400px;">
                    </iframe>
                </div>
            </section>
            <!-- About Me -->
            <section id="about" class="three">
                <hr>
                <h1> <center> Video Gallery </center> </h1>
                <br>
                <div style="width: 100%; margin-left: auto; margin-right: auto">
                    <iframe src="video_gallery.php?id=<?php echo $id;?>" seamless="true" scrolling="yes" style="width: 100%; height: 400px;" sandbox="allow-forms">
                    </iframe>
                </div>
            </section>

        </div>
</div>
</section>


</div>
</body>
</html>
