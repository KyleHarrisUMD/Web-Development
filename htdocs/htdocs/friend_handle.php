<?php 

   $path = $_SERVER['DOCUMENT_ROOT'];
   require_once $path.'/bbl_framework/util/QueryRunner.php';
   $x = new QueryRunner();
   $acceptance = $_POST['acceptance'];
   $current_user = $_POST['current_user'];
   $request_user = $_POST['request_user'];
   
   $res = '';
   if($acceptance == 'true')
   {
	$res =  $x->runQueryWithRes("UPDATE friends SET status = 'FRIENDS' WHERE id_1 = '".$current_user."' AND id_2 = '".$request_user."' ;");
	 if(!mysql_error())
	 {
		return json_encode("success");
	 }  
   }
   
   
   if($acceptance == 'false')
   {
     $res =  $x->runQueryWithRes("DELETE FROM friends WHERE id_1 = '".$current_user."' AND id_2 = '".$request_user."' AND status = 'PENDING';");
	 if(!mysql_error())
	 {
	    return json_encode("success");
	 } 
  }
?>