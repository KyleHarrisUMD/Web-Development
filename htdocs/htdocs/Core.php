<?php session_start();?>
<?php $id = '';?>
<?php if(isset($_SESSION['id_num']))
{
    $id = $_SESSION['id_num'];
}
?>
<?php
/// important includes  //
$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/bbl_framework/util/UserCreator.php");
include($path."/bbl_framework/util/QueryRunner.php");

$x = new QueryRunner();
$res = $x->runQueryWithRes("SELECT * FROM users WHERE id = '".$id."';");

$user = '';
$uc = new UserCreator();

while($row = mysqli_fetch_array($res)) // fetch results as array and print data
{
    $user = $uc->createNewUser($row['id'],$row['first_name'],$row['last_name'],$row['email'],$row['password']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Goal Assist</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet" type="text/css" />
    <script src="js/html5shiv.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-panels.min.js"></script>
    <script src="js/init.js"></script>
    <noscript>
        <link rel="stylesheet" href="css/skel-noscript.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-wide.css" />
    </noscript>
    <link rel="stylesheet" href="css/ie9.css" />
    <link rel="stylesheet" href="css/ie8.css" />
    <link rel="stylesheet" href="css/new_nav_style.css"/>
</head>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#close_li').hide();
    });
    $(document).ready(function(event)
    {
        $('#advanced_hide').hide();
        $('#advanced_specs').hide();
    });
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript">
    var user_zip;
    $(function()
    {
        if(navigator.geolocation)
        {
            var fallback = setTimeout(function() { fail('60 seconds expired'); }, 60000);
            navigator.geolocation.getCurrentPosition
            (
                function (pos)
                {
                    clearTimeout(fallback);
                    console.log('pos', pos);
                    var point = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
                    new google.maps.Geocoder().geocode({'latLng': point}, function (res, status) {
                        if(status == google.maps.GeocoderStatus.OK && typeof res[0] !== 'undefined')
                        {
                            var zip = res[0].formatted_address.match(/,\s\w{2}\s(\d{5})/);
                            if(zip)
                            {
                                //alert('Zip code is ' +  zip[1]);
                                user_zip = zip[1];
                                //zip_set = true;

                            } else fail('Failed to parse');
                        } else {
                            fail('Failed to reverse');
                        }
                    });
                }, function(err) {
                    fail(err.message);
                }
            );
        } else
        {
            $("._res").html('Geolocation unsupported!');
        }
        function fail(err)
        {
            console.log('err', err);
            alert('Error ' + err);
        }
    });

