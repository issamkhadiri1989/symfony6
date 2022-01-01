<?php

declare(strict_types=1);

namespace App\Security\Voter;

//<editor-fold desc="Use statements">
use App\Entity\{Article, User};
use Symfony\Component\Security\Core\{Authentication\Token\TokenInterface,
    Authorization\Voter\Voter,
    Security,
    User\UserInterface};

//</editor-fold>

class ArticleVoter extends Voter
{
    public function __construct(private Security $security)
    {
    }

    /**
     * Tells Symfony that this voter should work only for Article instances
     * and for specific attributes.
     */
    protected function supports(string $attribute, mixed $subject): bool
    {
        if (!$subject instanceof Article || false === \in_array($attribute, ['view', 'edit'])) {
            return false;
        }

        return true;
    }

    /**
     * This will be called only if supports method has returned true.
     */
    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        if (true === $this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        //<editor-fold desc="Check article">
        /** @var Article $article */
        $article = $subject;
        /** @var UserInterface $user */
        $user = $token->getUser();
        // Make sure that the $user is an instance of User::class
        if (!$user instanceof User) {
            return false;
        }

        return match ($attribute) {
            'view' => $this->articleViewable($article, $user),
            'edit' => $this->articleEditable($article, $user),
            default => throw new \UnhandledMatchError('attribute not handled'),
        };
        //</editor-fold>
    }

    /**
     * The article should be viewed only if it is not a draft or if it is editable.
     *
     * @param Article $article The article instance
     * @param User    $user    The user instance
     *
     * @return bool True if the article is viewable. False if not
     */
    private function articleViewable(Article $article, User $user): bool
    {
        if (true === $this->articleEditable($article, $user)) {
            return true;
        }

        return false === $article->isDraft();
    }

    /**
     * The article should be edited only by its owner.
     *
     * @param Article $article The article instance
     * @param User    $user    The user instance
     *
     * @return bool True if the article is editable. False if not
     */
    private function articleEditable(Article $article, User $user): bool
    {
        return $user === $article->getAuthor();
    }
}
