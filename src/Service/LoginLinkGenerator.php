<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\UserRepository;
use Symfony\Component\Mailer\{Exception\TransportExceptionInterface, MailerInterface};
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\{Exception\UserNotFoundException, User\UserInterface};
use Symfony\Component\Security\Http\LoginLink\LoginLinkHandlerInterface;
use Twig\Environment;
use Twig\Error\{LoaderError, RuntimeError, SyntaxError};

class LoginLinkGenerator
{
    public function __construct(
        private UserRepository $repository,
        private LoginLinkHandlerInterface $loginLinkHandler,
        private MailerInterface $mailer,
        private Environment $environment
    ) {
    }

    /**
     * This function uses the MailerInterface to send mail.
     *
     * @param string $userEmail the user email
     *
     * @throws TransportExceptionInterface
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function sendLoginLink(string $userEmail): void
    {
        // Load the user from the database
        $user = $this->getUser($userEmail);
        $loginLinkDetails = $this->loginLinkHandler->createLoginLink(user: $user);
        $url = $loginLinkDetails->getUrl();
        $message = (new Email())
            ->from('admin@system.com')
            ->to($userEmail)
            ->subject('Login link')
            ->html($this->environment->render('email/email.html.twig', ['url' => $url]));
        $this->mailer->send($message);
    }

    /**
     * Gets the user form its email.
     *
     * @param string $userEmail the user's email
     *
     * @return UserInterface the user instance
     *
     * @throws UserNotFoundException
     */
    private function getUser(string $userEmail): UserInterface
    {
        /** @var UserInterface|null $user */
        $user = $this->repository->findOneByEmail(email: $userEmail);
        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
