<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\BlogPostRepository;
use App\Repository\CommentRepository;
use App\Services\CommentService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogpostController extends AbstractController
{
    #[Route('/blogpost', name: 'app_blogpost')]
    public function index(
        BlogPostRepository $blogPostRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $data = $blogPostRepository->findBy([], ['id' => 'DESC']);

        $articles = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('blogpost/blogpost.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/blogpost/{id}', name: 'app_blogpost_detail')]
    public function blogPostDetail(
        BlogPost $article,
        Request $request,
        CommentService $commentService,
        CommentRepository $commentRepository
    ): Response
    {
        $comment = new Comment();
        $comments = $commentRepository->findComments($article);

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $commentService->persistComment($comment, $article, null);

            $this->addFlash(
                'success',
                'Votre commentaire a été envoyé avec succès ! Votre commentaire est en attente de modération pour le moment.'
            );

            return $this->redirectToRoute('app_blogpost_detail', ['id' => $article->getId()]);
        }

        return $this->render('blogpost/detail.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
            'comments' => $comments,
        ]);
    }
}
