<?php session_start();?>
<?php
class post
{

    private $id;
    private $author;
    private $description;
    private $filepath;
    private $filetype;
    private $tag;
    private $post_num;



public function post($id,$author,$desc,$fp,$ft,$t,$num)
{
    $this->id = $id;
    $this->author = $author;
    $this->description = $desc;
    $this->filepath = $fp;
    $this->filetype = $ft;
    $this->tag = $t;
    $this->post_num = $num;

}

    public function getPostData()
    {
        $information_array = array();
        array_push($information_array , $this->id);
        array_push($information_array , $this->author);
        array_push($information_array , $this->description);
        array_push($information_array , $this->filepath);
        array_push($information_array , $this->filetype);
        array_push($information_array , $this->tag);
        array_push($information_array , $this->post_num);

        return $information_array;
    }

    public function getFileType()
    {
        return $this->filetype;

    }
    public function getFileRoot()
    {
        return $this->filepath;
    }

    public function getDescription()
    {
        return $this->description;

    }
    public function getTag()
    {
        return $this->tag;
    }
    public function getPostNum()
    {
        return $this->post_num;
    }

}

?>
<?php

$path = $_SERVER['DOCUMENT_ROOT'];
include_once($path.'/bbl_framework/util/QueryRunner.php');
include_once($path.'/bbl_framework/util/UserCreator.php');

?>
<?php

$id='';
if (isset($_SESSION['id_num']))
{
    $id = $_SESSION['id_num'];
}


$loaded_posts ;
$q_r = new QueryRunner();
$u_c = new UserCreator();

$current_user = $u_c->createNewUser($id);

$passions_list = $u_c->getPassions($id);
//var_dump($passions_list);
$post_list = postmatcher::findMatchingPosts($passions_list);
$sorted_posts = new ArrayObject($post_list);

$array_of_post_nums = array();
foreach($post_list as $elem)
{
    array_push($array_of_post_nums,$elem->getPostNum());
}
$sorted = sort($array_of_post_nums);
// so lets change some stuff //

$newly_sorted = array();
foreach($array_of_post_nums as $e)
{
    $temp_post = getPostByPostNum($e);
    array_push($newly_sorted, $temp_post);
}

$post_list = $newly_sorted;

function getPostByPostNum($num)
{
    $q_r = new QueryRunner();

    $sql = "SELECT * FROM instant_posts WHERE post_num = '".$num."'";
    $res = $q_r->runQueryWithRes($sql);
    while($row = mysqli_fetch_array($res))
    {
        $temp_post = new post($row['id'],$row['author'],$row['description'],$row['file_path'],$row['file_type'],$row['tag'],$row['post_num']);
    }
    return $temp_post;

}



class postmatcher
{
static function findMatchingPosts($passions_list)
{
    $posts = array();
    foreach($passions_list as $elem)
    {
        $q_r = new QueryRunner();

        $sql = "SELECT * FROM instant_posts WHERE tag = '%".$elem."%' ORDER BY post_num ASC LIMIT 2;";
        $res = $q_r->runQueryWithRes($sql);

        while($row = mysqli_fetch_array($res))
        {
            $temp_post = new post($row['id'],$row['author'],$row['description'],$row['file_path'],$row['file_type'],$row['tag'],$row['post_num']);
            array_push($posts,$temp_post);
        }
    }
    return $posts;
}
}
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

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
    <script type="application/javascript">

        // by default hide video and sound //
        $(document).ready(function()
        {
            $('#video_preview').hide();
            $('#audio_preview').hide();
        });


            $(document).ready(function()
            {
                $('#close_li').hide();
                $('.comments').hide();
                $('.hide_comments').hide();
            });
    </script>

