<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\{Checkout, Profile, Shipment};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProfileController extends AbstractController
{
    /**
     * Validate object using groups.
     */
    #[Route(path: '/checkout', name: 'checkout')]
    public function checkout(ValidatorInterface $validator): Response
    {
        $profile = new Profile();
        $profile->setCardNumber('4348 1830 9209 6137');
        $profile->setName(null);
        $profile->setAddress(null);
        $profileErrors1 = $validator->validate(value: $profile);
        $profile->setName('ipsum');
        $profileErrors2 = $validator->validate(value: $profile);

        $checkout = new Checkout();
        $checkout->setCheckoutDate(new \DateTime('2021-05-20'))
            ->setShipmentAddress(new Shipment());
        $defaultGroupErrors = $validator->validate(value: $checkout);
        /*
         * The above statement is  equivalent to
         * $defaultGroupErrors = $validator->validate(value: $checkout, groups: ['Default']);
         */

        $classNameGroupErrors = $validator->validate(value: $checkout, groups: ['Checkout']);
        $checkout
            ->getShipmentAddress()->setPhoneNumber('0000');
        $registrationGroupErrors = $validator->validate(value: $checkout, groups: ['registration']);

        return new Response();
    }
}
