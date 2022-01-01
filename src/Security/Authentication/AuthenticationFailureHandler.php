<?php

declare(strict_types=1);

namespace App\Security\Authentication;

use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

class AuthenticationFailureHandler implements AuthenticationFailureHandlerInterface
{
    /**
     * A custom authentication failure handler.
     *
     * @param Request                 $request   the current request instance
     * @param AuthenticationException $exception the eventual exception due to access failure
     *
     * @return Response the response to return to the user
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        // ... do some logic

        return new Response(/*Some response*/);
    }
}
