<?php
class AjaxComment
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
    $path = $_SERVER['DOCUMENT_ROOT'];
    include_once($path.'/bbl_framework/util/QueryRunner.php');
    $q_r = new QueryRunner();
    $sql = "SELECT * FROM comments WHERE id = '".$post_id."';";
    $res = $q_r->runQueryWithRes($sql);
    while($row = mysqli_fetch_array($res))
    {
        $temp_comment = new AjaxComment($row['id'],$row['author'], $row['comment']);
        array_push($comments,$temp_comment);
    }
    return $comments;
}



$runner = new AjaxComment();
$post_id = $_POST['post_id'];
$comment_array = getComments($post_id);
ob_start()?>
    <ul>
        <?php foreach($comment_array as $elem)
        {?>
            <li> <?php echo $elem->getId(); ?> </li>
        <?php } ?>
    </ul>
<?php
$html = ob_get_clean();

echo $html;

?>