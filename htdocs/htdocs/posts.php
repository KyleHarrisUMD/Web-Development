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
    <!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
</head>

<script type="text/javascript">
    $(document).ready(function()
    {
        $('#close_li').hide();
    });

    $(document).ready(function()
    {
        $('#video_preview').hide();
        $('#audio_preview').hide();
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
                <h1>Your Posts</h1> <br><p>&nbsp;</p>
            </div>

            <br>
            <br>

            <div  id = "new_post_div" style="width: 80%; border:2px solid black;">
                <form id = "file_form" method="post" action="../bbl_framework/util/post_upload.php" class="login_form" enctype="multipart/form-data">
                    <div>
                        <table align = "center" style="width: 100%; display: inline;"><tr><td>Text<input type="radio" name = "file_type" value="text"></td><td>Image<input type="radio" name = "file_type" value="img"></td><td>Video <input type="radio" name = "file_type" value="vid"></td><td>Sound clip <input type="radio" name = "file_type" value="sound"></td></tr></table>
                        
                        
                        <br>
                        <br>
                        <p width = "75%" height = "90%"> </p> 
                        <img src ="" width="75%"height="90%" id = "img_preview">
                        <video src="" width="75%"height="90%" id = "video_preview"></video>
                        <audio src="" width="75%"height="90%" id = "audio_preview"></audio>
                        <input type="file" id="file_input" onchange="showPreview()" name = "file_input">
                        </p>
                    </div>
                    <!--<img class="placeholder" id = "img_placeholder"> -->
                    <textarea id = "proud_textarea"  style="width: 80%;" name="proud_textarea">Description</textarea>
                    <br>
                    <p align="center"><input type="submit"/> </p>

                </form>
               </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
                <script type = text/javascript>
                    function showPreview()
                    {
                        var radios = document.getElementsByName('file_type');
                        var type = '';
                        for (var i = 0, length = radios.length; i < length; i++)
                        {
                            if (radios[i].checked)
                            {
                                // alert(radios[i].value);
                                type = radios[i].value;
                            }
                        } 
                       
                        if(type == "text")
                        {
                        
                        }
                        else if(type == "img")
                        {
                            var preview = $('#img_preview');
                            var file = document.getElementById('file_input').files[0];
                            var reader = new FileReader();
                            // need to check file type // - we can parse at the
                            // '.' and then get the remaining chars from there //
                            reader.onloadend = function()
                            {
                                console.log($('#file_input').src);
                                preview.attr('src' , reader.result);
                            }
                            if(file)
                            {
                                reader.readAsDataURL(file);
                            }
                            else
                            {
                                preview.attr('src' , '');
                            }
                        } else if (type == "vid")
                        {
                            // same thing except unhide the video preview  and hide the image & sound preview //
                            alert("TYPE = VIDEO");
                            $('#video_preview').show();
                            $('#img_preview').hide();

                            var preview = $('#video_preview');
                            var file = document.getElementById('file_input').files[0];
                            var reader = new FileReader();
                            // need to check file type // - we can parse at the
                            // '.' and then get the remaining chars from there //
                            reader.onloadend = function()
                            {
                                // console.log($('#file_input').src);
                                preview.attr('src' , reader.result);
                            }
                            if(file)
                            {
                                reader.readAsDataURL(file);
                            }
                            else
                            {
                                preview.attr('src' , '');
                            }

                        }else if (type == "sound")
                        {
                            alert("TYPE = audio");
                            $('#audio_preview').show();
                            $('#img_preview').hide();

                            var preview = $('#audio_preview');
                            var file = document.getElementById('file_input').files[0];
                            var reader = new FileReader();
                            // need to check file type // - we can parse at the
                            // '.' and then get the remaining chars from there //
                            reader.onloadend = function()
                            {
                                // console.log($('#file_input').src);
                                preview.attr('src' , reader.result);
                            }
                            if(file)
                            {
                                reader.readAsDataURL(file);
                            }
                            else
                            {
                                preview.attr('src' , '');
                            }

                        }
                    }
                </script>
                </div>
            </div>
        </section>
    </section>

<section>
    
    <div id = "posts_div">

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
            <?php }else if ($assoc_type[$num_posts] == "text")
            { ?> 
	           
	           <center><div style="width : 75%; border : 1px solid black;"> 
	           <div class="text_post">
	           <p>  <?php echo $assoc_text[$num_posts]; ?> </p>
	           </div>
	           </div>
	           
	           <br> 
	           <br></center>
	          <?
	            
            }} ?>

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