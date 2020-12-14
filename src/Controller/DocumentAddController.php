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
use App\Repository\DocumentRepository;
use App\Handler\DocumentAddHandler;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Error\LoaderError;
use App\Entity\Document;
use App\Form\AddType;
use Twig\Environment;

/**
 * Class DocumentAddController
 *
 * @package App\Controller
 *
 * @Route("/document")
 */
class DocumentAddController extends AbstractController
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
     * DocumentAdd constructor.
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
     * @Route("/add", name="document_add", methods={"GET", "POST"})
     *
     * @param DocumentAddHandler $documentAddHandler
     * @param Request $request
     * @return RedirectResponse|Response
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function add(
        DocumentAddHandler $documentAddHandler,
        Request $request
        ) {

        $document = new Document();
        $form = $this->formFactory->create(AddType::class, $document)
            ->handleRequest($request);

        if ($documentAddHandler->handle($form, $document)) {
            return new RedirectResponse(
                $this->urlGenerator->generate('document_list'),
                RedirectResponse::HTTP_FOUND
            );
        }

        return new Response(
            $this->twig->render(
                'document/add.html.twig',
                [
                    'form' => $form->createView()
                ]
            ),
            Response::HTTP_OK
        );
    }
}
