<?php

namespace App\EntityListener;

use Symfony\Component\Security\Core\Security;
use App\Entity\Article;

/**
 * Class ArticleListener.
 */
class ArticleListener
{
    /**
     * @var Security
     */
    private $security;

    /**
     * ArticleListener constructor.
     *
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @param Article $article
     */
    public function prePersist(Article $article)
    {
        if (!($this->security->getUser() instanceof User)) {
            return;
        }
        $article->setAuthor($this->security->getUser());
    }
}