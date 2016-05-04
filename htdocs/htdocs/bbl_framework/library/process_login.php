<?php session_start(); ?>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include($path."/bbl_framework/util/QueryRunner.php");
include($path."/bbl_framework/util/UserCreator.php");
include($path."/bbl_framework/encry/encryption.php");


$user_creator = new UserCreator();
$query_runner = new QueryRunner();
$password_encryption = new encryptor();


$email = $_POST['email'];
$password = $_POST['password'];
$enc_pass = $password_encryption->encrypt($password);


$sql_2 = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$enc_pass."';";

$login_res = $query_runner->runQueryWithRes($sql_2);

$id = '';
while($row = mysqli_fetch_array($login_res))
{
   $id = $row['id'];
   $_SESSION['id_num'] = $id;
}



if($id == null)
{
    //"NAHHHHH";
    echo "Email and Password combination is incorrect. <br>";
    echo "Please try again : <br>";
    include($path.'/login_form.html');
}else
{
    $cu ='';
    $cu = $user_creator->createNewUser($id);
    //$cu->toString();
    header( 'Location: http:/profile.php');
}
?>


