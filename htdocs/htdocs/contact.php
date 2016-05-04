<?php session_start();?>
<?php
// generally, I try not to write spagetti code, but I have about 8 hours left on this project //

$id='';
if (isset($_SESSION['id_num']))
{
    $id = $_SESSION['id_num'];
}

$path = $_SERVER['DOCUMENT_ROOT'];
include ($path.'/bbl_framework/util/QueryRunner.php');
include ($path.'/bbl_framework/util/UserCreator.php');

$q_r = new QueryRunner();
$u_c = new UserCreator();


$res = $q_r->runQueryWithRes("SELECT * FROM friends WHERE id_1 = '".$id."' AND status = 'PENDING' ; ");

$request_list = array();



$current_user = $u_c->createNewUser($id);


while($row = mysqli_fetch_array($res))
{
    $temp_user = $u_c->createNewUser($row['id_2']);
    array_push($request_list, $temp_user);
}

//  // code to get current friends list //

$friends_list = array();

// People who requested the current user will be found, however a new query needs to be ran to fetch the counterpart .. //
$res_2 = $q_r->runQueryWithRes("SELECT * FROM friends WHERE id_1 = '".$current_user->getId()."' AND status = 'FRIENDS'; ");
while($row = mysqli_fetch_array($res_2))
{
    $temp_user = $u_c->createNewUser($row['id_2']);
    array_push($friends_list, $temp_user);
}

// this gets people who the user requested //

$res_3 = $q_r->runQueryWithRes("SELECT * FROM friends WHERE id_2 = '".$current_user->getId()."' AND status = 'FRIENDS';");
while($row = mysqli_fetch_array($res_3))
{
    $temp_user = $u_c->createNewUser($row['id_1']);
    array_push($friends_list, $temp_user);
}

?>
<?php
 class f_m
          {
              private $sender;
              private $reciver;
              private $text;
              private $time_stamp;
              private $offset;

              public function f_m($s,$r,$t,$t_s,$o)
              {
                  $this->sender = $s;
                  $this->reciver = $r;
                  $this->text = $t;
                  $this->time_stamp = $t_s;
                  $this->offset = $o;
              }

              public function getSender()
              {
                  return $this->sender;
              }
              public function getReciver()
              {
                  return $this->reciver;
              }
              public function getMsg()
              {
                  return $this->text;
              }
              public function getTimeStamp()
              {
                  $td = array();
                  $data = $this->time_stamp;
                  $td = explode('-', $data);

                  $month = $td[1];
                  $time = explode(":", $td[2]);
                  //var_dump($time);

                  $day = $time[0];
                  $min = ($time[1]);
                  $sec = $time[2];

                  $day_hr_arr = explode(" ", $day);

                  $day = $day_hr_arr[0];
                  $hour = $day_hr_arr[1];

                  if($hour>=13)
                  {
                      $hour = ($hour-12);
                      $min = $min." PM";
                  }
                  else
                  {
                      $hour = ($hour);
                      $min = $min." AM";
                  }
                  $format_time = $month."/".$day." ".($hour).":".$min;


                  return $format_time;



              }

              public function calcOffset()
              {
                  return $this->offset;
              }
          }


          $formal_messages_array = array();


          $sssssss = "SELECT * FROM formal_messages WHERE id_to = '".$id."' ;";

          $resssss = $q_r->runQueryWithRes($sssssss);

          while($r = mysqli_fetch_array($resssss))
          {
              $temp = new f_m($r['id_from'],$r['id_to'], $r['text'],$r['time_stamp'],$r['offset']);
              array_push($formal_messages_array , $temp);
          }



?>
<!DOCTYPE html>
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/new_nav_style.css"/>
    <link rel = "stylesheet" href="css/style-mobile.css">
    <link rel="stylesheet" type="text/css" src = "css/messages_style.css">

    <noscript>

    </noscript>
    <!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
</head>
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
                        <td  class="nav_section" style="font-size:150%"><a href="view_profile.php">About Me </a></td>
                        <td  class="nav_section" style="font-size:150%"><a href="view_photos.php">Photos </a></td>
                        <td  class="nav_section" style="font-size:150%"><a href="view_posts.php">Posts </a></td>
                        <td  class="nav_section" style="font-size:150%"><a href="view_friends.php">Friends </a></td>
                        <td  class="nav_section" style="font-size:150%"><a href="contact_user.php">Contact</a></td>
                    </tr>
                </table>
            </div>
        </header>
    </center>

    <section>
        <!-- now we can add profile elements --><!-- Essentially, what we want is two sections. A user section and a messages section.. -->
<!-- Users will be freinds and messages will be messages corresponding between each other -->

<!-- First make capablity to add friends -->
<div id ="body_header">
<br>
<br>
<br>

<form>
    <input type="hidden" id = "current_user" value="<?php echo $current_user->getId();?>">
