<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Paint;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\PaintRepository;
use App\Services\CommentService;
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
        $data = $paintRepository->findBy([], ['id' => 'DESC']);

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
    public function realizationDetail(
        Paint $paint,
        Request $request,
        CommentService $commentService,
        CommentRepository $commentRepository
    ): Response {
        $comment = new Comment();
        $comments = $commentRepository->findComments($paint);

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $commentService->persistComment($comment, null, $paint);

            $this->addFlash(
                'success',
                'Votre commentaire a été envoyé avec succès ! Votre commentaire est en attente de modération pour le moment.'
            );

            return $this->redirectToRoute('app_realization_detail', ['id' => $paint->getId()]);
        }

        return $this->render('realization/detail.html.twig', [
            'paint' => $paint,
            'form' => $form->createView(),
            'comments' => $comments,
        ]);
    }
}
