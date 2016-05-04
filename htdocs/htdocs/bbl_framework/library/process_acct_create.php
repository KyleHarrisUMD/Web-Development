<?php

$path = $_SERVER['DOCUMENT_ROOT'];

include $path.'/bbl_framework/util/QueryRunner.php';
include $path.'/bbl_framework/util/UserCreator.php';
include $path.'/bbl_framework/encry/encryption.php';
$pass_encryptor = new encryptor();


$fn = $_POST['first_name'];
$ln = $_POST['last_name'];
$em = $_POST['email'];
$pw = $_POST['password'];

$en_pw = $pass_encryptor->encrypt($pw);

$Q_R = new QueryRunner();
$sql = "INSERT INTO users VALUES('NULL','".$fn."','".$ln."','".$em."','".$en_pw."');";
$res = $Q_R->runQueryWithRes($sql);

if(!$res)
{
    echo mysql_error($res);
}
else
{
    //echo "Acct creation successful";
    include($path.'/welcome.php');
}


?>
