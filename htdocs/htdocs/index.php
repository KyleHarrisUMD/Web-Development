
<!DOCTYPE HTML>
<!--
	Minimaxing 3.1 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>Bubbl by BestBrightLight</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-panels.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <noscript>
        <link rel="stylesheet" href="css/skel-noscript.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-desktop.css" />
        <link rel="stylesheet" href="css/style-mobile.css"/>
    </noscript>
    <!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
</head>
<body>

<!-- ********************************************************* -->
<div id="header-wrapper">
    <div class="container">
        <div class="row">
            <div class="12u">

                <header id="header">
                    <h1><a href="#" id="logo">Bubbl</a></h1>
                    <nav id="nav">
                        <a href="index.html" class="current-page-item">Join</a>
                        <a target="_parent" href="about.html">About Us</a>
                        <a href="members.html">Members</a>
                        <a href="features.html">Features</a>
                        <a href="contact.html">Contact</a>
                    </nav>
                </header>

            </div>
        </div>
    </div>
</div>
<div id="banner-wrapper">
    <div class="container">
        <div class="row">
            <div class="12u">
                <div id="banner">
                    <h2><strong>Bubbl,</strong><br> the authentic social utility.</h2>
                </div>
            </div>
        </div>
    </div>
</div>



<div id="forms_div_main">

 <div class = "login_form_div" id = "login_form">
     <br>
    <center><h1 class="forms_div_h1">Dont have an account? - Create one!</h1></center>
     <br>
     <form class="formclass" action="../bbl_framework/library/process_acct_create.php" method="post">
         <label>  First Name </label><br> <br> <input type="text" id = "first_name" name="first_name">
         <br>
         <br>
         <label> Last Name: </label> <br> <br><input type="text" id = "last_name" name="last_name">
         <br>
         <br>
         <label> Email Address : </label><br> <br> <input type="email" id = "email" name="email">
         <br>
         <br>
         <label> Password:  </label><br> <br><input type="password" id = "password" name="password">
         <br>
         <br>
         <label> Confirm Password: </label> <br> <br><input type="password" id = "confirm_password" name="confirm_password">
         <br>
         <br>
         <input type="submit" value="Create Account!" id = "login_btn" class="button">
         <br>
         <br>
     </form>
 </div>

 <div class="creation_form_div">
     <br>
     <center><h1 class="forms_div_h1">Have an Account? - Login!</h1></center>
     <br>
     <form class="formclass" action="../bbl_framework/library/process_login.php" method="post">
         <label> E Mail Address: </label><br> <br> <input type="text" id = "email" name="email">
         <br>
         <br>
         <label> Password: </label><br> <br><input type="password" id = "password" name="password">
         <br>
         <br>
         <input type="submit" value="Log In!" id = "login_btn" class="button">
         <br>
         <br>
     </form>

     <hr>

     <h2>Company / Group Login </h2>
     <?php include('inst_login_form.html'); ?>
 </div>
</div>


<!-- ********************************************************* -->
        <div class="row">
            <br>
            <br>
            <br>
            <div class="12u">
                <p>Company or a Group? - Click <a href="corp_create.php">Here</a> to create a profile</p>

                <div id="copyright">
                    &copy; BestBrightLight. All rights reserved.
                </div>
            </div>
        </div>
</div>
</body>
</html>