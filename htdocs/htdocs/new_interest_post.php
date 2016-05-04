<?php session_start();?>
<!--
	Prologue 1.1 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
$id ="" ;

$id='';
if (isset($_SESSION['id_num']))
{
    $id = $_SESSION['id_num'];
}
?>

<?php

$first_name;
$last_name;

$author  = '';

$poster = $_POST['p'];

$tags = $_POST['tags'];
//$post_text = $_POST['p'];

//echo("TAGS : ". $tags);
//echo("<br> POST TEXT:".$poster);

getAuthor();

$author  = $first_name." ".$last_name;
//echo("<hr><br>AUTHOR : ".$author);

$fileUpload  = new fileUploder();
$path = $fileUpload->uploadFile();


$new_post_query = "INSERT INTO interest_posts VALUES ('NULL','".$author."','".$poster."','".$path."');";
$rex = runQueryWithRes($new_post_query);

if(!$rex)
{
    //echo "Error with MYSQL query".$rex.mysql_error();
}
else
{
//echo("Query successful, check DB");
}

$array_of_tags = explode(',', $tags);

$rowid = fetchRowId();

for($x=0; $x<sizeof($array_of_tags); $x++)
{
    runQueryWithRes("INSERT INTO interest_tags VALUES('".$rowid."', '".$array_of_tags[$x]."');");
}
/// done with this page ///

echo "<script>window.location = '/interest_feed.php'</script>";
//header('Location: http://localhost:8888/my_posts.php');


class fileUploder
{
    function uploadFile()
    {


        $target = "js_img_test/";
        $target = $target . basename( $_FILES['file_input']['name']);
        $pic=($_FILES['file_input']['name']);
        //Writes the photo to the server
        if(move_uploaded_file($_FILES['file_input']['tmp_name'], $target))
        {
            //echo "<h1> FILE UPLOAD SUCCESSFUL <h1> ";
        }
        else
        {
            ////echo "<h1> FUCK! </h1>";
        }

        return $target;
    }
}

function runQueryWithRes($query)
{

    $host = "localhost";
    $user = "root";
    $pass = "root";
    $db = "social";
    $sql = $query;
    //echo "QUERY  : " . $sql;
    $cxn = mysqli_connect($host , $user , $pass , $db);
    $res = mysqli_query($cxn , $sql);

    // $res_2 = mysql_result($res)
    if (!$res)
    {
        // printf("Error: %s\n", mysqli_error($cxn));
        exit();
    }
    return $res;

}

function getAuthor()
{

    global $first_name, $last_name;

    $id='';
    $local_first_name='';
    $local_last_name='';

    //Read your session (if it is set)
    if (isset($_SESSION['id_num']))
    {
        $id = $_SESSION['id_num'];
    }

    $path = $_SERVER['DOCUMENT_ROOT'];
    include($path.'/bbl_framework/util/QueryRunner.php');

    $x = new QueryRunner();
    $res = $x->runQueryWithRes("SELECT * FROM users WHERE id = '".$id."';");

    while($row = mysqli_fetch_array($res)) // fetch results as array and print data
    {
        // get the user's first and last name;
        $local_first_name = $row['first_name'];
        $local_last_name = $row['last_name'];
    }

    //echo("FIRST NAME:".$first_name);
    //echo("LAST NAME:".$last_name);

    $first_name = $local_first_name;
    $last_name = $local_last_name;


}
function fetchRowId()
{
    global $author,$poster;

    $row_num;


    $path = $_SERVER['DOCUMENT_ROOT'];
    //include($path.'/bbl_framework/util/QueryRunner.php');

    $x = new QueryRunner();

    $res = $x->runQueryWithRes("SELECT id  FROM interest_posts WHERE author = '".$author."' and post_text = '".$poster."';");

    while($row = mysqli_fetch_array($res)) // fetch results as array and print data
    {
        // get the user's first and last name;
        $row_num = $row['id'];
    }

    return $row_num;
}

?>
