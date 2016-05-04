<!DOCTYPE HTML>
<html>
<head>
    <title>Welcome to Bubbl</title>
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
<body style="background-image: url('/css/images/bg1.png');">
<section>

    <!-- now we can add profile elements -->
    <div id = "body_header" align = "center">
        <div>
            <h3>Account Creation successful, you can now login:</h3>
            <?php include('inst_login_form.html'); ?>
        </div>
    </div>