<script type="text/javascript">
    $(document).ready(function()
    {


        $(window).scroll(function(event)
        { /* window on scroll run the function using jquery and ajax */
            event.preventDefault();
           // event.stopImmediatePropagation();
            var WindowHeight = $(window).height(); /* get the window height */
            if($(window).scrollTop() +1 >= $(document).height() - WindowHeight){ /* check is that user scrolls down to the bottom of the page */
                $("#loader").html("<img src='/css/images/loading_icon.gif' alt='loading'/>"); /* displa the loading content */
                var LastDiv = $('.hidden_post_form:last'); /* get the last div of the dynamic content using ":last" */
                var LastId  = $('.hidden_post_form:last').attr('id');
                var ValueToPass = "lastid="+LastId;/* create a variable that containing the url parameters which want to post to getdata.php file */
                $.ajax({ /* post the values using AJAX */
                    type: "POST",
                    url: "../bbl_framework/util/fetchMorePosts.php",
                    data: ValueToPass,
                    async : false,
                    cache: true,
                    success: function(html)
                    {
                        $("#loader").html("");
                        html = html.replace("true", "");
                        $("#posts_div").append(html);


                    }
                });
                return false;
            }
            return false;
        });
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

        <!-- now we can add profile elements -->
        <div id = "body_header">
            <div>
                <p>&nbsp;</p>
            </div>

            <div align="center" id = "div_in_header" style="width:80%; margin-left:auto; margin-right:auto; ">
                <br>
                <br>
                <h1>Instant</h1> <br><p>&nbsp;</p>
             </div>
            <hr>
 <h3>Post to instant :</h3>

            <div  id = "new_post_div" style="width: 80%; border:2px solid black;">
                <form id = "file_form" method="post" action="../bbl_framework/util/instant_upload.php" class="login_form" enctype="multipart/form-data">
                    <div>
                        <table align = "center" style="width: 100%; display: inline;"><tr><td>Image<input type="radio" name = "file_type" value="img"></td><td>Video <input type="radio" name = "file_type" value="vid"></td><td>Sound clip <input type="radio" name = "file_type" value="sound"></td></tr></table>
                        <br>
                        <br>
                        <img src ="" width="75%"height="90%" id = "img_preview">
                        <video src="" width="75%"height="90%" id = "video_preview"></video>
                        <audio src="" width="75%"height="90%" id = "audio_preview"></audio>
                        <input type="file" id="file_input" onchange="showPreview()" name = "file_input">

                    <!--<img class="placeholder" id = "img_placeholder"> -->
                    <textarea id = "proud_textarea"  style="width: 80%;" name="proud_textarea">Description</textarea>
                    <br>
                    <label for="tag"> Tag :</label> <input type="text" id = "tag" name = "tag"style="width: 20%">
                    <br>
                    <p align="center"><input type="submit"/> </p>
                </form>
               </div>
            </div>
  </h3>

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

                        if(type == "img")
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
        <br>
        <br>
        <br>
        <hr>
    </section>

<section>
    <br>
    <br>

    <div id = "posts_div">

        <?php
        for($x=0; $x<sizeof($post_list); $x++)
        {
            $assoc_type = $post_list[$x]->getFileType();
            if($assoc_type == "img")
            {
                ?>
                <div class ="img_post">
                    <img src="/js_img_test/<?php echo $post_list[$x]->getFileRoot();?>" class = "post_img">
                    <br>
                    <br>
                    <h3 class = "post_decript"><?php echo $post_list[$x]->getDescription(); ?></h3>
                    <br>
                    <h4><stong>Tag :</stong><?php echo $post_list[$x]->getTag();?></h4>
                    <hr>
                    <form action="" id =<?php echo $post_list[$x]->getPostNum()?> class  = "hidden_post_form">
                        <input type="hidden" value="<?php echo $current_user->getFirstName()." ".$current_user->getLastName()?>" class = "hidden_author" name="hidden_author">
                        <input type="hidden" value="<?php echo $post_list[$x]->getPostNum()?>" class = "hidden_id" name="hidden_id">
                        <input type="hidden" value="<?php echo $current_user->getId()?>" class = "user_id" name="user_id">
                        <textarea style="width: 90%; height: 20%;" class="comment_poster" name ="hidden_comment">Post a comment</textarea>
                        <center class="center"><input class = "comment_post" type="button" value="Post" onclick="postComment();"/></center>
                    </form>
                    <hr>
                    <?php include_once($path."/bbl_framework/library/CommentFetcher.php");
                    $temp_comments = getComments($post_list[$x]->getPostNum());
                    if($temp_comments)
                    {
                    //var_dump($temp_comments);
                    ?>
                    <p align="left"> <button class="show_comments" onclick=""> Show Comments </button> </p>
                    <div class = "comments">
                        <?php
                        foreach($temp_comments as $elem)
                        {
                            echo "<hr><p align='left'>".$elem->getAuthor()."<br> Comment : &nbsp;".$elem->getComment()."</p>";
                        }

                        ?>
                        <button class="hide_comments" onclick=""> Hide Comments </button> <?php }?>
                    </div>
                </div>
                <br>
                <br>
                <br>
            <?php } else if ($assoc_type == "vid")
            {?>
                <div class ="img_post">
                    <video controls="controls" src="/js_img_test/<?php echo $post_list[$x]->getFileRoot();?>" class = "post_vid"> </video>
                    <br>
                    <br>
                    <h3 class = "post_decript"><?php echo $post_list[$x]->getDescription(); ?></h3>
                    <br>
                    <h4><stong>Tag :</stong><?php echo $post_list[$x]->getTag();?></h4>
                    <hr>
                    <form action="" id =<?php echo $post_list[$x]->getPostNum()?>  class  = "hidden_post_form">
                        <input type="hidden" value="<?php echo $current_user->getFirstName()." ".$current_user->getLastName()?>" class = "hidden_author" name="hidden_author">
                        <input type="hidden" value="<?php echo $post_list[$x]->getPostNum()?>" class = "hidden_id" name="hidden_id">
                        <input type="hidden" value="<?php echo $current_user->getId()?>" class = "user_id" name="user_id">
                        <textarea style="width: 90%; height: 20%;" class="comment_poster" name ="hidden_comment">Post a comment</textarea>
                        <center class="center"><input class = "comment_post" type="button" value="Post" onclick="postComment();"/></center>
                    </form>
                    <hr>
                    <?php include_once($path."/bbl_framework/library/CommentFetcher.php");
                    $temp_comments = getComments($post_list[$x]->getPostNum());
                    if($temp_comments)
                    {
                    //var_dump($temp_comments);
                    ?>
                    <p align="left"> <button class="show_comments" onclick=""> Show Comments </button> </p>
                    <div class = "comments">
                        <?php
                        foreach($temp_comments as $elem)
                        {
                            echo "<hr><p align='left'>".$elem->getAuthor()."<br> Comment : &nbsp;".$elem->getComment()."</p>";
                        }

                        ?>
                        <button class="hide_comments" onclick=""> Hide Comments </button><? }?>
                    </div>
                </div>
                <br>
                <br>
                <br>
            <?php } else if ($assoc_type[$num_posts] == "sound") {?>
                <div class ="img_post">
                    <audio controls="controls" src="/js_img_test/<?php echo $post_list[$num_posts]->getFileRoot();?>" class = "post_vid">
                        <br>
                        <br>
                        <h3 class = "post_decript"><?php $post_list[$num_posts]->getDescription(); ?></h3>
                        <hr>
                        <hr>
                        <form action="" id =<?php echo $post_list[$x]->getPostNum()?>  class  = "hidden_post_form">
                            <input type="hidden" value="<?php echo $current_user->getFirstName()." ".$current_user->getLastName()?>" class = "hidden_author" name="hidden_author">
                            <input type="hidden" value="<?php echo $post_list[$x]->getPostNum()?>" class = "hidden_id" name="hidden_id">
                            <input type="hidden" value="<?php echo $current_user->getId()?>" class = "user_id" name="user_id">
                            <textarea style="width: 90%; height: 20%;" class="comment_poster" name ="hidden_comment">Post a comment</textarea>
                            <center class="center"><input class = "comment_post" type="button" value="Post" onclick="postComment();"/></center>
                        </form>
                        <hr>
                        <?php include_once($path."/bbl_framework/library/CommentFetcher.php");
                        $temp_comments = getComments($post_list[$x]->getPostNum());
                        if($temp_comments)
                        {
                        //var_dump($temp_comments);
                        ?>
                        <p align="left"> <button class="show_comments" onclick=""> Show Comments </button> </p>
                        <div class = "comments">
                            <?php
                            foreach($temp_comments as $elem)
                            {
                                echo "<hr><p align='left'>".$elem->getAuthor()."<br> Comment : &nbsp;".$elem->getComment()."</p>";
                            }

                            ?>
                            <button class="hide_comments" onclick=""> Hide Comments </button> <? }?>
                        </div>
                </div>
                <br>
                <br>
                <br>
            <?php }} ?>
    </div>



</div>

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

    $('.show_comments').click(function()
    {
        $(this).parent().next('.comments').slideDown();
        $(this).hide();
        $('.hide_comments').show();

    });

    $('.hide_comments').click(function()
    {
        $(this).parent().slideUp();
        $(this).hide();
        $('.show_comments').show();

    });

    $('.comment_post').click(function()
    {
        //alert($(this).parent().parent().attr('class'));
        var author = $(this).parent().parent().children('.hidden_author').val();
        var id = $(this).parent().parent().children('.hidden_id').val();
        var comment  = $(this).parent().parent().children('.comment_poster').val();

        $.ajax
        (
            {
                type: 'POST',
                url: '../bbl_framework/library/post_comment.php',
                data: {hidden_id : id, hidden_author : author, hidden_comment:comment} ,
                dataType: 'json',
                success: function (data)
                {
                    location.reload();

                }
            });
    });
</script>

<div id="loader" align= "center">
</div>

</body>


</html>