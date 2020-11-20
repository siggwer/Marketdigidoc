<?php

declare(strict_types=1);

namespace App\Handler;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Form\FormInterface;
use App\Repository\DocumentRepository;
use App\Entity\Document;

/**
 * Class DocumentAddHandler
 *
 * @package App\Handler
 */
class DocumentAddHandler
{
    /**
     * @var DocumentRepository
     */
    private $repository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var SessionInterface
     */
    private $messageFlash;

    /**
     * DocumentAddHandler constructor.
     *
     * @param DocumentRepository    $documentRepository
     * @param TokenStorageInterface $tokenStorage
     * @param SessionInterface      $messageFlash
     */
    public function __construct(
        DocumentRepository $documentRepository,
        TokenStorageInterface $tokenStorage,
        SessionInterface $messageFlash
    ) {
        $this->documentRepository = $documentRepository;
        $this->tokenStorage = $tokenStorage;
        $this->messageFlash = $messageFlash;
    }

    /**
     * @param FormInterface $form
     * @param Document      $document
     *
     * @return bool
     */
    public function handle(FormInterface $form, Document $document)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $document->setAuthor($this->tokenStorage->getToken()->getUser());

            $this->repository->createTask($document);

            $this->messageFlash->getFlashBag()->add('success', 'Le document a bien été ajoutée.');

            return true;
        }
        return false;
    }
}