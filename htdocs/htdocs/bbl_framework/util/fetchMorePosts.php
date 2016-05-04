<?php session_start(); ?>
<?php
class post
{
    private $id;
    private $author;
    private $description;
    private $filepath;
    private $filetype;
    private $tag;
    private $post_num;

    public function post($id,$author,$desc,$fp,$ft,$t,$num)
    {
        $this->id = $id;
        $this->author = $author;
        $this->description = $desc;
        $this->filepath = $fp;
        $this->filetype = $ft;
        $this->tag = $t;
        $this->post_num = $num;

    }

    public function getPostData()
    {
        $information_array = array();
        array_push($information_array , $this->id);
        array_push($information_array , $this->author);
        array_push($information_array , $this->description);
        array_push($information_array , $this->filepath);
        array_push($information_array , $this->filetype);
        array_push($information_array , $this->tag);
        array_push($information_array , $this->post_num);

        return $information_array;
    }

    public function getFileType()
    {
        return $this->filetype;

    }
    public function getFileRoot()
    {
        return $this->filepath;
    }

    public function getDescription()
    {
        return $this->description;

    }
    public function getTag()
    {
        return $this->tag;
    }
    public function getPostNum()
    {
        return $this->post_num;
    }
}
?>

<?php
$id = '';
if(isset($_SESSION['id_num']))
{
    $id = $_SESSION['id_num'];
}

?>

<?php
class postMatcher
{

  function findMatchingPosts($passions_list,$Q, $last_row)
  {
      $path = $_SERVER['DOCUMENT_ROOT'];
      include_once $path.'/bbl_framework/util/QueryRunner.php';

    $posts = array();
    foreach($passions_list as $elem)
    {
        $sql = "SELECT * FROM instant_posts WHERE tag = '".$elem."' AND post_num > '".$last_row."' ORDER BY post_num ASC LIMIT 2;";

        $res = $Q->runQueryWithRes($sql);

        while($row = mysqli_fetch_array($res))
        {
            $temp_post = new post($row['id'],$row['author'],$row['description'],$row['file_path'],$row['file_type'],$row['tag'],$row['post_num']);
            array_push($posts,$temp_post);
        }
    }
    return $posts;
  }

   function getPosts($id, $last_row)
   {
    $path = $_SERVER['DOCUMENT_ROOT'];
    include_once $path.'/bbl_framework/util/UserCreator.php';
    include_once $path.'/bbl_framework/util/QueryRunner.php';
    $Q = new QueryRunner();
    $u_c = new UserCreator();
    $passions_list = $u_c->getPassions($id);
    $post_list = $this->findMatchingPosts($passions_list,$Q,$last_row);
    return $post_list;
   }

