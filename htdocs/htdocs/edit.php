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

$pas_list = $user_creator->getPassions($id);

$pro_pic_root = "user_images/".$user_creator->getProfilePicture($id);
?>

<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $user->getFirstName()."'s";?>Bubble Profile </title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="" />
    <link href="http://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-panels.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/new_nav_style.css"/>
</head>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#close_li').hide();
 });
</script>
<body>




<script type="text/javascript">
$('#provide_form').submit(function(event)
{
alert("button");
event.preventDefault();
event.stopImmediatePropagation();
// alert("Default prevented");//
// ajax time //
$.ajax(
{
type: 'POST',
url: '../bbl_framework/ajax_directory/user_data_provide.php',
data: $(this).serialize(),
dataType: 'json',
success: function (data)
{
console.log(data);
alert("Data updated");
}
});
// alert("Data updated from you form");
});


$('#seeking_form').submit(function(event)
{
event.preventDefault();
event.stopImmediatePropagation();
// alert("Default prevented");//
// ajax time //
$.ajax(
{
type: 'POST',
url: '../bbl_framework/ajax_directory/user_data_seeking.php',
data: $(this).serialize(),
dataType: 'json',
success: function (data)
{
console.log(data);
alert("Data updated");
}
});
// alert("Data updated from you form");
});


//
$('#passion_form').submit(function(event)
{
alert("GOOGOGOGO");
event.preventDefault();
event.stopImmediatePropagation();
// alert("Default prevented");//
// ajax time //
$.ajax(
{
type: 'POST',
url: '../bbl_framework/ajax_directory/user_data_passions_update.php',
data: $(this).serialize(),
dataType: 'json',
success: function (data)
{
console.log(data);
alert("Data updated");
}
});

});

$('#goal_form').submit(function(event)
{
//alert("Ok working");
event.preventDefault();
event.stopImmediatePropagation();
// alert("Default prevented");//
// ajax time //
$.ajax(
{
type: 'POST',
url: '../bbl_framework/ajax_directory/user_data_goals_update.php',
data: $(this).serialize(),
dataType: 'json',
success: function (data)
{
console.log(data);
alert("Goals Updated");
}
});

});

$('#ach_form').submit(function(event)
{
event.preventDefault();
event.stopImmediatePropagation();

// alert("Default prevented");//
// ajax time //
$.ajax(
{
type: 'POST',
url:  '../bbl_framework/ajax_directory/user_data_ach_update.php',
data: $(this).serialize(),
dataType: 'json',
success: function (data)
{
console.log(data);
alert("Achivements updated");
}
});

});

$('#you_form').submit(function(event)
{
event.preventDefault();
event.stopImmediatePropagation();

// alert("Default prevented");//
// ajax time //
$.ajax(
{
type: 'POST',
url: '../bbl_framework/ajax_directory/user_data_you_update.php',
data: $(this).serialize(),
dataType: 'json',
success: function (data)
{
console.log(data);
alert("Data updated");
}
});
// alert("Data updated from you form");

});



$('#zip_form').submit(function(event)
{
event.preventDefault();
event.stopImmediatePropagation();

// alert("Default prevented");//
// ajax time //
$.ajax(
{
type: 'POST',
url: '../bbl_framework/ajax_directory/user_zip_update.php',
data: $(this).serialize(),
dataType: 'json',
success: function (data)
{
console.log(data);
alert("Data updated");
}
});
// alert("Data updated from you form");

});

</script>
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
        <div id ="tbl_div" align="center" style="width: 80%;">
            <table id = "nav_table" style="width: 80%;">
                <tr>
                    <td  class="nav_section" style="font-size:100%"><a href="enhanced_about_me.php"> About Me </a></td>
                    <td  class="nav_section" style="font-size:100%"><a href="photos.php">Photos </a></td>
                    <td  class="nav_section" style="font-size:100%"><a href="posts.php">Posts </a></td>
                    <td  class="nav_section" style="font-size:100%"><a href="#">Friends </a></td>
                </tr>
            </table>
        </div>
    </header>
</center>

