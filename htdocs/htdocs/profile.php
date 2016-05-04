<?php session_start(); ?>
<?php $id = '';?>
<?php
if(isset($_SESSION['id_num']))
{
    $id = $_SESSION['id_num'];
}
else
{
   header('Location: http:/index.php');
}
?>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/bbl_framework/util/QueryRunner.php");
include($path."/bbl_framework/util/UserCreator.php");

$user_creator = new UserCreator();
$query_runner = new QueryRunner();

$user = $user_creator->createNewUser($id);

$pas_list = $user_creator->getPassions(5);

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $user->getFirstName()."'s";?>Bubble Profile </title>
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
</div>
</span>
<div id ="tbl_div" align="center">
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
      <h1>About <?php echo $user->getFirstName(); ?></h1> <br><p>&nbsp;</p>
</div>

<div algin = "center" id = "information_div" style="display: inline-block; width:80%;">
<p>&NonBreakingSpace;</p>
<div align="center" style="width:100%; margin-right:auto; margin-left: auto; padding-left:10%">
 <h1 style="text-decoration: underline; font-size: 300%;"> Achievements</h1>
    <ul class="info_list">
        <?php
        // get goals as arr //
        $ach_array = $user_creator->getAchievements($id);
        for($i=0;$i<sizeof($ach_array); $i++)
        {
            ?>
            <li><?php echo $ach_array[$i]; ?></li>
        <?php } ?>
    </ul>
    <hr>

</div>
    <div align="center" style="width:100%; margin-right:auto; margin-left: auto; padding-left:10%">
        <h1 style="text-decoration: underline; font-size: 300%;">Goals</h1>
        <ul class="info_list">
            <?php
              // get goals as arr //
              $goals_array = $user_creator->getGoals($id);
              for($i=0;$i<sizeof($goals_array); $i++)
              {
            ?>
             <li><?php echo $goals_array[$i]; ?></li>
              <?php } ?>
       </ul>

        <hr>
    </div>
    
    <div align="center" style="width:100%; margin-right:auto; margin-left: auto; padding-left:10%">
        <h1 style="text-decoration: underline; font-size: 300%;">Passions</h1>
        <ul class="info_list">
            <?php $pas_list = $user_creator->getPassions($id);?>
          <?php foreach($pas_list as $elem)
          {?>
          <li><?php echo $elem; ?></li>
          <?php } ?>
        </ul>
        <hr>
    </div>
    
    <div align="center" style="width:100%; margin-right:auto; margin-left: auto; padding-left:10%">
        <h1 style="text-decoration: underline; font-size: 300%;">What separates you from the pack?</h1>
        <p>&nbsp;</p>
         <p style="padding: 2%; border : 3px solid gray; width:60%; margin-left:auto; margin-right: auto; border-radius:20px;"><?php $text = $user_creator->getUnique($id); echo $text;?></p>
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