<?php

namespace App\Controller;

use App\Entity\Paint;
use App\Repository\PaintRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RealizationController extends AbstractController
{
    #[Route('/realization', name: 'app_realization')]
    public function index(
        PaintRepository $paintRepository,
        PaginatorInterface $paginator,
        Request $request
        ): Response {
            $data = $paintRepository->findAll();

            $paints = $paginator->paginate(
                $data, 
                $request->query->getInt('page', 1),
                6
            );

            return $this->render('realization/realization.html.twig', [
            'paints' => $paints,
        ]);
    }

    #[Route('/realization/{id}', name: 'app_realization_detail')]
    public function realizationDetail(Paint $paint): Response
    {
        return $this->render('realization/detail.html.twig', [
            'paint' => $paint,
        ]);
    }
}