<!----------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------->
<!-------------------------------PUT CONTENT BELOW----------------------------------->
<div id="main">

    <div id = "body_header">
        <div>
            <p>&nbsp;</p>
        </div>

        <div align="center" id = "div_in_header" style="width:70%; margin-left:auto; margin-right:auto; ">
            <br>
            <br>
            <h2 style="color: white; font-size: 200%;"> Edit your information</h2> <br>
        </div>
        <p>&nbsp;</p>

        <div align="center" style="font-size: 200%;">
                <h3 align="center"> Choose Profile Picture </h3>

                <form id="form_1" method="post" action="../bbl_framework/ajax_directory/ajax_upload_profile_picture.php" enctype="multipart/form-data">
                    <input type='file' id="file" name ="file" align="left"/>
                    <?php if($pro_pic_root == NULL){?>
                    <div align="center" style="max-height: 100%;"> <img id="blah" src="../css/images/icon-bubble.png" alt="your image" /> </div>
                    <?php } else
                    {?>
                    <div align="center" style="max-height: 100%;"> <img id="blah" src="<?php echo $pro_pic_root;?>" alt="your image" /> </div>
                    <?php }?>
                    <button type="button" onclick="handle_profile_picture();"> Set Profile Picture </button>
                </form>

            </div>

                <script type="text/javascript">
                    function readURL(input)
                    {

                        if (input.files && input.files[0])
                        {
                            var reader = new FileReader();

                            reader.onload = function (e)
                            {
                                $('#blah').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $("#file").change(function(){
                        readURL(this);
                    });

                    function handle_profile_picture(eve)
                    {
                         $("#form_1").submit();
                    }
                </script>
            <hr>
            <center>

                <div class="col-6 col-sm-6 col-lg-4">
                    <div style="padding : 10px;">
                        <h2 style="color: gray; font-size: 250%;"> Passions </h2>
                        <form id = "passion_form" method="post" style="padding:10px;">
                            <textarea id = "passion" name="passion" rows="5" cols="20" style="width: 50%; height: 150px;"> <?php
                                   $passion_array = $user_creator->getPassions($id);
                                   if(!$passion_array)
                                   {
                                       echo "No passions provided yet, provide some. What captivates you?";
                                   }
                                   else
                                   {
                                       for($z=0; $z<sizeof($passion_array); $z++)
                                       {
                                           if($z!=(sizeof($passion_array)-1))
                                           {
                                               echo($passion_array[$z]).",";
                                           }
                                           else
                                           {
                                               echo($passion_array[$z]);
                                           }
                                       }

                                   }
                                ?>
                            </textarea>
                            <input type="hidden" value="<?php echo $id;?>" id = "hidden_id" name = "hidden_id">
                            <br>
                            <input type="submit" value="Save Passions"/>
                        </form>
        <script type="text/javascript">
        $('#passion_form').submit(function(event)
         {
        event.preventDefault();
                        event.stopImmediatePropagation();
                        // alert("Default prevented");//
                        // ajax time //
                        $.ajax(
                        {
                        type: 'POST',
                        url: '../bbl_framework/ajax_directory/user_data_passions_update.php',
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function (data)
                        {
                        console.log(data);
                        alert("Data updated");
                        }
                        });
       });
    </script>


                    </div><!--/span-->
                <p>&nbsp;</p>

                <div class="col-6 col-sm-6 col-lg-4">
                    <h2 style="color: gray; font-size: 250%;"> Goals </h2>
                    <form id = "goal_form" method="post" style="padding:10px;">
                        <textarea id = "goal" name="goal" rows="5" cols="20"style="width: 50%; height: 150px;"><?php
                            $goals_array = $user_creator->getGoals($id);
                            if(!$goals_array)
                            {
                                echo "No goals provided yet, provide some. What are some things you wish to accomplish?";
                            }
                            else
                            {
                                for($z=0; $z<sizeof($goals_array); $z++)
                                {
                                    if($z!=(sizeof($goals_array)-1))
                                    {
                                        echo($goals_array[$z]).",";
                                    }
                                    else
                                    {
                                        echo($goals_array[$z]);
                                    }
                                }

                            }
                            ?></textarea>
                        <input type="hidden" value="<?php echo $id ?> "id = "hidden_id" name = "hidden_id">
                        <br>
                        <input type="submit" value="Save Goals"/>
                    </form>

                    <script type="text/javascript">
                        $('#goal_form').submit(function(event)
                        {
                            event.preventDefault();
                            event.stopImmediatePropagation();
                            // alert("Default prevented");//
                            // ajax time //
                            $.ajax(
                                {
                                    type: 'POST',
                                    url: '../bbl_framework/ajax_directory/user_data_goals_update.php',
                                    data: $(this).serialize(),
                                    dataType: 'json',
                                    success: function (data)
                                    {
                                        console.log(data);
                                        alert("Data updated");
                                    }
                                });
                        });
                    </script>
                </div><!--/span-->
                <p>&nbsp;</p>


        <div class="col-6 col-sm-6 col-lg-4">
            <h2  style="color: gray; font-size: 250%;"> Achievements </h2>
            <form id = "ach_form" method="post" style="padding:10px;">
                <textarea id = "ach" name="ach" rows="5" cols="20"style="width: 50%; height: 150px;"><?php
                    $ach_array = $user_creator->getAchievements($id);
                    if(!$ach_array)
                    {
                        echo "No achivements provided yet, provide some. What are some of your finest accomplishments?";
                    }
                    else
                    {
                        for($z=0; $z<sizeof($ach_array); $z++)
                        {
                            if($z!=(sizeof($ach_array)-1))
                            {
                                echo($ach_array[$z]).",";
                            }
                            else
                            {
                                echo($ach_array[$z]);
                            }
                        }

                    }
                    ?></textarea>
                <input type="hidden" value="<?php echo $id?> "id = "hidden_id" name = "hidden_id">
                <br>
                <input type="submit" value="Save Achivements"/>
            </form>

            <script type="text/javascript">
                $('#ach_form').submit(function(event)
                {
                    event.preventDefault();
                    event.stopImmediatePropagation();
                    // alert("Default prevented");//
                    // ajax time //
                    $.ajax(
                        {
                            type: 'POST',
                            url: '../bbl_framework/ajax_directory/user_data_ach_update.php',
                            data: $(this).serialize(),
                            dataType: 'json',
                            success: function (data)
                            {
                                console.log(data);
                                alert("Data updated");
                            }
                        });
                });
            </script>
        </div><!--/span-->


                <p>&nbsp;</p>

        <div class="col-6 col-sm-6 col-lg-4">
            <h2  style="color: gray; font-size: 250%;"> What makes you, <strong> you </strong>? </h2>
            <form id = "you_form" method="post" style="padding:10px;">
                <textarea id = "you" name="you" rows="5" cols="20"style="width: 50%; height: 150px;"><?php
                    $you = $user_creator->getUnique($id);
                     if($you)
                     {
                         echo $you;
                     }
                    else{
                        echo "Tell us something unique about yourself. What makes <strong> you</strong> different?";
                    }
                     ?>
                </textarea>
                <input type="hidden" value="<?php echo($id)?>"id = "hidden_id" name = "hidden_id">
                <br>
                <input type="submit" value="Save Data"/>
            </form>
            <script type="text/javascript">
                $('#you_form').submit(function(event)
                {
                    event.preventDefault();
                    event.stopImmediatePropagation();
                    // alert("Default prevented");//
                    // ajax time //
                    $.ajax(
                        {
                            type: 'POST',
                            url: '../bbl_framework/ajax_directory/user_data_you_update.php',
                            data: $(this).serialize(),
                            dataType: 'json',
                            success: function (data)
                            {
                                console.log(data);
                                alert("Data updated");
                            }
                        });
                });
            </script>




        </div><!--/span-->
        <br>
        <br>

        <!--- Sence these are not new additions, we need to run an update script instead of an insert -->

                <p>&nbsp;</p>



<hr>

                <div align="center" id = "div_in_header" style="width:80%; margin-left:auto; margin-right:auto; ">
                    <br>
                    <br>
                    <h4 style="color: white; font-size: 150%;" >Optional : Information Provided below will be for use in Core to find others.</h4> <br><p>&nbsp;</p>
                </div>

                <br>
</center>
<div align="center">
<h4 style="color: gray; font-size: 150%;"> Zip Code </h4>
<form id = "zip_form" method="post" style="padding:10px;">
    <?php $zip = $user_creator->getZipCode($id);?>
    <input id = "zip" name="zip" rows="5" cols="10" style="font-size: 100%;" value="<?php if($zip == NULL){echo "Not yet provided";}else{echo $zip;}?>">
    <br>
    <input type="hidden" value="<?php echo $id ?> "id = "hidden_id" name = "hidden_id">
    <input type="submit" value="Save Data"/>
</form>
    <script type="text/javascript">
        $('#zip_form').submit(function(event)
        {
            event.preventDefault();
            event.stopImmediatePropagation();
// alert("Default prevented");//
// ajax time //
            $.ajax(
                {
                    type: 'POST',
                    url: '../bbl_framework/ajax_directory/user_zip_update.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(data)
                    {
                        console.log(data);
                        alert("Data updated");
                    }
                });
// alert("Data updated from you form");
        });
    </script>



<p>&nbsp;</p>

<h4 style="color: gray; font-size: 150%;"> Providing </h4>
<form id = "provide_form" method="post" style="padding:10px;">
    <textarea id = "providing" name="providing" rows="5" cols="10"style="width: 50%; height: 150px;"><?php
         $provide_array = $user_creator->getProvides($id);
        for($s=0; $s<sizeof($provide_array); $s++)
        {
            if($s!=(sizeof($provide_array)-1))
            {
                echo($provide_array[$s].",");
            }
            else
            {
                echo $provide_array[$s];
            }
        }
        ?></textarea>
 <br>
 <input type="hidden" value="<?php echo $id ?> "id = "hidden_id" name = "hidden_id">
 <input type="submit" value="Save Data"/>



</form>
    <script type="text/javascript">
        $('#provide_form').submit(function(event)
        {
            event.preventDefault();
            event.stopImmediatePropagation();
// alert("Default prevented");//
// ajax time //
            $.ajax(
                {
                    type: 'POST',
                    url: '../bbl_framework/ajax_directory/user_data_provide.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (data)
                    {
                        console.log(data);
                        alert("Data updated");
                    }
                });
// alert("Data updated from you form");
        });
 </script>




        <p>&nbsp;</p>





<h4 style="color: gray; font-size: 150%;"> Seeking </h4> <p style="font-size:50%;"> This information will be kept private unless searched upon by criteria </p>
<form id = "seeking_form" method="post" style="padding:10px;">
    <textarea id = "seeking" name="seeking" rows="5" cols="10"style="width: 50%; height: 150px;">What skills/services would help you move forward?</textarea>
    <input type="hidden" value="<?php echo $id ?> "id = "hidden_id" name = "hidden_id">
    <br>
    <input type="submit" value="Save Data"/>
</form>
    <script type="text/javascript">
        $('#seeking_form').submit(function(event)
        {
            event.preventDefault();
            event.stopImmediatePropagation();
// alert("Default prevented");//
// ajax time //
            $.ajax(
                {
                    type: 'POST',
                    url: '../bbl_framework/ajax_directory/user_data_seeking.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (data)
                    {
                        console.log(data);
                        alert("Data updated");
                    }
                });
// alert("Data updated from you form");
        });
    </script>

    </div>




<div style="backround : gray;">
    <p>
    <p>
</div>

<hr>
</div>
<!-- Footer -->
<div id="footer">

    <!-- Copyright -->
    <div class="copyright">
        <p>&copy; 2014 Bubbl All rights reserved.</p>
        <ul class="menu">
            <li>Design: Kyle Harris</li>
            <li>Images: <a href="http://ineedchemicalx.deviantart.com">Felicia Simion</a></li>
        </ul>
    </div>

</div>

<script type="text/javascript">
    $('#form1').submit(function(event)
    {
        event.preventDefault();
        $.ajax(
            {
                type: 'POST',
                url: '../bbl_framework/ajax_directory/ajax_aboutme.php',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (data)
                {
                    console.log(data);
                    alert("Data updated");
                }
            });
    });

</script>

<script type="text/javascript">
    $('#form2').submit(function(event)
    {
        event.preventDefault();
        $.ajax(
            {
                type: 'POST',
                url: '../bbl_framework/ajax_directory//ajax_portfolio.php',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (data)
                {
                    console.log(data);
                    alert("Data updated");
                }
            });
    });

</script>












    <!---------------------------------PUT CONTENT ABOVE--------------------------------->
    <!----------------------------------------------------------------------------------->
    <!----------------------------------------------------------------------------------->
    <!----------------------------------------------------------------------------------->

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
</div>
</body>

</html>