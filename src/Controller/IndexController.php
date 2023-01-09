<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    public function __construct(
        private PostRepository $postRepository
    ){}

    #[Route('/list', name: 'app_index', methods: ['GET', 'HEAD'])]
    public function index(): Response
    {
        $posts = $this->postRepository->findAll();

        return $this->render('index.html.twig', [
            'posts' => $posts
        ]);
    }

    #[Route('/list/{post}', name: 'app_posts_delete', methods: ['GET', 'DELETE'])]
    public function delete(Post $post): Response
    {
        $this->postRepository->remove($post, true);

        return $this->redirectToRoute('app_index');
    }
}