<!DOCTYPE HTML>
<html>
<head>
    <title>Settings</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link href="http://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-panels.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/new_nav_style.css"/>
    <link rel="stylesheet" href="css/style-mobile.css">
    <link rel="stylesheet" href="css/style.css">
    <noscript>

    </noscript>
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="css/ie9.css"/><![endif]-->
    <!--[if lte IE 8]>
    <script src="js/html5shiv.js"></script><![endif]-->
</head>

<script type="text/javascript">
    $(document).ready(function()
    {
        $('#close_li').hide();
        $(".text_areas").hide();
        $('#business_seek').hide();
        $('#business_seeker').hide();

    });



</script>
<body>
<div id="main_nav" class="navigation">
    <ul class="nav_ul">
        <center>
            <li class="skel-panels"><h2 style="color: white;"><strong style="color: #ffffff;">User Navigation</strong>
                </h2></li>
        </center>
        <hr>
        <li><a href="edit.php" target="_self" id="edit-info-link"
               class="skel-panels"><span>&nbspEdit My Information</span></a></li>
        <hr>
        <li><a href="connect.php" target="_self" id="findfriends-link"
               class="skel-panels"><span>&nbspConnect.</span></a></li>
        <hr>
        <li><a href="upload_images.php" target="_self" id="upload_imgs-link" class="skel-panels"><span>&nbspUpload to Gallery</span></a>
        </li>
        <hr>
        <li><a href="posts.php" target="_self" id="my-posts-link" class="skel-panels"><span>&nbspPoster</span></a></li>
        <hr>
        <li><a href="interest_feed.php" target="_self" id="my-posts-link" class="skel-panels"><span>&nbspBulletin</span></a>
        </li>
        <hr>
        <li><a href="friends.php" target="_blank" id="my-posts-link" class="skel-panels"><span>&nbspFriends</span></a>
        </li>
        <hr>
        <li><a href="Core.php" target="_blank" id="my-posts-link" class="skel-panels"><span>&nbspCore</span></a></li>
        <hr>
        <li><a href="settings.html" target="_blank" id="my-posts-link"
               class="skel-panels"><span>&nbspSettings</span></a></li>
        <hr>
</div>

<!-- ********************************************************* -->

<div class="main-content">
<span>
    <ul style="list-style-type:none; padding: 0; margin: 0;">
        <li id="menu_li" style="list-style-type:none; font-size:200%;" class="_scroll_link" style="font-size:300%; position: fixed"><a
                href="#main_nav" id="menu_link" class="skel-panels"
                style="color: #ffffff; font-size: 200%;  text-decoration: none;"><span class="fa fa-expand-o" style="color: #ffffff"></span>+</a>
        </li>
        <li style="font-size:200%;" id="close_li" style="list-style-type:none; font-size:200%; position: fixed" class="_scroll_link"
            style="font-size:300%;"><a href="#" id="close_link" class="skel-panels"
                                       style="color: #ffffff; font-size: 200%;  text-decoration: none;"><span
                    class="fa fa-expand-o" style="color: #ffffff"></span>-</a></li>
    </ul>
</span>


<center>
    <header>
<span>
<div><br>

    <h3 style="text-decoration: underline; font-size:200%;" id="heading_title">Bubbl </h3>
</div>
</span>
    </header>
</center>

<section>
<!-- now we can add profile elements -->
<div id="body_header">
<div>
    <p>&nbsp;</p>
</div>

<div align="center" id="div_in_header" style="width:80%; margin-left:auto; margin-right:auto; ">
    <br>
    <br>

    <h1>Settings</h1> <br>

    <p>&nbsp;</p>
</div>

<div id="forms_div_main" align = "center">
<h2 style="color: black; text-decoration: underline; width: 100%;">Abmition Settings</h2>
<hr>
<br>

<div style="display: inline">
    <span style=" margin-right: auto; width: 40%; margin-left: 5%"><h3 style="text-decoration: underline; margin-right: auto;">Assisting with these serivces :</h3> </span>
    <span style="margin-left: auto;width:40%; margin-left: 5%;"><h3 style="text-decoration: underline; margin-left: auto">Seeking assistance with these services:</h3></span>
</div>


