<?php session_start(); ?>

<?php

$id= '';
//Read your session (if it is set)
if (isset($_SESSION['id_num']))
{
    $id = $_SESSION['id_num'];
}

if(isset($_SESSION['inst_id_num']))
{
    $id = $_SESSION['inst_id_num'];
}
?>
<?php
// if possible, I want to make this script functional via ajax. I will try, but it will require some trickey.
//This is the directory where images will be saved
$path = $_SERVER['DOCUMENT_ROOT'];


$target = $path."/user_images/";
$target = $target . basename( $_FILES['photo']['name']);

//This gets all the other information from the form
$pic=($_FILES['photo']['name']);
// Connects to your Database
mysql_connect("localhost", "root", "root") or die(mysql_error()) ;
mysql_select_db("social") or die(mysql_error()) ;

//Writes the information to the database
$res = mysql_query("INSERT INTO images VALUES ('".$id."', '".$pic."');");
//Writes the photo to the server
if(move_uploaded_file($_FILES['photo']['tmp_name'], $target))
{
//Tells you if its all ok
    echo "The file has been uploaded";
    echo "<script>window.location = '/upload_images.php'</script>";
}
else
{
//Gives and error if its not
    echo "Sorry, there was a problem uploading your file.";
}
?>