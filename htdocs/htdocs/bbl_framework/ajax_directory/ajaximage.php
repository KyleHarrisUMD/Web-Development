<?php session_start();?>
<?php
$id=''; 
if 
(isset($_SESSION['id_num']))
 {
     $id = $_SESSION['id_num'];
 }

include('db.php');
 //$session id
$path = "uploads/";

include 'dAl.php';
$host = DataAccessProtocol::host;
$user = DataAccessProtocol::user;
$db_pass = DataAccessProtocol::pass;
$dbName = DataAccessProtocol::db;

$con = mysqli_connect($host, $user, $db_pass, $dbName); // basic mysql/php cxn// 


	$valid_formats = array("jpg", "png", "gif", "bmp");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];
			
			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					if($size<(600*600))
						{
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							$tmp = $_FILES['photoimg']['tmp_name'];
							if(move_uploaded_file($tmp, $path.$actual_image_name))
						{
								
				        $sql = "UPDATE main_pictures_2 SET main_picture= 'uploads/".$actual_image_name."' WHERE id='".$id."';";
				        $res = mysqli_query($con,$sql);
				       
				        echo "<img src='uploads/".$actual_image_name."'  class='preview'> <br> <center> <p> Image Set as Main Photo </p> </center>";
					
					}
							else
								echo "failed";
						}
						else
						echo "Image too big";					
						}
						else
						echo "Invalid file format..";	
				}
				
			else
				echo "Please select image..!";
				
			exit;
		}
?>