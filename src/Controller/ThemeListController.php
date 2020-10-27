<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DocumentRepository;

/**
 * Class ThemeListController.
 */
class ThemeListController extends AbstractController
{
    /**
     * @Route("/theme/list", name="theme_list", methods={"GET"})
     *
     * @param DocumentRepository $documentRepository
     * @param Request         $request
     *
     * @return Response
     */
    public function list(
        DocumentRepository $documentRepository,
        Request $request
    ): Response {
        return $this->render(
            'theme/themeList.html.twig',
             [
            'documents' => $documentRepository->findBy(
                 [],
                 ['name' => 'asc'],
                 4,
                 ($request->query->get('page', 2) - 1) * 4
             ),
             ]
        );
    }
}