    function returnData($post_list)
    {
        $path = $_SERVER['DOCUMENT_ROOT'];
        include_once $path.'/bbl_framework/util/UserCreator.php';
        $u_c = new UserCreator();
        $current_user = $u_c->createNewUser($_SESSION['id_num']);
        $html = '';

        for($x=0; $x<sizeof($post_list); $x++)
        {  ob_start()?>
            <?$assoc_type = $post_list[$x]->getFileType();?>
            <? if($assoc_type == "img")
            {?>

                <script type="application/javascript">

                    // by default hide video and sound //
                    $(document).ready(function()
                    {
                        $('#video_preview').hide();
                        $('#audio_preview').hide();
                    });


                    $(document).ready(function()
                    {
                        $('#close_li').hide();
                        $('.comments').hide();
                        $('.hide_comments').hide();
                    });


                    $('.show_comments').click(function()
                    {
                        // alert("YOU CLICKED ME NIGGA!");
                        $(this).parent().next('.comments').slideDown();
                        $(this).hide();
                        $('.hide_comments').show();

                    });

                    $('.hide_comments').click(function()
                    {
                        // alert("YOU CLICKED ME NIGGA!");
                        $(this).parent().slideUp();
                        $(this).hide();
                        $('.show_comments').show();

                    });


                    $('.comment_post').click(function(event)
                    {
                        //alert($(this).parent().parent().attr('class'));
                        event.preventDefault();
                        event.stopImmediatePropagation();

                        var author = $(this).parent().parent().children('.hidden_author').val();
                        var id = $(this).parent().parent().children('.hidden_id').val();
                        var comment  = $(this).parent().parent().children('.comment_poster').val();

                        $.ajax
                        (
                            {
                                type: 'POST',
                                url: '../bbl_framework/library/post_comment.php',
                                data: {hidden_id : id, hidden_author : author, hidden_comment:comment} ,
                                dataType: 'json',
                                success: function (data)
                                {
                                    location.reload();

                                }
                            });
                    });
                </script>
              <div class ="img_post">
                    <img src="/js_img_test/<?php echo $post_list[$x]->getFileRoot();?>" class = "post_img">
                    <br>
                    <br>
                    <h3 class = "post_decript"><?php echo $post_list[$x]->getDescription(); ?></h3>
                    <br>
                    <h4><stong>Tag :</stong><?php echo $post_list[$x]->getTag();?></h4>
                    <hr>
                    <form action="" id =<?php echo $post_list[$x]->getPostNum()?> class  = "hidden_post_form">
                    <input type="hidden" value="<?php echo $current_user->getFirstName()." ".$current_user->getLastName()?>" class = "hidden_author" name="hidden_author">
                    <input type="hidden" value="<?php echo $post_list[$x]->getPostNum()?>" class = "hidden_id" name="hidden_id">
                    <input type="hidden" value="<?php echo $current_user->getId()?>" class = "user_id" name="user_id">
                    <textarea style="width: 90%; height: 20%;" class="comment_poster" name ="hidden_comment">Post a comment</textarea>
                    <center class="center"><input class = "comment_post" type="button" value="Post" onclick="postComment();"/></center>
                    </form>
                    <hr>
                    <?php include_once($path."/bbl_framework/library/CommentFetcher.php");
                    $temp_comments = getComments($post_list[$x]->getPostNum());
                    if($temp_comments)
                    {
                    //var_dump($temp_comments);
                    ?>
                    <p align="left"> <button class="show_comments" onclick=""> Show Comments </button> </p>
                    <div class = "comments">
                        <?php
                        foreach($temp_comments as $elem)
                        {
                            echo "<hr><p align='left'>".$elem->getAuthor()."<br> Comment : &nbsp;".$elem->getComment()."</p>";
                        }

                        ?>
                        <button class="hide_comments" onclick=""> Hide Comments </button> <? }?>
                    </div>
                </div>
                <br>
                <br>
                <br>
            <?php } else if ($assoc_type == "vid")
            {?>
                <div class ="img_post">
                    <video controls="controls" src="/js_img_test/<?php echo $post_list[$x]->getFileRoot();?>" class = "post_vid"> </video>
                    <br>
                    <br>
                    <h3 class = "post_decript"><?php echo $post_list[$x]->getDescription(); ?></h3>
                    <br>
                    <h4><stong>Tag :</stong><?php echo $post_list[$x]->getTag();?></h4>
                    <hr>
                    <form action="" id =<?php echo $post_list[$x]->getPostNum()?>  class  = "hidden_post_form">
                    <input type="hidden" value="<?php echo $current_user->getFirstName()." ".$current_user->getLastName()?>" class = "hidden_author" name="hidden_author">
                    <input type="hidden" value="<?php echo $post_list[$x]->getPostNum()?>" class = "hidden_id" name="hidden_id">
                    <input type="hidden" value="<?php echo $current_user->getId()?>" class = "user_id" name="user_id">
                    <textarea style="width: 90%; height: 20%;" class="comment_poster" name ="hidden_comment">Post a comment</textarea>
                    <center class="center"><input class = "comment_post" type="button" value="Post" onclick="postComment();"/></center>
                    </form>
                    <hr>
                    <?php include_once($path."/bbl_framework/library/CommentFetcher.php");
                    $temp_comments = getComments($post_list[$x]->getPostNum());
                    if($temp_comments)
                    {
                    //var_dump($temp_comments);
                    ?>
                    <p align="left"> <button class="show_comments" onclick=""> Show Comments </button> </p>
                    <div class = "comments">
                        <?php
                        foreach($temp_comments as $elem)
                        {
                            echo "<hr><p align='left'>".$elem->getAuthor()."<br> Comment : &nbsp;".$elem->getComment()."</p>";
                        }

                        ?>
                        <button class="hide_comments" onclick=""> Hide Comments </button><? }?>
                    </div>
                </div>
                <br>
                <br>
                <br>
            <?php } else if ($assoc_type[$num_posts] == "sound") {?>
                <div class ="img_post">
                    <audio controls="controls" src="/js_img_test/<?php echo $post_list[$num_posts]->getFileRoot();?>" class = "post_vid">
                        <br>
                        <br>
                        <h3 class = "post_decript"><?php $post_list[$num_posts]->getDescription(); ?></h3>
                        <hr>
                        <hr>
                        <form action="" id =<?php echo $post_list[$x]->getPostNum()?>  class  = "hidden_post_form">
                        <input type="hidden" value="<?php echo $current_user->getFirstName()." ".$current_user->getLastName()?>" class = "hidden_author" name="hidden_author">
                        <input type="hidden" value="<?php echo $post_list[$x]->getPostNum()?>" class = "hidden_id" name="hidden_id">
                        <input type="hidden" value="<?php echo $current_user->getId()?>" class = "user_id" name="user_id">
                        <textarea style="width: 90%; height: 20%;" class="comment_poster" name ="hidden_comment">Post a comment</textarea>
                        <center class="center"><input class = "comment_post" type="button" value="Post" onclick="postComment();"/></center>
                        </form>
                        <hr>
                        <?php include_once($path."/bbl_framework/library/CommentFetcher.php");
                        $temp_comments = getComments($post_list[$x]->getPostNum());
                        if($temp_comments)
                        {
                        //var_dump($temp_comments);
                        ?>
                        <p align="left"> <button class="show_comments" onclick=""> Show Comments </button> </p>
                        <div class = "comments">
                            <?php
                            foreach($temp_comments as $elem)
                            {
                                echo "<hr><p align='left'>".$elem->getAuthor()."<br> Comment : &nbsp;".$elem->getComment()."</p>";
                            }

                            ?>
                            <button class="hide_comments" onclick=""> Hide Comments </button> <? }?>
                        </div>
                </div>
                <br>
                <br>
                <br>


            <?php }} ?>




</div>

</div>

</div>
<? $html = ob_get_clean();
        return $html;
}

}

$post_num = $_POST['lastid'];
$pm = new postMatcher();
$posts = $pm->getPosts($id,$post_num);
if($posts)
{
$html = $pm->returnData($posts);
$html = str_replace("true", "", $html);
echo json_encode(print_r($html));
}

?>

