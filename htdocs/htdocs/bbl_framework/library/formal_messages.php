<?php
class formal_message
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



