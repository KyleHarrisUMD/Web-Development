<?php


$arr_1 =array();
$arr_2 =array();
$zi = '';

 class Geolocationhelper
 {


     function getArrayOfZips($provided_zip, $radius)
     {
       $target_zip_array = $this->readFile($this->downloadCSV($provided_zip,$radius));
       return $target_zip_array;
     }

function downloadCSV($user_z, $_r)
{

    $url  = 'https://zipcodedistanceapi.redline13.com/rest/m61CrHmKLXipPrbCCbBg8D55SErk9w6vD785OvPAt8ZizbUbnwsv9yB2c2mlztRd/radius.csv/'.$user_z.'/'.$_r.'/mile';

    $root = $_SERVER['DOCUMENT_ROOT'];

    $path = $root.'/playground/newFile.csv';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($ch);

    curl_close($ch);

    file_put_contents($path, $data);


    return $path;

}
// end of first function //

function readFile($spec_path)
{


    global $arr_1,$arr_2,$zi;
    $row = 1;
    $zi = array();
    if (($handle = fopen($spec_path, "r")) !== FALSE)
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



    return $final_keep_zips;

}
}
?>
