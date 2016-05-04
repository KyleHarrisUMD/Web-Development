<?php session_start(); ?>
<?php $id = '';?>
<?php
if(isset($_SESSION['id_num']))
{
    $id = $_SESSION['id_num'];
}
?>
<?php

// Shows all like people within a specified radius //
 // Lets Make it 50 for basic purposes //
 // which means I have to find all zip codes within the users zip code.//
 // shouldn't be too hard. I think I have a function for that in bbl_framework/library/geolocation.php //

//
$path = $_SERVER['DOCUMENT_ROOT'];
//
include $path.'/bbl_framework/util/QueryRunner.php';
include $path.'/bbl_framework/util/UserCreator.php';
include $path.'/bbl_framework/library/geolocation.php';
include $path.'/bbl_framework/library/processRelationship.php';

$rp = new RelationshipProcessor();


$q_r = new QueryRunner();
$u_c = new UserCreator();

//echo "USER ID : ".$id;

$geo_helper = new Geolocationhelper();

$user_zip= $u_c->getZipCode($id);

$target_zips = $geo_helper->getArrayOfZips($user_zip , 10);


// essentially all we have to do is select * from users where similar interests .. so //
$id_of_interest = array();

foreach($target_zips as $elem)
{
    $temp_sql = "SELECT * FROM zips WHERE zip_code = '".$elem."' ;";
    $res = $q_r->runQueryWithRes($temp_sql);

    while($row = mysqli_fetch_array($res))
    {
       array_push($id_of_interest, $row['id']);
    }
}

//var_dump($id_of_interest);

$users_array = array();

foreach($id_of_interest as $elem)
{
    $temp_user = $u_c->createNewUser($elem);
    array_push($users_array,$temp_user);
}

//echo "<h1> PROOF </h1>";

foreach($users_array as $elem)
{
  // echo $elem->getFirstName()."  ".$elem->getLastName()."<br>";
}


$ids_to_keep = array();


// need to match a passion or a goal //

$user_passions = $u_c->getPassions($id);
$user_goals    = $u_c->getGoals($id);


$array_of_matches = array();

for($y=0; $y<sizeof($id_of_interest); $y++) // this works like a champ //
{
    // temp vars //
    // temp user //

    if($id_of_interest[$y] != $id)
    {
    $t_u = $id_of_interest[$y];
    $temp_goals = $u_c->getGoals($t_u);
    $temp_passions = $u_c->getPassions($t_u);

    $p_m = find_matches($user_passions, $temp_passions);
    $g_m = find_matches($user_goals, $temp_goals);

    // new array of ID, PASSION MATCH, GOAL MATCH .. //
    $assoc_arr = array();

    array_push($assoc_arr , $id_of_interest[$y]);
    array_push($assoc_arr , $p_m);
    array_push($assoc_arr , $g_m);

    array_push($array_of_matches, $assoc_arr);

  }
}

// now we need to find where the array isn't empty to find who has something in common //
$keepers = array();
for($x=0; $x<sizeof($array_of_matches); $x++)
{
    $p = $array_of_matches[$x][1];
    $g = $array_of_matches[$x][2];
    if($p)
    {
      array_push($keepers, $array_of_matches[$x][0]);
    }
}


function find_matches($array_one, $array_two)
{

    // echo "<h1> FIND MATCHES CALLED  - </h1>".var_dump($array_one)."   ".var_dump($array_two);
    $matches = array();
    for($x=0; $x<sizeof($array_one); $x++)
    {
        $s_1  = $array_one[$x];
        for($y=0; $y<sizeof($array_two); $y++)
        {
            $s_2 = $array_two[$y];
            //echo "String test - STRING ONE :".$s_1."   || STRING TWO : ".$s_2."<br>";
            if($array_one[$x] == $array_two[$y])
            {
                //echo "Ok Match.";
                array_push($matches,$array_one[$x]);
            }
        }
    }
    return $matches;
}
?>
<!DOCTYPE HTML>
<html>
<head>
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
</div>
</span>
            <div id ="tbl_div" align="center">
                <table id = "nav_table">
                    <tr>
                        <td  class="nav_section" style="font-size:150%"><a href="view_profile.php"> About Me </a></td>
                        <td  class="nav_section" style="font-size:150%"><a href="view_.php">Photos </a></td>
                        <td  class="nav_section" style="font-size:150%"><a href="view_posts.php">Posts </a></td>
                        <td  class="nav_section" style="font-size:150%"><a href="view_friends.php">Friends </a></td>
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
                <h1>Connect with people who share passions and goals</h1> <br><p>&nbsp;</p>
                
                <?php 
                    var_dump($user_passions);
                    echo "<p></p>";
                    var_dump($user_goals);
                ?>

             </div>

              <div> <?php
                  for($y=0; $y<sizeof($keepers); $y++)
                  {?>
                  <div class="user_div"">
                      <div class="inner_data">
                          <?php
                          $t = $u_c->createNewUser($keepers[$y]);
                          $temp_id = $t->getId();
                          $temp_root = $u_c->getProfilePicture($temp_id);
                          $name = ($t->getFirstName() . " " . $t->getLastName());
                          $temp_rel = $rp->processRelationship($id,$t->getId());
                          $passion_rel = $temp_rel[0];
                          $goal_rel    = $temp_rel[1];

                          ?>
                          <p>
                              <?php echo $name; ?>
                              <br>
                              <br>
                              <a href="viewprofile.php?tgt_usr=<?php echo $t->getId(); ?>" target="_parent"> <img
                                      class="user_pro_pic" src="/user_images/<?php echo $temp_root; ?>"/></a>
                         <hr>

                          <?php if(sizeof($passion_rel)>=1)
                          {?>
                              Passions in Common:<ul style="list-style-type: circle;">
                              <?
                              foreach($passion_rel as $elem)
                              {
                                  echo "<li>".$elem."</li>";
                              }
                            } ?>
                             </ul>
                          <?php
                          if(sizeof($goal_rel)>=1)
                          {?>
                            Goals in Common:<ul style="list-style-type: circle;">
                              <?
                              foreach($goal_rel as $e)
                              {
                                  echo "<li>".$e."</li>";
                              }
                          }?>
                          </ul>
                          </div>
            </div>
                          <?php } ?>

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
</body>

</html>