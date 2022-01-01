<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\LoginLinkType;
use App\Service\LoginLinkGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

class LoginLinkController extends AbstractController
{
    /**
     * This action will create a form that the user must submit to generate the
     * login link. It will also generate the login link and send it to the user
     * via email.
     *
     * @param Request            $request       the request instance
     * @param LoginLinkGenerator $linkGenerator the generator service
     *
     * @return Response a page containing a simple form through which  the user will submit the email
     *
     * @throws TransportExceptionInterface
     */
    #[Route('/login-link', name: 'login_link')]
    public function index(Request $request, LoginLinkGenerator $linkGenerator): Response
    {
        $data = ['email' => null];
        $form = $this->createForm(LoginLinkType::class, $data);
        $form->handleRequest($request);
        if (true === $form->isSubmitted()) {
            $userEmail = $form->getData()['email'] ?? null;
            $linkGenerator->sendLoginLink($userEmail);
            $this->addFlash(
                type: 'success',
                message: 'An email has been sent to '.$userEmail.'. Please check your inbox',
            );

            return $this->redirectToRoute('login_link');
        }

        return $this->render(
            view: 'login_link/index.html.twig',
            parameters: ['form' => $form->createView()],
        );
    }
}
