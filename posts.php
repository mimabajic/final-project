<?php
include "sidebar.php";
require_once "database_manager.php";
require_once "single-post.php";
require_once "post_dto.php";

function writePosts() {
    $posts = getAllPosts();

    for($index = 0; $index < count($posts); $index++) {
        getSinglePost($posts[$index]);
    };
};

if (empty($_GET['postId'])) {
    echo "
    <div class=\"row\">
        <div class=\"col-sm-8 blog-main\">
                ".writePosts()."
                <nav class=\"blog-pagination\">
                    <a class=\"btn btn-outline-primary\" href=\"#\">Older</a>
                    <a class=\"btn btn-outline-secondary disabled\" href=\"#\">Newer</a>
                </nav>
        </div><!-- /.blog-main -->
        ".getSideBar()."
    </div><!-- /.row -->";
} else {
    $singlePost = getPostById($_GET['postId']);
    getSinglePost($singlePost);
}

?>
