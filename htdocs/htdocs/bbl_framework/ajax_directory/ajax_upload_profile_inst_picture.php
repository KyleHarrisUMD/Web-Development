<?php session_start(); ?>
<?php
$id='';
if (isset($_SESSION['id_num']))
{
    $id = $_SESSION['id_num'];
}
else
{
    echo "Please log in to use Bubbl -  Thank you.";
}
?>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include ($path.'/bbl_framework/util/QueryRunner.php');
include ($path.'/bbl_framework/util/UserCreator.php');
?>
<?php

////////////////////////////////////////////////////////////////////////

$target = $path."user_images/";
$target = $target.basename($_FILES['file']['name']);
//This gets all the other information from the form
$pic=($_FILES['file']['name']);


$fileUpload  = new fileUploder();
$img_path = $fileUpload->uploadFile();


$name = $_FILES["file"]["name"] ;
$qr = new QueryRunner();
$qr->runQueryWithRes("DELETE  FROM profile_picutres WHERE id = 'inst_".$id."';");

//echo "INSERT INTO profile_pictures VALUES ('".$id."', '".$name."')";
$inst_id = "inst_".$id;
$qr ->runQueryWithRes("INSERT INTO profile_picutres VALUES ('".$inst_id."', '".$name."');");
if(!$qr)
{
    // echo "<h1> Error".mysql_error($qr)."</h1>";
}

if($qr)
{
    header("Location: /inst_edit.php");
}
class fileUploder
{
    function uploadFile()
    {

        $path = $_SERVER['DOCUMENT_ROOT'];

        $target = $path."/user_images/";
        $target = $target . basename( $_FILES['file']['name']);
        $pic=($_FILES['file']['name']);
        //Writes the photo to the server
        if(move_uploaded_file($_FILES['file']['tmp_name'], $target))
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
?>

