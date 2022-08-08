<?php

function getDatabaseConnection () {
    $connection = new PDO("mysql:host=localhost;dbname=Blog_Schema", "root", "Milena123");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connection;
};

function getAllPosts()
{
    try
    {
        $connection = getDatabaseConnection();

        $sql = "SELECT * FROM Blog ORDER BY Create_at DESC";
        $statement = $connection->prepare($sql);

        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $posts = $statement->fetchAll();

        $arrayOfPosts = array();

        foreach($posts as $index => $post) { 
            $single_post = new PostDto($post["Id"], $post["Title"], $post["Body"], $post["Create_at"], $post["Author"]); 
            $arrayOfPosts[$index] = $single_post;
        }

        return $arrayOfPosts;
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "<script>console.log('Console: " . $e . "' );</script>";
    }
};

function getPostById($id) {
    try
    {
        $connection = getDatabaseConnection();

        $sql = "SELECT * FROM Blog WHERE id = :id";
        $statement = $connection->prepare($sql);

        $statement->bindParam(':id', $id);

        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $post = $statement->fetch();

        return $post = new PostDto($post["Id"], $post["Title"], $post["Body"], $post["Create_at"], $post["Author"]); 
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "<script>console.log('Console: " . $e . "' );</script>";
    };
};

function getCommentsByPostId($id) {
    try
    {
        $connection = getDatabaseConnection();

        $sql = "SELECT * FROM Comments WHERE Post_id=:id";
        $statement = $connection->prepare($sql);

        $statement->bindParam(':id', $id);

        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $databaseComments = $statement->fetchAll();
        
        $arrayOfComments = array();

        foreach($databaseComments as $index => $comment) { 
            $single_comment = new CommentsDto($comment["Id"], $comment["Author"], $comment["Text"], $comment["Post_id"]); 
            $arrayOfComments[$index] = $single_comment;
        }

        return $arrayOfComments; 
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "<script>console.log('Console: " . $e . "' );</script>";
    };
}
?>