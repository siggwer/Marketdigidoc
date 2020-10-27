<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Document;
use Exception;

/**
 * Class ShowController.
 */
class ShowController extends AbstractController
{
    /**
     * @Route("/document/{slug}", name="document_show", methods={"GET"})
     *
     * @param Request           $request
     *
     * @param  Document         $document
     * @return Response
     *
     * @throws Exception
     */
    public function show(
        Request $request,
        Document $document
    ): Response {
        
        if ($document->getSlug() === true) {
             return $this->redirectToRoute('document_show', ['slug' => $document->getSlug()]);
         }
            
        return $this->render(
            'document/show.html.twig',
            [
                'document' => $document
         
            ]
        );
    }
}