<?php
 class globals
 {
     static $one;
     static $two;
     static $three;
 }
?>
<?php $path = $_SERVER['DOCUMENT_ROOT']; ?>
<?php include ($path."/bbl_framework/util/UserCreator.php"); ?>
<?php
////////////////////////////////////
include ($path."/bbl_framework/util/QueryRunner.php");
$u_c = new UserCreator();
$executor = new QueryRunner();

$user_array = array();

$seek_or_provide = '';
$critera = '';

$user_zip='';
$rad = '';

if($_GET['cur_zip']=='undefined')
{
    echo '<script type = "text/javascript"> alert("Waiting for location..."); </script>';
}
else
{
    $user_zip = $_GET['cur_zip'];
}

if($_GET['rad']=='undefined')
{
    echo '<script type = "text/javascript"> alert("Waiting Please enter a raduis"); </script>';
}
else
{
    $rad = $_GET['rad'];
}


$keepa_numba_2 = array();

/// member type //

$member_type = $_GET['memtype'];
//echo "MEMBER TYPE :".$member_type;
?>
<?php
$arr_1 =array();
$arr_2 =array();

class fetchZips
{


    function downloadCSV($user_z, $_r)
    {

        $url  = 'https://zipcodedistanceapi.redline13.com/rest/m61CrHmKLXipPrbCCbBg8D55SErk9w6vD785OvPAt8ZizbUbnwsv9yB2c2mlztRd/radius.csv/'.$user_z.'/'.$_r.'/mile';

        $path = 'playground/newFile.csv';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($ch);

        curl_close($ch);

        file_put_contents($path, $data);
    }
    // end of first function //

    function readFile()
    {
        global $arr_1,$arr_2,$zi;
        $row = 1;
        $zi = array();
        if (($handle = fopen("playground/newFile.csv", "r")) !== FALSE)
        {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
            {
                $num = count($data);
                // echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                for ($c=0; $c < $num; $c++)
                {
                    array_push($zi, $data[$c]);
                }
            }
        }
        fclose($handle);

        /// split into two //
        $zi_copy = $zi;
        $zi_copy_rev = array_reverse($zi_copy);
        $zi_first_trim = array();

        $keep_zips = array();

        $final_keep_zips = array();

        for($y=0; $y<sizeof($zi_copy); $y++)
        {
            if($y<4)
            {
                array_pop($zi_copy_rev);
            }
        }
        $zi_copy = array_reverse($zi_copy_rev);

        for($y=0; $y<sizeof($zi_copy); $y++)
        {
            if($y % 2 == 0)
            {
                //echo($zi_copy[$y]);
                array_push($keep_zips, $zi_copy[$y]);
            }
        }


        for($b=0; $b<sizeof($keep_zips); $b+=2)
        {
            // echo($keep_zips[$b]);
            // echo("<br>");
            array_push($final_keep_zips, $keep_zips[$b]);
        }

        for($y=0; $y<sizeof($zi); $y++)
        {
            if($y>1)
            {
                if($y % 2 == 0)
                {
                    array_push($arr_1, $zi[$y]);
                }
                else
                {
                    array_push($arr_2, $zi[$y]);
                }
            }
        }
        // Im going to make three parallel arrays to simulate a map strucutre and we can link with the index operands .. // good thinking

        $one_of_three = array();
        $two_of_three = array();
        $three_of_three = array();

        // testing code //
        for($z=0; $z<sizeof($arr_1); $z++)
        {
            //echo $arr_1[$z]." Distance :".$arr_2[$z]."<br>";
            array_push($one_of_three, $arr_1[$z]);
            array_push($three_of_three , $arr_2 [$z]);
            // echo $arr_1[$z];
        }

        $x =0;
        $one = array();
        array_shift($one_of_three);
        array_shift($one_of_three);


        for($y=sizeof($one_of_three); $y>0; $y--)
        {
            array_push($one , $one_of_three[$y]);
        }

        $keeper_numba_1 = array();
        $keeper_numba_2 = array();
        $keeper_numba_3 = array();


        foreach($one as $city)
        {
          $x++;
          if($x % 2 == 0 )
          {
              //echo $city."  ";
              array_push($keeper_numba_1, $city);

          }
          else
          {
              array_push($keeper_numba_2, $city);

          }
        }


        $my_magic_number =0 ;
        array_shift($three_of_three);
        array_shift($three_of_three);

        $three  = array();

        for($y=sizeof($three_of_three); $y>0; $y--)
        {
            array_push($three , $three_of_three[$y]);
        }

        foreach($three as $distance)
        {
            $my_magic_number ++;
            if($my_magic_number % 2 ==0 )
            {


            }
            else
            {
                array_push($keeper_numba_3, $distance);

            }
        }

         globals::$one = $keeper_numba_1;
         globals::$two = $keeper_numba_2;
         globals::$three =$keeper_numba_3;
         // echo "TESTING : ".$keeper_numba_1[10].$keeper_numba_2[10]."  ".$keeper_numba_3[10];


          //echo "<h1> VAR DUMP </h1>"; var_dump($three_of_three);


        return $final_keep_zips;


    }

}
?>
<?php
class user
{
    private $id = '';
    private $first_name = '' ;
    private $last_name= '';
    private $email= '';