</script>
<body>
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

            </div>
        </header>
    </center>

    <section>
        <!-- now we can add profile elements -->
        <div id = "body_header">

            <!-- Intro -->

            <section id="about" class="three">
                <div class="container" align = "center">
                    <hr>
                    <div style="width: 80%; border: 5px solid gray; border-radius: 20px;" id="div_in_header">
                        <center><h1 align="center" style="color: white">Goal Assist</h1></center>
                        <center><h3 align="center" style="color: black; text-decoration: underline">Search Criteria</h3></center>


                        <form method="post">
                            <select id = "member_select" style="width: 50%; font-size: 110%;">
                                <option value="person" id = "indiv" style="width: 90%; font-size: 110%;">Individual Person</option>
                                <option value="inst" id ="instit" style="width: 90%; font-size: 110%;">Institutional Member</option>
                            </select>
                            <br>

                            <select id = "seek_prov"  style="width: 50%; font-size: 110%;">
                                <option value="providing">Providing</option>
                                <br>
                                <option value="seeking">Seeking</option>
                            </select>
                            <br>
                            <p> <input style="width: 30%; font-size: 110%;" type="text" id="critera" name="critera"> </p>

                            <div>
                                <h3 style="color: floralwhite;"> Within <input type="number"  id = "rad" name = "rad" size="4" maxlength="3" style="width: 30%; font-size: 110%;"> Miles</h3>
                            </div>
                            <br>
                            <p> <button id = "find_button"> Find </button></p>
                        </form>
                        <div>

                            <p>&nbsp;</p>
            </section>


            <p></p>
            <div align = "center">
                <button  id = "advanced">+ Advanced</button>
                <button  id = "advanced_hide">- Advanced</button>

                <div id = "advanced_specs">
                    <script type="text/javascript">
                        $(document).ready(function()
                        {
                            $('#close_li').hide();
                            $(".text_areas").hide();
                            $('#business_seek').hide();
                            $('#business_seeker').hide();

                        });



                    </script>
                    <form id ="seek_form" action="../bbl_framework/library/process_seeking_settings.php" method="post">
                        <table>
                            <tr>
                                <select>
                                    <option>Institutional Member</option>
                                    <option>Individual Member</option>
                                </select>

                                <select>
                                    <option>Providing</option>
                                    <option>Seeking</option>
                                </select>
                                <td class="label_class"><label>Mentoring:</label></td>
                                <td class="check_class"><input type="checkbox" class="option_check" id = "seek_mentor"></td>
                                <td class="ta_class"><textarea class="text_areas"  name = "assist_mentor_area" id ="seek_mentor_area" rows="5" cols="10" >Mentor Criteria</textarea></td>

                                <script type="text/javascript">
                                    $('#seek_mentor').change(function (event)
                                    {
                                        if($(this).is(':checked'))
                                        {
                                            $('#seek_mentor_area').slideDown();
                                        }
                                        else
                                        {
                                            $('#seek_mentor_area').slideUp();
                                        }
                                    });
                                </script>

                            </tr>

                            <tr>
                                <td><label>Instruction:</label></td>
                                <td><input type="checkbox" class="option_check" id = "seek_assist_ins"></td>
                                <td class="ta_class"><textarea class="text_areas" id ="seek_ins_area" name = "assist_instruct_area" rows="5" cols="10">Instructional Criteria</textarea></td>

                                <script type="text/javascript">
                                    $('#seek_assist_ins').change(function (event)
                                    {
                                        if($(this).is(':checked'))
                                        {
                                            $('#seek_ins_area').slideDown();
                                        }
                                        else
                                        {
                                            $('#seek_ins_area').slideUp();
                                        }
                                    });
                                </script>

                            </tr>

                            <tr>
                                <td><label>Job:</label></td>
                                <td><input type="checkbox" class="option_check" id = "seek_job"></td>
                                <td class="ta_class"><textarea class="text_areas" id ="seek_job_area" name ="assist_job_area" rows="5" cols="10" >Job Criteria</textarea></td>

                                <script type="text/javascript">
                                    $('#seek_job').change(function (event)
                                    {
                                        if($(this).is(':checked'))
                                        {
                                            $('#seek_job_area').slideDown();
                                        }
                                        else
                                        {
                                            $('#seek_job_area').slideUp();
                                        }
                                    });
                                </script>
                            </tr>

                            <tr>
                                <td><label>Seeking a property to rent:&nbsp;</label></td>
                                <td><input type="checkbox" class="option_check" value="Yes" id="a_p" name ="a_p"></td>

                            </tr>

                            <tr>
                                <td><label>Advice Starting a buisness</label></td>
                                <td><input type="checkbox" class="option_check" id = "seek_bus"></td>
                            </tr>
                            <tr id ="business_seeker">
                                <td>
                                    <form><span style="display: inline"><label>Seeking Advice:</label><input type="checkbox"></span><br><span><label>Seeking Capital:</label><input type="checkbox"></span></form>
                                </td>

                                <script type="text/javascript">
                                    $('#seek_bus').change(function (event)
                                    {
                                        if($(this).is(':checked'))
                                        {
                                            $('#business_seeker').show();
                                        }
                                        else
                                        {
                                            $('#business_seeker').hide();
                                        }
                                    });
                                </script>

                            </tr>

                        </table>

                        <?php $options  = "SELECT * FROM assist_options;"; $options_res = $x->runQueryWithRes($options);
                        $option_array = array();
                        while($row = mysqli_fetch_array($options_res))
                        {
                            array_push($option_array , $row['option']);
                        }
                        ?>
                        <select>
                            <?php foreach($option_array as $option_elem)
                            {?>
                                <option id="<?php echo $option_elem;?>"><?php echo $option_elem;?></option>
                            <?php }?>
                        </select>
                        <br>
                        <input type="submit" value="Search" id="login_btn">
                        <br>
                        <br>
                    </form>
                </div>


            </div>
            <p>&nbsp;</p>
    </section>

<style type="text/css">
    .form_span {
        width: 90%;
        margin-left: auto;
        margin-right: auto;
    }

    .option_check {
        width: 30px;
        height: 30px;
        vertical-align: middle;
        margin-left: auto;
    }

    span {
        display: inline-block;
    }

    #entire_settings {
        display: inline;
    }

    .text_areas
    {
        vertical-align: middle;
    }
</style>

</div>

<script type="text/javascript">
    $('#advanced').click(function (event)
    {
        $('#advanced_specs').slideDown();
        $('#advanced_hide').show();
        $('#advanced').hide();

    });
    $('#advanced_hide').click(function (event)
    {
        $('#advanced_specs').slideUp();
        $('#advanced').show();
        $('#advanced_hide').hide();
    });
</script>
</div>
<p></p>

<center>
    <iframe src = "../geo_test_beta.php" width="90%" seamless="seamless" style ="margin-left: auto; margin-right: auto;" id = "match_frame" height="500" style="border-radius:10px;">
    </iframe>
</center>


<!-- Portfolio -->
</div>

<!-- About Me -->
<script type="text/javascript">
    $("#find_button").click(function (e)
    {
        e.preventDefault();
        // we need the selection values //
        var type_member =$('#member_select').val();
        console.log(type_member);

        var rad = $('#rad').val();

        var seek_prov = $('#seek_prov').val();
        console.log(seek_prov);

        var critera = $('#critera').val();
        console.log(critera);
        var new_src = ("geo_test_beta.php?crit="+critera+"&memtype="+type_member+"&seek_prov="+seek_prov+"&cur_zip="+user_zip+"&rad="+rad);
        var i_frame = $('#match_frame');
        $('#match_frame').attr('src', new_src);
        return false;
    });
</script>
</div>

<!-- Footer -->

</body>
</html>