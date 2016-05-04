<?php session_start(); ?>

<?php
class ajaxVal
{
    function formValidate() 
    {
    
    $id='';

    if (isset($_SESSION['id_num']))
    {
     $id = $_SESSION['id_num'];
    }
    
    $return = array(``); // return array ///

////////////////////////////////////////////////////////////////////////
$target = "user_images/";
$target = $target.basename($_FILES['photo']['name']);
//This gets all the other information from the form
$pic=($_FILES['photo']['name']);
// Connects to your Database
$link = mysql_connect("localhost", "root", "root") or die(mysql_error()) ;
$db = mysql_select_db("social") or die(mysql_error()) ;
//Writes the information to the database
$res = mysql_query("INSERT INTO images VALUES ('".$id."', '".$pic."');");
//Writes the photo to the server
$return['msg'] = "Success";

/////////////////////////////////////////////////////////////////////////

//$return['msg']= "Success";
    
    //Return json encoded results SO US CARBON UNITS CAN READ IT!!!
    return json_encode($return);
    }

}

$ajaxValidate = new ajaxVal;
echo $ajaxValidate->formValidate();

?>
