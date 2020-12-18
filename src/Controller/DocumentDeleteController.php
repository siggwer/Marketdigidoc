<?php

declare(strict_types=1);

namespace App\Controller;

use App\Voter\DocumentVoter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DocumentRepository;
use App\Entity\Document;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Twig\Environment;

/**
 * Class DocumentDeleteController
 *
 * @package App\Controller
 *
 * @Route("/document")
 */
class DocumentDeleteController extends AbstractController
{
    /**
     * @var DocumentRepository
     */
    private $documentRepository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var SessionInterface
     */
    private $messageFlash;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorization;

    /**
     * DocumentUpdate constructor.
     *
     * @param DocumentRepository $documentRepository
     * @param TokenStorageInterface         $tokenStorage
     * @param Environment                   $twig
     * @param FormFactoryInterface          $formFactory
     * @param UrlGeneratorInterface         $urlGenerator
     * @param SessionInterface              $messageFlash
     * @param AuthorizationCheckerInterface $authorization
     */
    public function __construct(
        DocumentRepository $documentRepository,
        TokenStorageInterface $tokenStorage,
        Environment $twig,
        FormFactoryInterface $formFactory,
        UrlGeneratorInterface $urlGenerator,
        SessionInterface $messageFlash,
        AuthorizationCheckerInterface $authorization
    ) {
        $this->documentRepository = $documentRepository;
        $this->tokenStorage = $tokenStorage;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->urlGenerator = $urlGenerator;
        $this->messageFlash = $messageFlash;
        $this->authorization = $authorization;
    }

    /**
     * @Route("/delete/{slug}", name="document_delete", methods={"GET"})
     *
     * @param Request $request
     * @param Document $document
     *
     * @return RedirectResponse|Response
     */
    public function delete(
        Request $request,
        Document $document
    )
    {
        if ($this->authorization->isGranted(DocumentVoter::DELETE, $document) === false) {
            throw new AccessDeniedException();
        }
        $this->documentRepository->delete($document);

        $this->messageFlash->getFlashBag()->add('success', "Tâche supprimée.");

        return new RedirectResponse(
            $this->urlGenerator->generate('task_list'),
            RedirectResponse::HTTP_FOUND
        );
    }
}