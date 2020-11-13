<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DocumentRepository;

/**
 * Class DocumentListController.
 */
class DocumentListController extends AbstractController
{
    /**
     * @Route("/document/list/", name="document_list", methods={"GET"})
     *
     * @param DocumentRepository $documentRepository
     * @param Request         $request
     *
     * @return Response
     */
    public function Categorylist(
        DocumentRepository $documentRepository,
        Request $request
    ): Response {
        
        $category = $request->get('category');

        return $this->render(
            'document/list.html.twig',
             [
            'documents' => $documentRepository->findBy(
                 ['category' => $category],
                 ['publishedAt' => 'asc'],
                 6,
                 ($request->query->get('page', 2) - 1) * 6
             ),
             ]
        );
    }
}
