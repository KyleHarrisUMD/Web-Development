<?php session_start(); ?>
<?php $id = ''; ?>
<?php
if (isset($_SESSION['id_num'])) {
    $id = $_SESSION['id_num'];
}
?>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include($path . "/bbl_framework/util/QueryRunner.php");
include($path . "/bbl_framework/util/UserCreator.php");
include($path . '/bbl_framework/library/processRelationship.php');

$R_P = new RelationshipProcessor();


$user_creator = new UserCreator();
$query_runner = new QueryRunner();

$user = $user_creator->createNewUser($id);
?>
<!DOCTYPE HTML>
<html>
<head>
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

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="css/ie9.css"/><![endif]-->
    <!--[if lte IE 8]>
    <script src="js/html5shiv.js"></script><![endif]-->

    <script type="text/javascript">
     $(document).ready(function()
     {
         $(".child_relationship_div").hide();
         $(".hide_rel").hide();

     });

    $(".show_rel").click(function(event)
    {
       event.preventDefault;

       alert("Clicked");
       $(this).next().show();
    });


    </script>
</head>
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
<div id="main_content">
  <div align = "left" id = "whatta__do">
      <button class = "show_rel" id="show_relationship">Show Relationships</button>
      <button class = "hide_rel" id="hide_relationship">Hide Relationships</button>

      <script type="text/javascript">
          $(".show_rel").click(function()
          {
              $(".child_relationship_div").show();
              $('.show_rel').hide();
              $('.hide_rel').show();
          });

          $(".hide_rel").click(function()
          {
              $(".child_relationship_div").hide();
              $('.show_rel').show();
              $('.hide_rel').hide();
          });
      </script>
  </div>
    <section>
        <div id="whatta__do">
            <?php
            $friends = $user_creator->getFriends($id);
            for ($num_friends = 0;
            $num_friends < sizeof($friends);
            $num_friends++)
            {
            ?>
            <div class="user_div">
                <div class="inner_data">
                    <?php
                    $current_friend = $friends[$num_friends];
                    $temp_root = $user_creator->getProfilePicture($current_friend->getId());
                    $name = ($current_friend->getFirstName() . " " . $current_friend->getLastName());
                    ?>
                    <p>
                        <?php echo $name; ?>
                        <br>
                        <br>
                        <a href="viewprofile.php?tgt_usr=<?php echo $current_friend->getId(); ?>" target="_parent"> <img
                                class="user_pro_pic" src="/user_images/<?php echo $temp_root; ?>"/></a>
                        <?php
                        $relation_veiw = false;
                        $current_relation = $R_P->processRelationship($user->getId(), $current_friend->getId());
                        if ($current_relation) {
                            $relation_veiw = true;
                   }

    if ($relation_veiw)
    {
 ?>
     <div class="parent_relationship_div">
               <div class = "child_relationship_div">
                    <hr>
                    <?php
                    // [0] = passions, [1] = goals, [2] = ach, [3] = friends
                    $p_m = $current_relation[0];
                    $g_m = $current_relation[1];
                    $a_m = $current_relation[2];
                    $f_m = $current_relation[3];
                    //var_dump($p_m);

                    if ($p_m)
                    {
                    ?>
                    Passions in Common :
                    <ul style="list-style-type: circle ">
                        <?php foreach ($p_m as $elem){ ?>
                        <li> <?php echo $elem ?> </li>
                         <?php   } ?>
                      </ul>
                    <?} ?>


                    <?
                    if ($g_m)
                    {
                        ?>
                        Goals In common : <br>
                        <ul>
                        <?php foreach ($g_m as $elem) { ?>
                            <li> <?php echo $elem ?> </li>
                            </ul>
                        <?php }
                    }  ?>



                    <?
                    if ($a_m)
                    {
                            ?>
                            Achievements In common : <br>
                            <ul>
                            <?php foreach ($a_m as $elem) { ?>
                                <li> <?php echo $elem ?> </li>
                                </ul>
                            <?php }
                    } ?>


                <?
                  if ($f_m)
                  {
                  $mutual_friend_count = sizeof($f_m);
                  echo $mutual_friend_count." Mutual Connections";
                 }
   }
                    ?>
                    </p>
    </div>
                </div>

            </div>
            </div>
        <?php } ?>
        </div>
    </section>

</div>
<div class="4u">


</div>
<div class="4u">

    <section>

    </section>

</div>
</div>
<div class="row main-row">
    <div class="6u">

        </section>

    </div>
    <div class="6u">


    </div>
</div>
</div>
</div>
<div id="footer-wrapper">

</div>

<style type="text/css">
    .user_div {
        border: 5px solid white;
        border-radius: 20px;
        margin-left: auto;
        margin-right: auto;
        width: 20%;
        display: inline-flex;
        flex-wrap: wrap;
        margin: 2%;

    }

    .inner_data {
        width: 70%;
        padding-left: 10%;
    }

    .user_pro_pic {
        width: 100%;
    }

    #whatta__do {
        background-image: url(/css/images/bg1.png);
    }

</style>
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