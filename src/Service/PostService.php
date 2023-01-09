<?php

namespace App\Service;

use App\Dto\PostDto;
use App\Entity\Post;
use App\Factory\PostFactory;
use App\Repository\PostRepository;

class PostService
{
    public function __construct(
        private PostRepository $postRepository
    ){}

    public function createPost(PostDto $postDto): PostDto
    {
        $post = PostFactory::create($postDto);
        $this->postRepository->save($post, true);

        return PostDto::fromEntity($post);
    }
}