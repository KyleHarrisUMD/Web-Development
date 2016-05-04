<?php session_start(); ?>
<?php
 $id = '';
  if(isset($_SESSION['id_num']))
  {
      $id = $_SESSION['id_num'];
  }


if(isset($_SESSION['inst_id_num']))
{
    $id = $_SESSION['inst_id_num'];
}


?>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/bbl_framework/util/QueryRunner.php");
include($path."/bbl_framework/util/UserCreator.php");


$proud_text = $_POST['proud_textarea'];
$file_type = $_POST['file_type'];

$fileUpload  = new fileUploder();
$path = $fileUpload->uploadFile();


$name = $_FILES["file_input"]["name"] ;
$qr = new QueryRunner();
$qr ->runQueryWithRes("INSERT INTO posts VALUES ('".$id."', '".$name."' , '".$proud_text."','0' , '".$file_type."');");

if($qr)
{
  if(isset($_SESSION['id_num']))
  {
      header("Location: /posts.php");
   }

    if(isset($_SESSION['inst_id_num']))
    {
        header("Location: /inst_posts.php");
    }
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
