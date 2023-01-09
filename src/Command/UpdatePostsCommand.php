<?php

namespace App\Command;

use App\Consumer\TypicodeConsumer;
use App\DTO\PostDTO;
use App\Service\PostService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'typicode:update-posts',
    description: 'Fetch posts from api and store in db'
)]
class UpdatePostsCommand extends Command
{
    public function __construct(
        private TypicodeConsumer $typicodeConsumer,
        private PostService $postService
    ){
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $posts = $this->typicodeConsumer->getPosts();
        $users = $this->typicodeConsumer->getUsers();

        $postsCollection = array_map(fn ($post) => PostDTO::fromConsumer($post, $this->getAuthor($post, $users)), $posts);

        foreach ($postsCollection as $post) {
            $this->postService->createPost($post);
        }

        $output->writeln('Posts stored successfully!');

        return Command::SUCCESS;
    }

    private function getAuthor(array $post, array $users): string
    {
        return $users[key(array_filter($users, fn ($user) => $user['id'] == $post['userId']))]['name'];
    }
}