<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\PaintRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PortfolioController extends AbstractController
{
    #[Route('/portfolio', name: 'app_portfolio')]
    public function index
    (
        CategoryRepository $categoryRepository,
    ): Response
    {
        return $this->render('portfolio/portfolio.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/portfolio/{id}', name: 'app_portfolio_category')]
    public function category(Category $category,PaintRepository $paintRepository): Response
    {
        $paints = $paintRepository->findAllPortfolio($category);

        return $this->render('portfolio/category.html.twig', [
            'category' => $category,
            'paints' => $paints,
        ]);
    }
}
