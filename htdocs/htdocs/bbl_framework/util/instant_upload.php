<?php session_start(); ?>
<?php
$id = '';
if(isset($_SESSION['id_num']))
{
    $id = $_SESSION['id_num'];
}
?>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/bbl_framework/util/QueryRunner.php");
include($path."/bbl_framework/util/UserCreator.php");


$user = new UserCreator();
$current_user = $user->createNewUser($id);
$first_name = $current_user->getFirstName();
$last_name  = $current_user->getLastName();

$name = $first_name." ".$last_name;


$desc = $_POST['proud_textarea'];
$file_type = $_POST['file_type'];
$tag = $_POST['tag'];

$fileUpload  = new fileUploder();
$path = $fileUpload->uploadFile();


$file = $_FILES["file_input"]["name"] ;
$qr = new QueryRunner();
$qr ->runQueryWithRes("INSERT INTO instant_posts VALUES ('".$id."', '".$name."' , '".$desc."', '".$file."', '".$file_type."', '".$tag."' , 'NULL');");

if($qr)
{
    header("Location: /interest_feed.php");
}
class fileUploder
{
    function uploadFile()
    {

        $path = $_SERVER['DOCUMENT_ROOT'];

        $target = $path."/js_img_test/";
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
?>
<?

////////////////////////// OLD INSTANT ///////////////////////////////////





?>