<div class="login_form_div_2" id="login_form" style="margin-right: auto;">
    <br>
    <br>

    <form id = "seeking_form" action="../bbl_framework/library/process_settings.php" method="post">
        <table>
            <tr>
                <td class="label_class"><label>Mentoring:</label></td>
                <td class="check_class"><input type="checkbox" class="option_check" id = "assist_mentor"></td>
                <td class="ta_class"><textarea class="text_areas" id ="mentor_area" name = "assist_mentor_area" rows="5" cols="10" >How can you help as a mentor?</textarea></td>

                <script type="text/javascript">
                    $('#assist_mentor').change(function (event)
                    {
                        if($(this).is(':checked'))
                        {
                            $('#mentor_area').slideDown();
                        }
                        else
                        {
                            $('#mentor_area').slideUp();
                        }
                    });
                </script>

            </tr>

            <tr>
                <td><label>Instruction:</label></td>
                <td><input type="checkbox" class="option_check" id = "assist_ins"></td>
                <td class="ta_class"><textarea class="text_areas" id ="ins_area" name = "assist_instruct_area" rows="5" cols="10">What kind of instruction can you provide?</textarea></td>

                <script type="text/javascript">
                    $('#assist_ins').change(function (event)
                    {
                        if($(this).is(':checked'))
                        {
                            $(this).parent().parent().find("ta_class").show();
                            $('#ins_area').slideDown();
                        }
                        else
                        {
                            $('#ins_area').slideUp();
                        }
                    });
                </script>

            </tr>

            <tr>
                <td><label>Job:</label></td>
                <td><input type="checkbox" class="option_check" id = "assist_job"></td>
                <td class="ta_class"><textarea class="text_areas" id ="job_area" name ="assist_job_area" rows="5" cols="10" >What kind of jobs can you provide?</textarea></td>

                <script type="text/javascript">
                    $('#assist_job').change(function (event)
                    {
                        if($(this).is(':checked'))
                        {
                            $('#job_area').slideDown();
                        }
                        else
                        {
                            $('#job_area').slideUp();
                        }
                    });
                </script>
            </tr>

            <tr>
                <td><label>Providing a property to rent:&nbsp;</label></td>
                <td><input type="checkbox" class="option_check" name="a_p" value="Yes"></td>

            </tr>

            <tr>
                <td><label>Starting a buisness</label></td>
                <td><input type="checkbox" class="option_check" id = "assist_bus"></td>
            </tr>
            <tr id ="business_seek">
                <td>
                    <form><span><label>Providing Advice:</label><input type="checkbox"></span><br><span><label>Providing Capital:</label><input type="checkbox"></span></form>
                </td>

                <script type="text/javascript">
                    $('#assist_bus').change(function (event)
                    {
                        if($(this).is(':checked'))
                        {
                            $('#business_seek').show();
                        }
                        else
                        {
                            $('#business_seek').hide();
                        }
                    });
                </script>

            </tr>

        </table>
        <br>
        <input type="submit" value="Save Settings" id = "save_assist">
        <script type = "text/javascript">

        </script>
        <br>
    </form>
</div>
<div class="creation_form_div">
    <div class="login_form_div_2">
        <br>
        <br>
        <form id ="seek_form" action="../bbl_framework/library/process_seeking_settings.php" method="post">
            <table style="margin-right: auto">
                <tr>
                    <td class="label_class"><label>Mentoring:</label></td>
                    <td class="check_class"><input type="checkbox" class="option_check" id = "seek_mentor"></td>
                    <td class="ta_class"><textarea class="text_areas"  name = "assist_mentor_area" id ="seek_mentor_area" rows="5" cols="10" >How could a mentor help you?</textarea></td>

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
                    <td class="ta_class"><textarea class="text_areas" id ="seek_ins_area" name = "assist_instruct_area" rows="5" cols="10">What kind of instruction are you seeking?</textarea></td>

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
                    <td class="ta_class"><textarea class="text_areas" id ="seek_job_area" name ="assist_job_area" rows="5" cols="10" >What kind of job are you seeking?</textarea></td>

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
                    <td><label>Starting a buisness</label></td>
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
            <br>
            <input type="submit" value="Save Settings" id="login_btn">
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