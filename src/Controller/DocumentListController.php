<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DocumentRepository;

/**
 * Class DocumentListController.
 *
 * @Route("/document")
 */
class DocumentListController extends AbstractController
{
    /**
     * @Route("/list", name="document_list", methods={"GET"})
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
        
        $category = $request->get('category');

        return $this->render(
            'document/list.html.twig',
             [
            'documents' => $documentRepository->findBy(
                [],
                ['publishedAt' => 'desc'], 
                6,
                ($request->query->get('page', 2) - 1) * 6
             ),
             ]
        );
    }
}
