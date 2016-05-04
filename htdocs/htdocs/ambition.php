<?php session_start(); ?>
<?php $id = '';?>
<?php
if(isset($_SESSION['id_num']))
{
    $id = $_SESSION['id_num'];
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
    <title>Bubbl Ambition </title>
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
        <li><a href="edit.php" target="_self" id="edit-info-link" class="skel-panels" ><span>&nbspEdit My Information</span></a></li>
        <hr>
        <li><a href="connect.php" target="_self" id="findfriends-link" class="skel-panels"><span>&nbspConnect.</span></a></li>
        <hr>
        <li><a href="upload_images.php" target="_self" id="upload_imgs-link" class="skel-panels"><span>&nbspUpload to Gallery</span></a></li>
        <hr>
        <li><a href="posts.php" target="_self" id="my-posts-link" class="skel-panels"><span>&nbspPoster</span></a></li>
        <hr>
        <li><a href="interest_feed.php" target="_self" id="my-posts-link" class="skel-panels"><span>&nbspBulletin</span></a></li>
        <hr>
        <li><a href="friends.php" target="_blank" id="my-posts-link" class="skel-panels"><span>&nbspFriends</span></a></li>
        <hr>
        <li><a href="Core.php" target="_blank" id="my-posts-link" class="skel-panels"><span>&nbspCore</span></a></li>
        <hr>
        <li><a href="settings.html" target="_blank" id="my-posts-link" class="skel-panels"><span>&nbspSettings</span></a></li>
        <hr>
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
                <h1>Ambition</h1> <br><p>&nbsp;</p>
            </div>

            <br>

            <div style="border: 1px solid black; width: 50%; margin-left: auto; margin-right: auto">
                <br>
                <p>&nbsp;Search the Ambition Database : </p>
                <form style="margin-left: auto; margin-right: auto; width: 90%;" >
                    <select id = "s_o_p" style="width: 50%; font-size: 110%;">
                        <option value="PROVIDE" id = "indiv" style="width: 90%; font-size: 110%;">Assisting with</option>
                        <br>
                        <option value="SEEK" id ="instit" style="width: 90%; font-size: 110%;">Searching for</option>
                    </select>
                    <br>
                    <select id = "type" style="width: 50%; font-size: 110%;">
                        <option value="mentors"    id = "indiv" style="width: 90%; font-size: 110%;">Mentoring</option>
                        <option value="instructor" id ="instit" style="width: 90%; font-size: 110%;">Instruction</option>
                        <option value="jobs"       id = "indiv" style="width: 90%; font-size: 110%;">Jobs</option>
                        <option value="rent"       id ="instit" style="width: 90%; font-size: 110%;">Rentals</option>
                        <option value="business"   id ="instit" style="width: 90%; font-size: 110%;">Business / Loans</option>
                    </select>
                    <br>
                    <br>
                    <input type="text" id = "critera" value="Filter Critera">
                    <br>
                    <input type="submit" value="Search" id = "ambition_search">
                    <script type="text/javascript">
                        $('#ambition_search').click(function(event)
                        {
                            event.preventDefault();
                            // we need the selection values //
                            var type_member =$('#s_o_p').val();

                            var type  = $('#type').val();

                            var critera = $('#critera').val();

                            var new_src = ("ambition_search.php?crit="+critera+"&memtype="+type_member+"&search_type="+type);
                            var i_frame = $('#ambition_results');
                            $('#ambition_results').attr('src', new_src);
                            alert(new_src);

                            return false;
                        });
                    </script>
               </form>
            </div>
            <br>
     <div align = "center">
            <iframe  sandbox="allow-top-navigation" seamless="seamless" src = "ambition_search.php" id ="ambition_results" height="500" width="70%" style="border-radius:10px;" >

            </iframe>
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