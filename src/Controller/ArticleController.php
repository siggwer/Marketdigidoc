<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CommentRepository;
use App\Repository\ArticleRepository;
use App\Handler\UpdateTrickHandler;
use App\Handler\ShowTrickHandler;
use App\Handler\AddTrickHandler;
use App\Entity\Comment;
use App\Entity\Trick;
use Exception;

/**
 * Class ArticleController.
 *
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/list", name="article_list", methods={"GET"})
     *
     * @param ArticleRepository $articleRepository
     * @param Request         $request
     *
     * @return Response
     */
    public function list(
        ArticleRepository $articleRepository,
        Request $request
    ): Response {
        return $this->render(
            'article/list.html.twig'
            // 'article/list.html.twig',
            // [
            // 'articles' => $articleRepository->findBy(
            //     [],
            //     ['publishedAt' => 'desc'],
            //     6,
            //     ($request->query->get('page', 2) - 1) * 6
            // ),
            // ]
        );
    }
}
