<?php
require_once "post_dto.php";
require_once "database_manager.php";
require_once "comment_dto.php";

function writeComments($comments) {
    if (!isset($_GET['postId'])) {
        return;
    }

    $headerContext = "
        <div>
            <h3>Comments</h3> 
        <ul>
    ";
    $listContext = $headerContext;
    for($index = 0; $index < count($comments); $index++) {
        $comment = $comments[$index];
        $listContext .= "
            <li>
                <h5>".$comment->author."</h5>
                <h6>".$comment->text."</h6>
            </li>
        ";
        if ($index < count($comments) -1) {
            $listContext .= "<hr>";
        }
    };

    if ($listContext == $headerContext) {
        echo "";
    } else {
        echo $listContext."</ul>";
    }
};

function getSinglePost($post) {
    $query_param = "postId=".$post->id;
    $comments = getCommentsByPostId($post->id);

    echo
        "<div class=\"blog-post\">
            <h2 class=\"blog-post-title\">
                <a href =\"?".$query_param."\">
                    ".$post->title."
                </a>
            </h2>
            <p class=\"blog-post-meta\">".$post->create_at." by <a href=\"#\">".$post->author."</a></p>
            <p>".
            $post->body;
            writeComments($comments)
            ."</p>     
        </div><!-- /.blog-post -->";
};

?>