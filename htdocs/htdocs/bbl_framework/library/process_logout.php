<?php
session_start();
unset($_SESSION["inst_id_num"]);
unset($_SESSION["id_num"]);
echo json_encode("success");
?>