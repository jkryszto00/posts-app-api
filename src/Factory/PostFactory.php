<?php

namespace App\Factory;

use App\Dto\PostDto;
use App\Entity\Post;

class PostFactory
{
    public static function create(PostDto $postDto): Post
    {
        $post = new Post();
        $post->setAuthor($postDto->author);
        $post->setTitle($postDto->title);
        $post->setBody($postDto->body);

        return $post;
    }
}