    private $zp ='';

    public function user($i, $f, $l, $e)
    {
        $this->id=$i;
        $this->first_name=$f;
        $this->last_name=$l;
        $this->email =$e;
    }

    public function toString()
    {
        //echo("ID :".$this->id);
        //echo("<br>");
        //echo("First Name: ".$this->first_name);
        //echo("<br>");
        // echo("Last Name : ".$this->last_name);
        // echo("<br>");
        // echo("Email : ".$this->email);
    }

    public function getFirstAndLastName()
    {
        $concat_string = $this->first_name." ".$this->last_name;
        return $concat_string;
    }
    public function getName()
    {

        return $this->first_name;
    }
    public function getId()
    {
        return $this->id;
    }
}
?>
<?php
///// we must include the radius //
// I don't know how the fuck I did geolocation last time.. // but hopefully it's somewhere in here. //
// the code is in "geolocation_test.php"//

// TO DO - MAKE THAT AN OBJECT THAT RETURNS AN ARRAY OF DATA BASED UPON THE SPECIFIED RADIUS //
// THEN ITS GOOD IN TERMS OF GEOLOCATION AND CRITERA // .. WHICH MEANS ITS DONE.. HOWEVER, DO NOT FORGET TO MAKE A VIEW_PROFILE VIEW AND LINK THE ID..
// ALSO SET UP A MESSAGING SERVICE SO PEOPLE CAN ACTUALLY USE THE FUCKING SITE INSTEAD OF PIC CREEPING AND FAPPING .. //
// TALK ABOUT AN INNAPROPRIATE COMMENT ^^ BLAME ADDERALL //
if(!isset($_GET['crit']))
{
    // echo("Please search based on specified critera");
}
else
{
//  echo $_GET['memtype'];
    if($_GET['seek_prov']=='seeking')
    {
        $seek_or_provide = 'seeking';
    }
    else
    {
        $seek_or_provide ='providing';
    }
    $critera = ($_GET['crit']);


    $final_zzzzips = array();

    $p = new fetchZips();
    $p->downloadCSV($user_zip, $rad);
    $final_zzzzips = $p->readFile();


    for($zx=0; $zx<sizeof($final_zzzzips); $zx++)
    {
        //echo("Final keep zip : ".$final_zzzzips[$zx]);
        // echo "<br>";
    }



    if($seek_or_provide=="seeking")
    {
        // run the query to fetch seekers //
        // Select id from seeking where seek = 'critera' ..
        $seek_id_arr = array();

        $seek_res = $executor->runQueryWithRes('SELECT id FROM seeking WHERE seek LIKE "'."%".$critera."%".'"; ');

        while($row = mysqli_fetch_array($seek_res))
        {
            array_push($seek_id_arr, $row['id']);
        }

        if(sizeof($seek_id_arr)<1)
        {
            //echo("No results found based upon specified criteria");
        }
        else
        {
            for($idc = 0; $idc<sizeof($seek_id_arr); $idc++)
            {
               // echo "ID :".$seek_id_arr[$idc];
            }
        }
        if($member_type == "person")
        {
        for($u=0; $u<sizeof($seek_id_arr); $u++)
        {
            $seek_people_res = $executor->runQueryWithRes('SELECT * FROM users WHERE id = "'.$seek_id_arr[$u].'";');
            while($row = mysqli_fetch_array($seek_people_res))
            {
                $new_user = new user($row['id'] , $row['first_name'], $row['last_name'], $row['email']);
                array_push($user_array, $new_user);
            }
        }
        }else if($member_type == "inst")
        {

            for($u=0; $u<sizeof($seek_id_arr); $u++)
            {
                $temp_id = substr($seek_id_arr[$u] , '5');

                $prov_people_res = $executor->runQueryWithRes('SELECT * FROM inst_users WHERE id = "'.$temp_id.'";');
                // echo 'QUERY :'.'SELECT * FROM inst_users WHERE id = "'.$temp_id.'";';
                while($row = mysqli_fetch_array($prov_people_res))
                {
                    $new_user = new user($row['id'] , $row['name'], $row['services'], $row['about']);
                    array_push($user_array, $new_user);
                }


            }

        }
    }else if ($seek_or_provide == "providing")
    {
        // run the query to fetch seekers //
        // Select id from seeking where seek = 'critera' ..
        $prov_id_arr = array();

        $prov_res = $executor->runQueryWithRes('SELECT id FROM providing WHERE provide LIKE "'."%".$critera."%".'";');

        while($row = mysqli_fetch_array($prov_res))
        {
            array_push($prov_id_arr, $row['id']);
        }

        if(sizeof($prov_id_arr)<1)
        {
            //echo("No results found based upon specified criteria");
        }
        else
        {
            for($idc = 0; $idc<sizeof($prov_id_arr); $idc++)
            {
                //echo "ID :".$prov_id_arr[$idc];
            }
        }

        if($member_type == "person")
        {
        for($u=0; $u<sizeof($prov_id_arr); $u++)
        {
            $prov_people_res = $executor->runQueryWithRes('SELECT * FROM users WHERE id = "'.$prov_id_arr[$u].'";');
            while($row = mysqli_fetch_array($prov_people_res))
            {
                $new_user = new user($row['id'] , $row['first_name'], $row['last_name'], $row['email']);
                array_push($user_array, $new_user);
            }


        }
    }else if($member_type == "inst")
        {
            for($u=0; $u<sizeof($prov_id_arr); $u++)
            {
                $temp_id = substr($prov_id_arr[$u] , '5');

                $prov_people_res = $executor->runQueryWithRes('SELECT * FROM inst_users WHERE id = "'.$temp_id.'";');
               // echo 'QUERY :'.'SELECT * FROM inst_users WHERE id = "'.$temp_id.'";';
                while($row = mysqli_fetch_array($prov_people_res))
                {
                    $new_user = new user($row['id'] , $row['name'], $row['services'], $row['about']);
                    array_push($user_array, $new_user);
                }


            }


        }
    }
    // now that we have their id we can get their info //
    // print data collected //
    for($s=0; $s<sizeof($user_array); $s++)
    {
        $user_array[$s]->toString();
        // echo("<h1> <center> BREAK </center> </h1> ");
    }
}


