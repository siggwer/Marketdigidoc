<?php

declare(strict_types=1);

namespace App\EntityListener;

use Symfony\Component\Security\Core\Security;
use App\Entity\Document;

/**
 * Class DocumentListener.
 */
class DocumentListener
{
    /**
     * @var Security
     */
    private $security;

    /**
     * DocumentListener constructor.
     *
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @param Document $document
     */
    public function prePersist(Document $document)
    {
        if (!($this->security->getUser() instanceof User)) {
            return;
        }
        $document->setAuthor($this->security->getUser());
    }
}