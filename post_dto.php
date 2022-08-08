<?php

class PostDto {

    public int $id;
    public string $title;
    public string $body;
    public string $create_at;
    public string $author;

    public function __construct(int $id, string $title, string $body, string $create_at, string $author) {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->create_at = date('Y-m-d', strtotime($create_at)); 
        $this->author = $author;
    }
};

?>