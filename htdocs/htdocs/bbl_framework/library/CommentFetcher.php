<?php
class Comment
{
  private $id;
  private $author;
  private $comment;

  public function Comment($i,$a,$c)
  {
      $this->id = $i;
      $this->author = $a;
      $this->comment = $c;
  }
  public function getId()
  {
      return $this->id;
  }

  public function getAuthor()
  {
        return $this->author;
  }

  public function getComment()
  {
        return $this->comment;
  }

}

function getComments($post_id)
{
    $comments = array();
    $q_r = new QueryRunner();
    $sql = "SELECT * FROM comments WHERE id = '".$post_id."';";
    $res = $q_r->runQueryWithRes($sql);
    while($row = mysqli_fetch_array($res))
    {
        $temp_comment = new Comment($row['id'],$row['author'], $row['comment']);
        array_push($comments,$temp_comment);

    }
    return $comments;
}




?>