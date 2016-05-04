<?php session_start(); ?>
<?php $id = '';?>
<?php
if(isset($_GET['tgt_usr']))
{
    $id = $_GET['tgt_usr'];
}


if(isset($_SESSION['id_num']))
{
    $current_user = $_SESSION['id_num'];
}

if(isset($_SESSION['inst_id_num']))
{
    $current_user = $_SESSION['inst_id_num'];
}

echo "VIEWING USER :".$current_user;
?>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/bbl_framework/util/QueryRunner.php");
include($path."/bbl_framework/util/UserCreator.php");

$user_creator = new UserCreator();
$query_runner = new QueryRunner();

require_once $path.'/bbl_framework/util/CorporateFunctionLibrary.php';
$c_d_f = new CorporateDataFetcher();



?>

<!DOCTYPE HTML>
<html>
<head>
    <title>>Bubble Profile </title>
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
                        <td  class="nav_section" style="font-size:150%"><a href="view_inst_profile.php?tgt_usr=<?php echo $id;?>">About</a></td>
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

            <body>
            <div id = "main_nav" class="navigation" >
                <ul class="nav_ul">
                    <center><li class="skel-panels"><h2 style="color: white;"><strong style="color: #ffffff;">User Navigation</strong></h2></li></center>
                    <hr>
                    <li><a href="inst_edit.php" target="_self" id="edit-info-link" class="skel-panels" ><span>&nbspEdit Our Information</span></a></li>
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
                    <li><a href="settings.html" target="_blank" id="my-posts-link" class="skel-panels"><span>&nbspSettings</span></a></li>
                    <hr>
            </div>

            <!-- ********************************************************* -->

                <section>
                    <!-- now we can add profile elements -->
                    <div id = "body_header">
                        <div>
                            <p>&nbsp;</p>
                        </div>

                        <div align="center" id = "div_in_header" style="width:80%; margin-left:auto; margin-right:auto; ">
                            <br>
                            <br>
                            <h1><?php echo $c_d_f->getName($id);?></h1> <br><p>&nbsp;</p>
                        </div>

                        <div algin = "center" id = "information_div" style="display: inline-block; width:80%;">
                            <p>&NonBreakingSpace;</p>
                            <div align="center" style="width:100%; margin-right:auto; margin-left: auto; padding-left:10%">
                                <h1 style="text-decoration: underline; font-size: 300%;">Services</h1>
                                <br>
                                <?php
                                // code to parse into array //
                                $array_of_services = explode(',',$c_d_f->getServices($id));
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

                                    <li><?php echo $c_d_f->getLocations($id)?></li>

                                </ul>

                                <hr>
                            </div>


                            <div align="center" style="width:100%; margin-right:auto; margin-left: auto; padding-left:10%">
                                <h1 style="text-decoration: underline; font-size: 300%;">What makes us different?</h1>
                                <p>&nbsp;</p>
                                <p style="padding: 2%; border : 3px solid gray; width:60%; margin-left:auto; margin-right: auto; border-radius:20px;"><?php echo $c_d_f->getCustomText($id);?></p>
                                <hr>
                            </div>


                        </div>
                        <p>&nbsp;</p>
                    </div>
                </section>


            </div>

            <?php
            if($user_creator->areFriends($id,$current_user))
            {
                ?>
                <div align = "left" style="width: 20%;">
                <form id = "hidden_ids">
                    <input type="hidden" id = "id_1" name = "id_1" value="<?php echo $current_user?>">
                    <input type="hidden" id = "id_2" name = "id_2" value="<?php echo $id?>">
                    <input type="submit" value="Add To Bubbl"/>
                </form>
                </div>
                <div align ="right" >
                    <form id = "message">
                        <input type="hidden" id = "id_1" name = "id_1" value="<?php echo $current_user?>">
                        <input type="hidden" id = "id_2" name = "id_2" value="<?php echo $id?>">
                        <input type="submit" value="Message Bubbl"/>
                    </form>
                </div>


                <script type="text/javascript">
                    $('#hidden_ids').submit(function(event)
                    {
                        event.preventDefault();
                        //alert($(this).serialize());
                        //alert("Button Clicked");
                        $.ajax(
                            {
                                type: 'POST',
                                url: '../bbl_framework/util/friend_add.php',
                                data: $(this).serialize(),
                                dataType: 'json',
                                success: function (data)
                                {
                                    console.log(data);
                                    alert("Data updated");
                                }
                            });
                    });

                    $('#message').submit(function(event)
                    {
                        event.preventDefault();
                        var message = prompt("Message this User: ");
                        console.log(message);
                        var arr = $(this).serialize();
                        //console.log("Data from array: "+arr.toString());
                        var arr_to_string = arr.toString();


                        for(var i =0 ; i<arr_to_string.length; i++)
                        {
                            console.log("Loop Count :"+i);
                            console.log(arr_to_string.charAt(i));
                            if(arr_to_string.charAt(i) == '&')
                            {
                                console.log(arr_to_string.charAt(i));
                                carrot = i;
                            }
                        }

                        var carrot  = arr_to_string.indexOf('&');
                        console.log("Carrot : " +carrot);
                        id_1 = arr_to_string.substr(0 , carrot);
                        console.log("ID 1 : "+id_1);
                        id_1 = id_1.substr(5);
                        console.log("ID 1 : "+id_1);

                        id_2 = arr_to_string.substr((carrot+1));
                        id_2 = id_2.substr(5);

                        id_2 = "inst_"+id_2;



                        $.ajax(
                            {
                                type: 'POST',
                                url: '../bbl_framework/util/formal_message.php',
                                data: {to :id_2, from : id_1, message:message},
                                dataType: 'json',
                                success: function (data)
                                {
                                    console.log(data);
                                    alert("Message sent.");
                                }
                            });

                    });


                </script>
            <?php }
            ?>
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