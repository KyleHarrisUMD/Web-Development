<?php
  $path = $_SERVER['DOCUMENT_ROOT'];
  include($path.'/bbl_framework/util/UserCreator.php');
  include($path.'/bbl_framework/util/QueryRunner.php');

  $u_c = new UserCreator();

?>
<?php
class message
{
    private $sender;
    private $reciver;
    private $text;
    private $time_stamp;
    private $offset;

    public function message($s,$r,$t,$t_s,$o)
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
?>

<?php

function insertSort($arr)
{
    $offset_num = '';
    $element = '';
    $j='';

    for($x=0; $x<sizeof($arr); $x++)
    {
        $element=$arr[$x];
        $j=$x;
        while($j>0 && ($arr[$j-1]->calcOffset()>$element->calcOffset()))
        {
            //move value to right and key to previous smaller index
            $arr[$j]=$arr[$j-1];
            $j=$j-1;
        }
        //put the element at index $j
        $arr[$j]=$element;
    }
    // var_dump($arr);
    return $arr;
}


//echo($_GET['curusr']);
$cur_user = $u_c->createNewUser($_GET['curusr']);
$msg_user = $u_c->createNewUser($_GET['msgview']);
//echo("Viewing messages between ".$cur_user->getFirstName()." and ".$msg_user->getFirstName().": <br>");

$messages_array =  array();

$x = new QueryRunner();
$res = $x->runQueryWithRes("SELECT * FROM messages WHERE id_from = '".$cur_user->getId()."' and id_to = '".$msg_user->getId()."' ;");

while($row = mysqli_fetch_array($res))
{
    $temp_msg = new message($row['id_from'],$row['id_to'],$row['text'],$row['time_stamp'],$row['offset']);
    array_push($messages_array, $temp_msg);
}

$res_2 = $x->runQueryWithRes("SELECT * FROM messages WHERE id_to = '".$cur_user->getId()."' and id_from = '".$msg_user->getId()."' ; ");

while($row = mysqli_fetch_array($res_2))
{
    $temp_msg = new message($row['id_from'],$row['id_to'],$row['text'],$row['time_stamp'],$row['offset']);
    array_push($messages_array, $temp_msg);
}

$messages_array = insertSort($messages_array);


?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href = "css/messages_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('body').scrollTop($(document).height());

        });
    </script>
</head>
<body>
<div id = "message_div" style="height:60%">
   <?php if($cur_user && $msg_user) {?>
    <?php for($s=0; $s<sizeof($messages_array); $s++)
    {?>
        <?php if($messages_array[$s]->getSender()==$cur_user->getId())
    {?>
        <div class="indiv_msg_sent" align="right">
            <p align="center">You: <?php echo($messages_array[$s]->getMsg()); echo("</br>"); echo ($messages_array[$s]->getTimeStamp());?></p>
        </div>
    <?php } else { ?>
        <div class="indiv_msg_reciv" align="left">
            <p align="center"> <?php echo ($msg_user->getFirstName()." :"); echo($messages_array[$s]->getMsg()); echo("</br>"); echo ($messages_array[$s]->getTimeStamp());?></p>
        </div>
    <?php } }}else{echo "Please select a user to view your chat.";}?>
</div>
<div id = "#idk">
    <form>
        <input type="hidden">
    </form>
</div>

</body>
</html>