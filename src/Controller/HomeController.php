<?php

namespace App\Controller;

use App\Repository\BlogPostRepository;
use App\Repository\PaintRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PaintRepository $paintRepository,
        BlogPostRepository $blogPostRepository,
        UserRepository $userRepository
    ): Response {
        return $this->render('home/index.html.twig', [
            'last_three_paints' => $paintRepository->getLastThree(),
            'last_three_blog_post' => $blogPostRepository->getLastThree(),
            'painter' => $userRepository->getPainter(),
        ]);
    }
}
