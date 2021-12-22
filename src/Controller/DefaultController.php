<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Model\{Author, Book, ChangePassword, Newsletter, Payment, Tax};
use App\Security\Authenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\{
    ConstraintViolation,
    ConstraintViolationList,
    Constraints\All,
    Constraints\Collection,
    Constraints\GreaterThan,
    Constraints\GreaterThanOrEqual,
    Constraints\Length,
    Constraints\NotBlank,
    Constraints\NotNull,
    Constraints\Optional,
    Constraints\Required,
    Constraints\Type,
    Constraints\Unique,
    Validator\ValidatorInterface
};
use Symfony\Component\{HttpFoundation\RedirectResponse, HttpFoundation\Response, Routing\Annotation\Route};

class DefaultController extends AbstractController
{
    #[Route(path: '/', name: 'homepage')]
    public function index(ValidatorInterface $validator): Response
    {
        $user = (new User())
            ->setEmail('ikhadiri@gmail.com')
            ->setUsername('issamkhadiri');
        /** @var ConstraintViolationList<ConstraintViolation> $errors */
        $errors = $validator->validate($user);

        $newsletter = new Newsletter();
        $newsletter->setEmails(['test@gmail', 'test@gmail']);
        /** @var ConstraintViolationList<ConstraintViolation> $errors */
        $errors = $validator->validate($newsletter);

        $tax = new Tax();
        $tax->setRegistrationNumber(null);
        /** @var ConstraintViolationList<ConstraintViolation> $errors */
        $errors = $validator->validate($tax);

        $validVisaCard = '4916646862134397';
        $invalidVisaCard = '3658441816188051';
        $validMasterCard = '5107707540981462';

        $cc = new Payment();
        $cc->setCardNumber($invalidVisaCard);
        /** @var ConstraintViolationList<ConstraintViolation> $errors */
        $errors = $validator->validate($cc);

        $book = new Book();
        $book->setName('Book name');
        $book->setEditionDate(new \DateTime('now'));
        $book->setPublishDate(new \DateTime('2021-12-21'));
        $book->setSellPrice('10.5');
        /** @var ConstraintViolationList<ConstraintViolation> $errors */
        $errors = $validator->validate($book);

        $author = new Author();
        $author->setYearOfBirth(2002);
        /** @var ConstraintViolationList<ConstraintViolation> $errors */
        $errors = $validator->validate($author);

        return $this->render('index/index.html.twig', parameters: [
            'errors' => $errors,
        ]);
    }

    /**
     * Manually run this action to authenticate the dummy user.
     *
     * @param Authenticator $authenticator The authenticator service
     *
     * @return RedirectResponse
     */
    #[Route(path: '/login', name: 'login')]
    public function login(Authenticator $authenticator): RedirectResponse
    {
        $authenticator->authenticate(username: 'ikhadiri@gmail.com', method: Authenticator::USERNAME_PASSWORD_TOKEN);

        return $this->redirectToRoute('homepage');
    }

    #[Route(path: '/change-password', name: 'change_password')]
    public function changePassword(ValidatorInterface $validator): Response
    {
        $model = new ChangePassword();
        $model->setOldPassword('000000');
        $errors = $validator->validate($model);

        return new Response('<html><body></body></html>');
    }

    #[Route(path: '/validate-raw', name: 'validate_raw')]
    public function validateRawData(ValidatorInterface $validator): Response
    {
        /*$email = 'ipsum.lorem';
        $emailConstraint = new Email();
        $emailConstraint->message = 'The email you provided not valid';

        $errors = $validator->validate(
            value: $email,
            constraints: [$emailConstraint]
        );*/

        $movie = [
            'name' => 'The Amazing Spider-Man',
            'type' => [
                'Sci-Fi',
                'Adventure',
                'Action',
            ],
            'director' => 'Marc Webb',
            'year' => 2012,
            'duration' => 136,
        ];

        $collectionConstraint = new Collection([
            'name' => new Required([
                new NotNull(),
                new NotBlank(),
            ]),
            'type' => [
                new Unique(),
                new All([
                    new NotNull(),
                ]),
            ],
            'director' => new NotNull(),
            'year' => [
                new Type('integer'),
                new GreaterThanOrEqual(1900),
            ],
            'duration' => [
                new Type('integer'),
                new GreaterThan(0),
            ],
            'description' => new Optional([
                new NotNull(),
                new Length(['min' => 20, 'max' => 300]),
            ]),
        ]);

        $errors = $validator->validate($movie, $collectionConstraint);

        return new Response();
    }
}
