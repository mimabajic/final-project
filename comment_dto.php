<?php

class CommentsDto {

    public int $id;
    public string $author;
    public string $text;
    public int $post_id;

    public function __construct(int $id, string $author, string $text, string $post_id) {
        $this->id = $id;
        $this->author = $author;
        $this->text = $text;
        $this->post_id = $post_id;
    }
};

?>