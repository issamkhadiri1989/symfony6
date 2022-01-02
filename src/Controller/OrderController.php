<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'order')]
    public function index(): Response
    {
        $order = [];
        $form = $this->createForm(type: OrderType::class, data: $order);

        return $this->render(view: 'order/index.html.twig', parameters: ['controller_name' => 'OrderController', 'form' => $form->createView()]);
    }
}
