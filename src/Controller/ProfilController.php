<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DocumentRepository;
use Exception;

/**
 * ProfilController class
 * 
 * @Route("/profil")
 */
class ProfilController extends AbstractController
{
    /**
     * @Route("/my-account", name="my_account", methods="GET")
     * 
     * @param DocumentRepository $documentRepository
     *
     * @return void
     */
    public function showProfil(UserInterface $user, DocumentRepository $documentRepository) 
    {
        $user = $user->getId();

        return $this->render('security/user/profil.html.twig',
            [
                'documents' => $documentRepository->findBy(
                ['author' => $user],
                ['publishedAt' => 'desc'],6,0),
            ]
         );
     }

}