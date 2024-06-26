<?php

namespace App\Controller;

use App\Repository\BlogPostRepository;
use App\Repository\CategoryRepository;
use App\Repository\PaintRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'sitemap', format: 'xml')]
    public function index(
        Request $request,
        PaintRepository $paintRepository,
        BlogPostRepository $blogPostRepository,
        CategoryRepository $categoryRepository
    ): Response {
        $hostname = $request->getSchemeAndHttpHost();

        $urls = [];

        $urls[] = ['loc' => $this->generateUrl('app_home')];
        $urls[] = ['loc' => $this->generateUrl('app_blogpost')];
        $urls[] = ['loc' => $this->generateUrl('app_contact')];
        $urls[] = ['loc' => $this->generateUrl('app_portfolio')];
        $urls[] = ['loc' => $this->generateUrl('app_realization')];
        $urls[] = ['loc' => $this->generateUrl('app_about')];

        foreach ($paintRepository->findAll() as $paint) {
            $urls[] = [
                'loc' => $this->generateUrl('app_realization_detail', ['id' => $paint->getId()]),
                'lastmod' => $paint->getCreatedAt()->format('Y-m-d'),
            ];
        }

        foreach ($blogPostRepository->findAll() as $article) {
            $urls[] = [
                'loc' => $this->generateUrl('app_blogpost_detail', ['id' => $article->getId()]),
                'lastmod' => $article->getCreatedAt()->format('Y-m-d'),
            ];
        }

        foreach ($categoryRepository->findAll() as $category) {
            $urls[] = [
                'loc' => $this->generateUrl('app_portfolio_category', ['id' => $category->getId()]),
            ];
        }

        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
                'urls' => $urls,
                'hostname' => $hostname,
            ]),
            200
        );

        $response->headers->set('Content-type', 'text/xml');

        return $response;
    }
}
