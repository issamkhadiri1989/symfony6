<?php

declare(strict_types=1);

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\{Storage\TokenStorageInterface, UsernamePasswordToken};
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authenticator\Token\PostAuthenticationToken;

class Authenticator
{
    private SessionInterface $session;

    public const USERNAME_PASSWORD_TOKEN = 1;
    public const POST_AUTHENTICATION_TOKEN = 2;

    public function __construct(
        private UserRepository $repository,
        RequestStack $requestStack,
        private TokenStorageInterface $tokenStorage,
    ) {
        $this->session = $requestStack->getSession();
    }

    /**
     * Authenticate user using the PostAuthenticationToken or UsernamePasswordToken object.
     *
     * @param string $username     the username identifier
     * @param int    $method       an integer to specify which token manager should be used
     * @param string $firewallName the firewall name on which the authentication shall be performed
     */
    public function authenticate(string $username, int $method, string $firewallName = 'main'): void
    {
        $user = $this->getUser($username);
        $token = match ($method) {
            self::USERNAME_PASSWORD_TOKEN => new UsernamePasswordToken(
                user: $user,
                roles: $user->getRoles(),
                firewallName: $firewallName
            ),
            self::POST_AUTHENTICATION_TOKEN => new PostAuthenticationToken(
                user: $user,
                firewallName: $firewallName,
                roles: $user->getRoles()
            ),
            default => throw new \UnhandledMatchError('No option for the given method')
        };
        $this->tokenStorage->setToken($token);
        $this->session->set('_security_main', \serialize($token));
    }

    /**
     * Query the database to get the user by email.
     *
     * @param string $identifier With which the user well be authenticated
     */
    private function getUser(string $identifier): ?UserInterface
    {
        return $this->repository->findOneBy(criteria: ['email' => $identifier]);
    }
}