</form>
<div align="left" style="width : 20%;">
    <?php if(sizeof($request_list)>0)
    {?>
        <h3> Friend Requests <?php echo ("(".sizeof($request_list).")");?></h3>
        <table id = "request_table">
            <?php for($req=0; $req<sizeof($request_list); $req++)
            {
                ?> <tr><td><?php echo $request_list[$req]->getFirstName()." ".$request_list[$req]->getLastName();?></td><td><button value="<?php echo $request_list[$req]->getId();?>" type="button" class ="accept_friend">Accept</button></td> <td><button class = "reject_friend" type="button" value="<?php echo $request_list[$req]->getId();?>">Reject</button></td></tr></form>
            <?php } ?>
        </table> <?php } ?>
    <script type="text/javascript">
        $('.accept_friend').click(function()
        {
            var id_1 = $('#current_user').val();
            var id_2 = $(this).val();
            console.log("Current user : (" +id_1+") is accepting : ("+id_2+") to be friends");
            $.ajax
            ({
                url: 'friend_handle.php',
                type: 'POST',
                data: {'current_user':id_1,'request_user':id_2,'acceptance':'true'}, // An object with the key 'submit' and value 'true;
                success: function (data)
                {
                    alert("Friend Added.");
                    window.location.reload();
                }
            });
        });

        $('.reject_friend').click(function()
        {
            var id_1 = $('#current_user').val();
            var id_2 = $(this).val();
            console.log("Current user : (" +id_1+") is rejecting : ("+id_2+")'s friend request");
            var data = $(this).serializeArray();
            console.log(data);

            $.ajax
            ({
                url: 'friend_handle.php',
                type: 'POST',
                data: {'current_user':id_1,'request_user':id_2,'acceptance':'false'}, // An object with the key 'submit' and value 'true;
                success: function(data)
                {
                    alert("Request Canceled");
                }
            });

        });
    </script>
</div>
    <br>

<div align="left" style="width:30%; border: 1px solid steelblue;">
    <h3>Friends <?php echo "(".sizeof($friends_list).")";?></h3>
    <?php for($f=0; $f<sizeof($friends_list); $f++)
    {?>
        <h6 style="color:steelblue; border:1px solid gray; width = 100%;"><button class="friend_btn" value="<?php echo $friends_list[$f]->getId();?>"><?php echo $friends_list[$f]->getFirstName()." ".$friends_list[$f]->getLastName();?> </h6> </button>
    <?php } ?>
</div>


<br>
<br>
<hr>
<hr>
<br>

<div id = "convo_div" align="center" style="height:70%">
    <div align="right">
        <button type="button" id = "refresh">Refresh</button>
    </div>
    <iframe id = "msg_frame" seamless = false  style = "border:2px solid gray;"height = "50%" width = "60%" src="messages.php?curusr=<?php echo $current_user->getId()?>&msgview="></iframe>
    <form id = "message_form" method="post">
        <input type="hidden" id = "sender" name="sender" value="<?php echo $current_user->getId();?>">
        <input type="hidden" id = "to" name = "to" value="">
        <span id = "input_span"><textarea placeholder="Type your message here!" rows="2" cols="5" id = "msg_txt" name = "msg_txt" style="width: 50%"> </textarea> <input type="submit" value="Send" id = "msg_send" align="left"> </span>
    </form>
</div>
</div>
<script type="text/javascript">
    $('.friend_btn').click(function()
    {
        var click_id = $(this).val();
        //alert(click_id);
        var cur_user = $('#current_user').val();
        var new_src = "messages.php?curusr="+cur_user+"&msgview="+click_id;
        $('#to').val(click_id);
        $('#msg_frame').attr('src',new_src);
        return false;
    });

    $('#message_form').submit(function(event)
    {
        event.preventDefault();
        //alert("Clicked");
        //return false;
        var url = "../bbl_framework/ajax_directory/proc_msg.php"; // the script where you handle the form input.
        $.ajax
        ({
            type: "POST",
            url: url,
            data: $(this).serialize(), // serializes the form's elements.
            success: function(data)
            {
                document.getElementById('msg_frame').src = document.getElementById('msg_frame').src;
                $("#convo_div").scrollTop(600);
                return false;
            }
        });

        return false; // avoid to execute the actual submit of the form.
    });


    $('#refresh').click(function()
    {
        document.getElementById('msg_frame').src = document.getElementById('msg_frame').src;
    });
