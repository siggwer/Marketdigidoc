<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\DocumentRepository;

/**
 * Class HomeController.
 *
 * @method getRequest()
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods="GET")
     * 
     * @param DocumentRepository $documentRepository
     *
     * @return Response
     */
    public function __invoke(DocumentRepository $documentRepository): Response
    {
        return $this->render(
            'default/home.html.twig',
            [
            'documents' => $documentRepository->findBy([],['publishedAt' => 'desc'],6,0),
            ]
        );
    }
}