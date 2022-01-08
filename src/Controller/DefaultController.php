<?php

namespace App\Controller;

use App\Event\OrderCanceledEvent;
use App\Model\Cart;
use App\Model\CartLine;
use App\Model\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/default', name: 'default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * This controller is going to be embedded in the `default\index` template.
     */
    public function someEmbeddedController(): Response
    {
        return $this->render('default/_embed.html.twig');
    }

    /**
     * This action will perform cancellation of the order.
     *
     * @param EventDispatcherInterface $dispatcher the event dispatcher instance
     *
     * @return Response some response instance
     */
    #[Route(path: "/cancel/order", name: "cancel_order")]
    public function cancelOrder(EventDispatcherInterface $dispatcher): Response
    {
        // Typical order may be an entity fetched from database
        $order = new Order();
        // ...
        $cancelEvent = new OrderCanceledEvent(order: $order);
        $dispatcher->dispatch(eventName: $cancelEvent::NAME, event: $cancelEvent);

        $cart = new Cart([
            new CartLine('Ipsum'),
            new CartLine('Lorem'),
            new CartLine('Dolore'),
        ]);

        $line = $cart[2];

        //<editor-fold desc="// the rest of the logic">
        return new Response();
        //</editor-fold>
    }
}
