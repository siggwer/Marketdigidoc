<?php

declare(strict_types=1);

namespace App\Controller;

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
use App\Handler\DocumentUpdateHandler;
use App\Repository\DocumentRepository;
use Twig\Error\RuntimeError;
use Twig\Error\LoaderError;
use Twig\Error\SyntaxError;
use App\Entity\Document;
use App\Form\UpdateType;
use Twig\Environment;

/**
 * Class DocumentUpdateController
 *
 * @package App\Controller
 *
 * @Route("/document")
 */
class DocumentUpdateController extends AbstractController
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
     * @Route("/update/{slug}", name="document_update", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param Document $document
     * @param DocumentUpdateHandler $documentUpdateHandler
     *
     * @return RedirectResponse|Response
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function update(
        Request $request,
        Document $document,
        DocumentUpdateHandler $documentUpdateHandler
    )
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->formFactory->create(UpdateType::class, $document)
            ->handleRequest($request);

        if ($documentUpdateHandler->handle($form, $document)) {
            return new RedirectResponse(
                $this->urlGenerator->generate('document_list'),
                RedirectResponse::HTTP_FOUND
            );
        }

        return new Response(
            $this->twig->render(
                'document/update.html.twig',
                [
                    'form' => $form->createView()
                ]
            ),
            Response::HTTP_OK
        );
    }
}