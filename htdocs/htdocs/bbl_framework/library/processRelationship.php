<?php

class RelationshipProcessor
{
 public function processRelationship($userId, $friendId)
{


    $path = $_SERVER['DOCUMENT_ROOT'];
    include_once($path.'/bbl_framework/util/UserCreator.php');
    include_once($path.'/bbl_framework/util/QueryRunner.php');

    $qr = new QueryRunner();
    $uc = new UserCreator();

   // echo "where the fuck is this wrong <br> ";

// Code to fetch all from first ID

    $first_passions = $uc->getPassions($userId);
    $first_goals    = $uc->getGoals($userId);
    $first_achiv    = $uc->getAchievements($userId);
    $first_friend   = $uc->getFriends($userId);
//
// Code to fetch all from Second Id
    $second_passions = $uc->getPassions($friendId);
    $second_goals    = $uc->getGoals($friendId);
    $second_achiv    = $uc->getAchievements($friendId);
    $second_friend   = $uc->getFriends($friendId);

//// so Find where the have commonalities, luckliy for me, I have a library. //
    // echo "<h1> Passion Match </h1> <br> ";
    $passion_match  = $this->findMatches($first_passions, $second_passions);
    // echo "<h1> Goal Match </h1> <br> ";

     $goal_match     = $this->findMatches($first_goals, $second_goals);
     //echo "<h1> ach Match </h1> <br> ";

     $ach_match      = $this->findMatches($first_achiv, $second_achiv);
    // echo "<h1> friend Match </h1> <br> ";

     $friend_match   = $this->findMatches($first_friend, $second_friend);


    $match_array = array();

    array_push($match_array, $passion_match);
    array_push($match_array, $goal_match);
    array_push($match_array, $ach_match);
    array_push($match_array, $friend_match);

    return $match_array;


}

 public function findMatches($array_one, $array_two)
{

   // echo "<h1> FIND MATCHES CALLED  - </h1>".var_dump($array_one)."   ".var_dump($array_two);
    $matches = array();
    for($x=0; $x<sizeof($array_one); $x++)
    {
       $s_1  = $array_one[$x];
       for($y=0; $y<sizeof($array_two); $y++)
       {
           $s_2 = $array_two[$y];
          //echo "String test - STRING ONE :".$s_1."   || STRING TWO : ".$s_2."<br>";
           if($array_one[$x] == $array_two[$y])
           {
               //echo "Ok Match.";
               array_push($matches,$array_one[$x]);
           }
       }
    }
    return $matches;
}
}
?>