<?php
class UserCreator
{

   public function createNewUser($id)
   {
     $path = $_SERVER['DOCUMENT_ROOT'];
     // result variable //
     $q_r = new QueryRunner();
     //
     $res = $q_r->runQueryWithRes("SELECT * FROM users WHERE id = '".$id."';"); //mysql result variable //
      /// user variable will be returned //
     $return_user='';
     while($row = mysqli_fetch_array($res)) // abbrivated while loop
     {
     	$return_user = new nested_user($row['id'],$row['first_name'],$row['last_name'],$row['email'],$row['password']); // construct to user in same file
     }
     return $return_user; // return user variable / /
   }

   public function getPosts($id)
   {
        // run this query , { SELECT * FROM posts WHERE 'id' = '".$id."'; }
        // from there, we can select data from assoc. arrays /
        $three_d_array = array();

        $q_r = new QueryRunner();
        $query = "SELECT * FROM posts WHERE id = '".$id."';";
        $fileroots = array();
        $post_texts = array();
        $liked = array();
       $type = array();


        $res = $q_r->runQueryWithRes($query);
        while($row = mysqli_fetch_array($res)) // fetch results as array and print data
        {
            // get the user's first and last name;
            array_push($fileroots, $row['file_root']);
            array_push($post_texts,$row['post_text']);
            array_push($liked, $row['likes']);
            array_push($type,$row['file_type']);
        }

        array_push($three_d_array,$fileroots);
        array_push($three_d_array,$post_texts);
        array_push($three_d_array,$liked);
        array_push($three_d_array,$type);


       return $three_d_array;
   }


    public function getFriends($id)
    {
        $q_r = new QueryRunner();
        $friends_list = array();

        // People who requested the current user will be found, however a new query needs to be ran to fetch the counterpart .. //
        $res_2 = $q_r->runQueryWithRes("SELECT * FROM friends WHERE id_1 = '".$id."' AND status = 'FRIENDS'; ");
        while($row = mysqli_fetch_array($res_2))
        {
            $temp_user = $this->createNewUser($row['id_2']);
            array_push($friends_list, $temp_user);
        }

        // this gets people who the user requested //

        $res_3 = $q_r->runQueryWithRes("SELECT * FROM friends WHERE id_2 = '".$id."' AND status = 'FRIENDS';");
        while($row = mysqli_fetch_array($res_3))
        {
            $temp_user = $this->createNewUser($row['id_1']);
            array_push($friends_list, $temp_user);
        }
        return $friends_list;
    }

     public function getZipCode($id)
     {
         $q_r = new QueryRunner();
         $zip = '';
         $res = $q_r->runQueryWithRes("SELECT * FROM zips WHERE id = '".$id."'; ");
         while($row = mysqli_fetch_array($res))
         {
             //$temp_user = $this->createNewUser($row['id_2']);
             $zip = ($row['zip_code']);

         }


         return $zip;

     }
     public function getProvides($id)
     {
         $q_r = new QueryRunner();
         $provides_list = array();

         // People who requested the current user will be found, however a new query needs to be ran to fetch the counterpart .. //
         $res_2 = $q_r->runQueryWithRes("SELECT * FROM providing WHERE id = '".$id."'; ");
         while($row = mysqli_fetch_array($res_2))
         {
             //$temp_user = $this->createNewUser($row['id_2']);
             array_push($provides_list,$row['provide']);

         }

         return $provides_list;

     }
    public function getPassions($id)
    {

        $q_r = new QueryRunner();
        $passions_list = array();

        // People who requested the current user will be found, however a new query needs to be ran to fetch the counterpart .. //
        $res_2 = $q_r->runQueryWithRes("SELECT * FROM passions WHERE id = '".$id."'; ");
        while($row = mysqli_fetch_array($res_2))
        {
            //$temp_user = $this->createNewUser($row['id_2']);
            array_push($passions_list,$row['passion']);

        }

        return $passions_list;

    }

    function getPicturesArray($id)
    {
        $q_r = new QueryRunner();
        $pic_roots = array();
        $res = $q_r->runQueryWithRes("SELECT picture_root FROM images WHERE id = '".$id."';");
        while($row = mysqli_fetch_array($res)) // fetch results as array and print data
        {
            // echo "Picture root : ".$row['picture_root'];
            array_push($pic_roots,$row['picture_root']);
        }
        return $pic_roots;
    }

