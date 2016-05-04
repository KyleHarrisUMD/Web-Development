<?php

$path = $_SERVER['DOCUMENT_ROOT'];

include $path.'/bbl_framework/util/QueryRunner.php';
include $path.'/bbl_framework/util/UserCreator.php';
include $path.'/bbl_framework/encry/encryption.php';
$pass_encryptor = new encryptor();


$n = $_POST['name'];
$a = $_POST['about'];
$s = $_POST['services'];
$ad = $_POST['address'];
$e = $_POST['email'];
$p = $_POST['password'];

$en_pw = $pass_encryptor->encrypt($p);

$Q_R = new QueryRunner();
$sql = "INSERT INTO inst_users VALUES('NULL','".$n."','".$a."','".$s."' ,'".$ad."' ,'".$e."' , '".$en_pw."');";
echo $sql;
$res = $Q_R->runQueryWithRes($sql);

if(!$res)
{
    echo mysql_error($res);
}
else
{
    //echo "Acct creation successful";
    include($path.'/welcome_inst.php');
}


?>