</script>

        <br>
        <br>
        <br>
  <div style="border-top: 1px solid gray;">

      <h3><br><br>Formal Messages :</h3>
      <ul>
          <br>
          <?php
            $counter = '';
            foreach($formal_messages_array as $formal_message) {?>
          <?php
               $counter++;
               //// just need to run afew queries to make sence of all this data //
              $sender_id = $formal_message->getSender();
              $sender_name = '';
              try
              {
               $sender_substring = substr($sender_id , 0, 5);
               if($sender_substring == "inst_")
               {
                   $temp_id  =substr($sender_id , 5);
                   $sql_for_formal_msgs = "SELECT * FROM inst_users WHERE id = '".$temp_id."' ;";
                   $fm_res = $q_r->runQueryWithRes($sql_for_formal_msgs);
                   while($rw = mysqli_fetch_array($fm_res))
                   {
                       $sender_name = $rw['name'];
                   }

               }
              }catch(Exception $e)
              {

              }

              if($sender_name == "")
              {
                  // its a regular sender //
                  $temp_sender = $u_c->createNewUser($sender_id);
                  $sender_name = $temp_sender->getFirstName()." ".$temp_sender->getLastName();
              }

          ?>

          <li style="border-bottom: 1px solid black;">
              <div id = "form_target_div_<?php echo $counter?>">
                  <br>
                  <h4>Sender : <?php echo $sender_name; ?></h4>
                  <p> Message : <?php echo $formal_message->getMsg();?></p>
                  <form class = "reply_form" id = "reply_form_<?php echo $counter;?>">
                      <input type="hidden" id = "id_1"   value= "<?php echo $formal_message->getSender();?>" name="id_1">
                      <input type="hidden" id = "id_2"   value= "<?php echo $id ?>" name="id_2">
                      <span><button class="reply" value="<?php echo $counter; ?>">Reply</button><button id = "remove" class="remove" value="<?php echo $counter; ?>">Remove</button></span>
                  </form>
                  <form id = "message_form_<?php echo $counter?>">
                      <input type="hidden" id = "message" value="<?php echo $formal_message->calcOffset();?>" name="message">
                  </form>
                  <br>
              </div>
          </li>
          <?php } ?>
          <script type="text/javascript">
              $('.reply').click(function(event)
              {
                 event.preventDefault();
                 event.stopImmediatePropagation();
                // alert($(this).val());
                 var message = prompt("Reply to message");
                 var counter = $(this).val();
                 var target_form = $("#reply_form_"+counter);
                // return false;
                 console.log(target_form.serialize());
                 var arr = target_form.serialize();

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
                  console.log("ID 2 : "+id_2);

                  $.ajax(
                      {
                          type: 'POST',
                          url: '../bbl_framework/util/formal_message.php',
                          data: {to :id_1, from : id_2, message:message},
                          dataType: 'json',
                          success: function (data)
                          {
                              console.log(data);
                              //alert("Message sent.");
                          }
                      });

              });

              $('.remove').click(function(event)
              {
                  event.preventDefault();
                  event.stopImmediatePropagation();
                 // alert($(this).val());

                  var  counter = $(this).val();
                  var  target_form    = $("#message_form_"+counter);
                  var  message_form = $("#reply_form_"+counter);

                  var  data = target_form.serialize();

                  var  carrot = data.indexOf('=');

                  console.log("Carrot : " + carrot);
                  var message = data.substr(carrot+1);
                  console.log("Message : "+message);

                  var p = 0;
                  for(var pluses =0; pluses<message.length; pluses++)
                  {
                    if(message.charAt(pluses) == '+')
                    {
                        p++;
                    }

                  }

                  for(var x=0; x<p; x++)
                  {
                     message = message.replace('+', ' ');
                  }


                  var arr = message_form.serialize();
                  var arr_to_string = arr.toString();

                  console.log('Array to string : '+arr_to_string);

                  var ct ;
                  for(var i =0 ; i<arr_to_string.length; i++)
                  {
                      console.log("Loop Count :"+i);
                      console.log(arr_to_string.charAt(i));
                      if(arr_to_string.charAt(i) == '&')
                      {
                          console.log(arr_to_string.charAt(i));
                          ct = i;
                      }
                  }

                  var ct  = arr_to_string.indexOf('&');
                  console.log("Carrot : " +ct);
                  id_1 = arr_to_string.substr(0 , ct);
                  //console.log("ID 1 : "+id_1);
                  id_1 = id_1.substr(5);
                  console.log("ID 1 : "+id_1);

                  id_2 = arr_to_string.substr((ct+1));
                  id_2 = id_2.substr(5);
                  console.log("ID 2 : "+id_2);

                  var target_div = $('#form_target_div_'+counter);

                  $.ajax(
                      {
                          type: 'POST',
                          url: '../bbl_framework/library/remove_message.php',
                          data: {to :id_1, from : id_2, message:message},
                          dataType: 'json',
                          success: function (data)
                          {
                              console.log(data);
                              message_form.slideUp();
                              target_form.slideUp();
                              target_div.slideUp();
                          }
                      });

              });
          </script>

      </ul>
  </div>

<style type="text/css">
    #request_table
    {
        background:rgba(148,169,204,0.92);
        color: white;
    }
    .friend_btn
    {
        font-size: 120%;
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

</html>