$matching_zip_arr = array();
// innerclass zipexam for algo //
class zip_exam
{
    private $id;
    private $zip;

    public function zip_exam($i,$z)
    {
        $this->id = $i;
        $this->zip= $z;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getZip()
    {
        return $this->zip;
    }



}
$ids_in_question = array();
$relavant_arr = array();


for($ua=0; $ua<sizeof($user_array); $ua++)
{
  //  echo "<h1> CODE EXECUTED LINE 455</h1>";

    $cur_id = $user_array[$ua]->getId();
    if($member_type == "person")
    {
    $zip_match_res = $executor->runQueryWithRes("SELECT * FROM zips WHERE id = '".$cur_id."';");
    }else if($member_type == "inst")
    {
        $tempo_id = substr($cur_id , 5);
       // echo "<h1> ID in use".$cur_id."</h1>";
        $zip_match_res = $executor->runQueryWithRes("SELECT * FROM zips WHERE id = 'inst_".$cur_id."';");
    }
    while($row = mysqli_fetch_array($zip_match_res))
    {
        $temp_obj  = new zip_exam($row['id'],$row['zip_code']);
        array_push($relavant_arr, $temp_obj);
    }
}

/// now find where zips are equal //

$good_ids = array();

for($c=0; $c<sizeof($relavant_arr); $c++)
{
    for($confused=0; $confused<sizeof($final_zzzzips); $confused++)
    {
        if($relavant_arr[$c]->getZip() == $final_zzzzips[$confused])
        {
            array_push($good_ids, $relavant_arr[$c]->getId());
        }
    }

 //   echo "<h1> CODE EXECUTED LINE 480 </h1>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Core</title>
    <link rel="stylesheet" type="text/css" href="css/iframe_css_style.css">
</head>
<body>
<?php
if($member_type == "person")
{
$revamped_arr = array();
for($good =0; $good<sizeof($good_ids); $good++)
{
    $final_query = $executor->runQueryWithRes("SELECT * FROM users WHERE id = '".$good_ids[$good]."';");
    while($row = mysqli_fetch_array($final_query))
    {
        $new_user = new user($row['id'] , $row['first_name'], $row['last_name'], $row['email']);
        array_push($revamped_arr, $new_user);
    }
}
}else if ($member_type == "inst")
{
    $revamped_arr = array();
    for($good =0; $good<sizeof($good_ids); $good++)
    {
        $temp_id = substr($good_ids[$good], 5);
        $final_query = $executor->runQueryWithRes("SELECT * FROM inst_users WHERE id = '".$temp_id."';");
        while($row = mysqli_fetch_array($final_query))
        {
            $new_user = new user($row['id'] , $row['name'], $row['services'], $row['about']);
            array_push($revamped_arr, $new_user);
        }
    }
}
 // code to find substring //

?>
<div id = "results_div">
    <?php
    if(sizeof($revamped_arr)<1)
    {
        echo("<center> <h4 style= 'color : steelblue;'> No results found. Expand your search radius </h4> </center>");
    }
    ?>
    <?php for($s =0; $s<sizeof($revamped_arr); $s++)
    { ?>
        <?php if($member_type == "person") {?>
        <div class = "user_div">
            <!-- link this image with the view profile page -->
           <div class="inner_data">
            <p> <?php echo $revamped_arr[$s]->getFirstAndLastName();
                $cur_id = $revamped_arr[$s]->getId();
                ?>
                <br> <br>
                <?php $root = $u_c->getProfilePicture($revamped_arr[$s]->getID());?>
                <a href="viewprofile.php?tgt_usr=<?php echo $revamped_arr[$s]->getId();?>" target = "_parent"> <img class="user_pro_pic" src="/user_images/<?php echo $root ;?>" /></a>
                <h4> Zip Code : <?php $z = $u_c->getZipCode($revamped_arr[$s]->getId()); echo $z; ?> <br> Distance : <?php $index = array_search($z, globals::$two);  echo globals::$three[$index]." Miles ";?> </h4>
                <br>
            </p>
        </div>
        </div> <?php }else if ($member_type == "inst"){ ?>
            <div class = "user_div">
                <!-- link this image with the view profile page -->
                <div class="inner_data">
                    <p> <?php echo $revamped_arr[$s]->getName();
                        $cur_id = $revamped_arr[$s]->getId();
                        ?>
                        <br> <br>
                        <?php $root = $u_c->getProfilePicture('inst_'.$revamped_arr[$s]->getID());?>
                        <a href="view_inst_profile.php?tgt_usr=<?php echo $revamped_arr[$s]->getId();?>" target = "_parent"> <img class="user_pro_pic" src="/user_images/<?php echo $root ;?>" /></a>
                    <h4> Zip Code : <?php $z = $u_c->getZipCode('inst_'.$revamped_arr[$s]->getId()); echo $z; ?> <br> Distance : <?php $index = array_search($z, globals::$two);  echo globals::$three[$index]." Miles ";?> </h4>
                    <br>
                    </p>
                </div>
            </div> <?php } } ?>
</div>

<style type="text/css">
.user_div
{
   border : 5px solid white;
   border-radius:20px;
   margin-left: auto;
   margin-right: auto;
   width : 30%;
   display: inline-flex;
    flex-wrap: wrap;
   margin: 2%;

}

.inner_data
{
    width: 70%;
    padding-left: 10%;
}


.user_pro_pic
{
    width: 100%;
}


</style>
</body>
</html>