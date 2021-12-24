<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Appointment;
use App\From\Type\AppointmentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * Show a simple from to help the user to create a new Appointment.
     */
    #[Route(path: '/new-appointment', name: 'add_event')]
    public function addEvent(Request $request): Response
    {
        $appointment = new Appointment();
        $form = $this->createForm(AppointmentType::class, $appointment);
        $form->handleRequest($request);
        if (true === $form->isSubmitted() && true === $form->isValid()) {
            // persist the object into the database
        } else {
            $errors = $form->getErrors();
        }

        return $this->render(
            view: 'default/new_appointment.html.twig',
            parameters: ['form' => $form->createView()],
        );
    }
}