    function getVideosArray($id)
    {
        $vid_roots = array();
        // include('dAl.php');
        $q_r = new QueryRunner();
        $res = $q_r->runQueryWithRes("SELECT video_root FROM videos WHERE id = '".$id."';");
        while($row = mysqli_fetch_array($res)) // fetch results as array and print data
        {
            array_push($vid_roots,$row['video_root']);
        }
        return $vid_roots;
    }



    public function getGoals($id)
    {
        $q_r = new QueryRunner();
        $goals_list = array();

        // People who requested the current user will be found, however a new query needs to be ran to fetch the counterpart .. //
        $res_2 = $q_r->runQueryWithRes("SELECT * FROM goals WHERE id = '".$id."'; ");
        while($row = mysqli_fetch_array($res_2))
        {
            //$temp_user = $this->createNewUser($row['id_2']);
            array_push($goals_list,$row['goal']);

        }

        return $goals_list;
    }

    public function getAchievements($id)
    {

        $q_r = new QueryRunner();
        $ach_list = array();

        // People who requested the current user will be found, however a new query needs to be ran to fetch the counterpart .. //
        $res_2 = $q_r->runQueryWithRes("SELECT * FROM achivements WHERE id = '".$id."'; ");
        while($row = mysqli_fetch_array($res_2))
        {
            //$temp_user = $this->createNewUser($row['id_2']);
            array_push($ach_list,$row['achi']);

        }

        return $ach_list;
    }

    public function getUnique($id)
    {

        $q_r = new QueryRunner();
        $uq = '';

        // People who requested the current user will be found, however a new query needs to be ran to fetch the counterpart .. //
        $res_2 = $q_r->runQueryWithRes("SELECT * FROM uq WHERE id = '".$id."'; ");
        while($row = mysqli_fetch_array($res_2))
        {
            //$temp_user = $this->createNewUser($row['id_2']);
            $uq = $row['txt'];

        }

        return $uq;
    }



    public function areFriends($id1,$id2)
    {

        $q_r = new QueryRunner();

        $res_2 = $q_r->runQueryWithRes("SELECT * FROM friends WHERE id_1 = '".$id1."' and  id_2 = '".$id2."';");
        $rows = 0;
        while($row = mysqli_fetch_array($res_2))
        {
           $rows++;
        }

        $res_3 = $q_r->runQueryWithRes("SELECT * FROM friends WHERE id_1 = '".$id2."' and  id_2 = '".$id1."';");
        while($row = mysqli_fetch_array($res_2))
        {
            $rows++;
        }

       if($rows <=1)
       {
           return true;
       }
        else
        {
            return false;
        }
    }

    public function getProfilePicture($id)
    {
        $path = $_SERVER['DOCUMENT_ROOT'];
        include_once $path.'/bbl_framework/util/QueryRunner.php';
        $q_r = new QueryRunner();
        $img_root = '';
        $sql = "SELECT pro_pic_root FROM profile_picutres WHERE id = '".$id."' " ;
        $res_2 = $q_r->runQueryWithRes($sql);

        while($row = mysqli_fetch_array($res_2))
        {
            $img_root = $row['pro_pic_root'];
        }
        $path = $_SERVER['DOCUMENT_ROOT'];

        return $img_root;
    }


}

?>
<?php
	class nested_user // generic user class //
{
		private $id; // PRIMARY KEY
		private $firstName; // F
		private $lastName;  // L
		private $email;     // E
		private $password;  // P


		public function nested_user($i, $f, $l, $e,$p) // public constructuor //
		{
			$this->id= $i;
			$this->firstName = $f;
			$this->lastName = $l;
			$this->email = $e;
			$this->password= $p;
		}

    // ENCAPSULATION , ONLY GET FUNCTIONS; NO ACCESS THRU SET/

       public function  getId()
       {
           return $this->id;
       }
		public function getFirstName()
		{
			return $this->firstName;
		}
		public function getLastName()
		{
			return $this->lastName;
		}
		public function getEmail()
		{
			return $this->email;
		}
		public function getPassword()
		{
			return $this->password;
		}

        public function toString()
        {
            echo $this->firstName."<br>".$this->lastName."<br>".$this->email."<br>".$this->password;
        }
}
?>