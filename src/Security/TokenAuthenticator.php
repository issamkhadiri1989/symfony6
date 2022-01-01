<?php

declare(strict_types=1);

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\{RedirectResponse, Request, Response};
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\{AuthenticationException, CustomUserMessageAuthenticationException};
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\{Badge\UserBadge, Passport, SelfValidatingPassport};

class TokenAuthenticator extends AbstractAuthenticator
{
    public function __construct(private UserRepository $repository)
    {
    }

    /**
     * To enable this authenticator, the request must have a token parameter.
     */
    public function supports(Request $request): ?bool
    {
        return $request->query->has('token');
    }

    /**
     * This will authenticate user only if he sent a valid token
     * We are going to use SelfValidatingPassport as we won't need any password for this.
     */
    public function authenticate(Request $request): Passport
    {
        $token = (string) $request->query->get('token', '');
        if ('' === $token) {
            throw new CustomUserMessageAuthenticationException('The token is not provided');
        }

        return new SelfValidatingPassport(
            new UserBadge($token, fn (string $token) => $this->repository->findOneBy(['token' => $token]))
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return new RedirectResponse(url: '/');
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return null;
    }
}
