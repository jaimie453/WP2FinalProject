<?php

class Post
{
    public $postId;
    public $uId;
    public $parentPost;
    public $title;
    public $message;
    public $postTime;

    public function __construct($_postId, $_uId, $_parentPost, $_title, $_message, $_postTime)
    {
        $this->postId = $_postId;
        $this->uId = $_uId;
        $this->parentPost = $_parentPost;
        $this->title = $_title;
        $this->message = $_message;
        $this->postTime = $_postTime;
    }
}
