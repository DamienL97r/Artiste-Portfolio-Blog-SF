<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AboutController extends AbstractController
{
    #[Route('/a-propos', name: 'app_about')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('about/about.html.twig', [
            'painter' => $userRepository->getPainter(),
        ]);
    }
}
