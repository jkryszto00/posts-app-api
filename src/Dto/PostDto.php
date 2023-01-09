<?php

namespace App\Dto;

use App\Entity\Post;

class PostDto
{
    public function __construct(
        readonly public ?int $id,
        readonly public string $author,
        readonly public string $title,
        readonly public string $body
    ){}

    public static function fromConsumer(array $data, string $author): self
    {
        return new self(
            id: null,
            author: $author,
            title: $data['title'],
            body: $data['body']
        );
    }

    public static function fromEntity(Post $post): self
    {
        return new self(
            id: $post->getId(),
            author: $post->getAuthor(),
            title: $post->getTitle(),
            body: $post->getBody()
        );
    }
}