<?php

declare(strict_types=1);

namespace App\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use App\Entity\Document;
use LogicException;
use App\Entity\User;

/**
 * Class DocumentVoter
 *
 * @package App\Voter
 */
class DocumentVoter extends Voter
{

    const DELETE = 'delete';

    /**
     * @param string $attribute
     * @param mixed $subject
     *
     * @return bool
     */
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [ self::DELETE])) {
            return false;
        }

        if (!$subject instanceof Document) {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        $document = $subject;

        switch ($attribute) {
            case self::DELETE:
                return $this->canDelete($document, $user);
        }

        throw new LogicException('This code should not be reached!');
    }

    /**
     * @param Document $document
     * @param User $user
     *
     * @return bool
     */
    private function canDelete(Document $document, User $user): bool
    {
        if ($document->getUser() === null & $user->getRoles() === ['ROLE_ADMIN'] or $user === $document->getUser()) {
            return true;
        }
        return false;
    }
}