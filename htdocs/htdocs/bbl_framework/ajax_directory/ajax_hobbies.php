<?php session_start(); ?>

<?php


class ajaxVal
{
    function formValidate() 
    {
        //Put form elements into post variables (this is where you would sanitize your data)
       
       //$portfolio = $_POST['portfolio_text'];

      $id='';
      
        
              
    if (isset($_SESSION['id_num']))
    {
     $id = $_SESSION['id_num'];
    }
    
    
       

        //Establish values that will be returned via ajax
        $return = array();
        
        
        $hobbies = array(); 
        
        // you might as well hard-code this as it will take just as long making a loop. //
        $hobby_1 = $_POST['hobby_1'];
        $hobby_2 = $_POST['hobby_2']; 
        $hobby_3 = $_POST['hobby_3']; 
        $hobby_4 = $_POST['hobby_4']; 
        $hobby_5 = $_POST['hobby_5']; 
        
        
        
        $hobbies[0] =  $hobby_1;
        $hobbies[1] =  $hobby_2;
        $hobbies[2] =  $hobby_3;
        $hobbies[3] =  $hobby_4;
        $hobbies[4] =  $hobby_5;
       
      
        $testString = '' ; 
        
        for($x=0; $x<sizeof($hobbies); $x++)
        {
	       $testString.=$hobbies[$x].'<br>';
        }
        
        $return['error'] = false;
      //  $return['msg'] = '<p>'.$testString.'</p>';  // testing */


        //$return['msg'] = '';     // just to get compiler to hush up
        //$return['error'] = false;

        //Begin form validation functionality
       /* if (!isset($portfolio) || empty($portfolio))      // checks if fiellds are empty
        {
            $return['error'] = true;
            $return['msg'] .= '<li>Error: Field1 is empty.</li>';
        }*/

        //Begin form success functionality
        if ($return['error'] === false)    // checks for an error
        {
            // running a query, need to optimize feilds. 
            // at this point we can run a sql query with the post variables from the form
            include 'dAl.php';
            $host = DataAccessProtocol::host;
            $user = DataAccessProtocol::user;
            $db_pass = DataAccessProtocol::pass;
            $dbName = DataAccessProtocol::db;

            $con = mysqli_connect($host, $user, $db_pass, $dbName); // basic mysql/php cxn// 
            // Check connection// 
            /// connection-> runquery()// datadafa...//
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else 
            {
              
                //$sql = "UPDATE user_info_2 SET portfolio = '".$portfolio."' WHERE id = '".$id."'; ";
                // update interests where set interest_1 = $interests[0]-$interests[9] - interest_10 Where id = $id; //
                
                 
                $sql = "UPDATE hobbies SET hobby_1 = '".$hobbies[0]."', hobby_2 = '".$hobbies[1]."', hobby_3 = '".$hobbies[2]."',  hobby_4 = '".$hobbies[3]."', hobby_5 = '".$hobbies[4]."' where id = '".$id."';";
                $res = mysqli_query($con, $sql);
                if (!$res)
                {// if there is a problem, it lies here
                    echo "error with mysql query";
                }
                else
                {
                $return['msg'] = "Success";
                mysqli_close($con);
                }
            }
             
             
            ///// yes, success
     }
        //Return json encoded results SO US CARBON UNITS CAN READ IT!!!
         
        return json_encode($return);
    }

}

$ajaxValidate = new ajaxVal;
echo $ajaxValidate->formValidate();

?>
