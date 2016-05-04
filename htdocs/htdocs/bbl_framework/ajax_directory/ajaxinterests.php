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
        
        
        $interests = array(); 
        
        // you might as well hard-code this as it will take just as long making a loop. //
        $interest_1 = $_POST['interest_1'];
        $interest_2 = $_POST['interest_2']; 
        $interest_3 = $_POST['interest_3']; 
        $interest_4 = $_POST['interest_4']; 
        $interest_5 = $_POST['interest_5']; 
        $interest_6 = $_POST['interest_6']; 
        $interest_7 = $_POST['interest_7']; 
        $interest_8 = $_POST['interest_8']; 
        $interest_9 = $_POST['interest_9']; 
        $interest_10 = $_POST['interest_10']; 
        
        
        $interests[0] =  $interest_1;
        $interests[1] =  $interest_2;
        $interests[2] =  $interest_3;
        $interests[3] =  $interest_4;
        $interests[4] =  $interest_5;
        $interests[5] =  $interest_6;
        $interests[6] =  $interest_7;
        $interests[7] =  $interest_8;
        $interests[8] =  $interest_9;
        $interests[9] =  $interest_10;

      
        $testString = '' ; 
        
        for($x=0; $x<sizeof($interests); $x++)
        {
	       $testString.=$interests[$x].'<br>';
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
                
                 
                $sql = "UPDATE interests SET interest_1 = '".$interests[0]."', interest_2 = '".$interests[1]."', interest_3 = '".$interests[2]."',  interest_4 = '".$interests[3]."', interest_5 = '".$interests[4]."',interest_6 = '".$interests[5]."',interest_7 = '".$interests[6]."',interest_8 = '".$interests[7]."',interest_9 = '".$interests[8]."', interest_10 = '".$interests[9]."' where id = '".$id."';";
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
