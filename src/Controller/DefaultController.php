<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Container\{
    ContainerExceptionInterface,
    NotFoundExceptionInterface
};
use Symfony\Component\DependencyInjection\ParameterBag\{
    ContainerBagInterface,
    ParameterBagInterface
};
use Symfony\Component\HttpFoundation\{
    BinaryFileResponse,
    Cookie,
    HeaderUtils,
    JsonResponse,
    ParameterBag,
    RedirectResponse,
    Request,
    RequestStack,
    Response,
    UrlHelper
};
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;
use Symfony\Component\HttpFoundation\AcceptHeader;
use Symfony\Component\HttpFoundation\IpUtils;
use Twig\Error\{LoaderError, RuntimeError, SyntaxError};

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     *
     * @param ContainerBagInterface $containerBag
     *
     * @return Response
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(
        ContainerBagInterface $containerBag, // new in 4.1 implements PSR 11 by extending Psr\Container\ContainerInterface
        RouterInterface $router,
        Request $request,
        ParameterBagInterface $parameterBag,
        SessionInterface $session,
        RequestStack $requestStack
    ): Response
    {
        /*$var = $request->query->all()['foo'];*/
        $languages = $request->getPreferredLanguage();
        $session->set('test', 'value');

//        throw  new NotFoundHttpException('');
        $url = [];
        $parameter = $containerBag->get('example');
        $otherParameter = $parameterBag->get('example');
        $url['ABSOLUTE_PATH'] = $router->generate('random', [], UrlGeneratorInterface::ABSOLUTE_PATH);
        $url['ABSOLUTE_URL'] = $router->generate('random', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $url['RELATIVE_PATH'] = $router->generate('random', [], UrlGeneratorInterface::RELATIVE_PATH);
        $url['NETWORK_PATH'] = $router->generate('random', [], UrlGeneratorInterface::NETWORK_PATH);

        $routeName = $request->attributes->get('_route');
        $successMessages = $requestStack->getSession()
            ->getFlashBag()
            ->get('success');

        return $this->render('default/index.html.twig');
    }

    #[Route(name: 'random', path: '/random')]
    public function random(RouterInterface $router): Response
    {
        $this->addFlash('success', 'This is an awesome message');

        return new RedirectResponse($router->generate('index', [], UrlGeneratorInterface::ABSOLUTE_URL));
    }

    #[Route('/json', name: 'api')]
    public function randomJson(
        Request $request,
        UrlHelper $urlHelper,
        ParameterBagInterface $parameterBag,
        Packages $package
    ): Response {
        $parameter = $this->container->get('parameter_bag');

        $preferSafeContent = $request->preferSafeContent();
        $isInstanceOfParameterBag = $request->headers instanceof ParameterBag;
        $content = $request->getContent();
        $body = $request->toArray();
        $pathInfo = $request->getPathInfo();
        $acceptableContentTypes = $request->getAcceptableContentTypes();
        $accept = $request->headers->get('Accept');
        $acceptHeader = AcceptHeader::fromString($accept);
        $sourceIp = $request->server->get('REMOTE_ADDR');
        $newIp = IpUtils::anonymize(ip: $sourceIp);
        $response = new JsonResponse(
            data: '{"name":"Ipsum lorem","username":"ipsum_lorem"}',
            json: true,
        );
        $filename = $parameterBag->get('app.files').'/Mon_CVpdf.pdf';
        $asset = $package->getUrl('resources/Cv_test.pdf');
        $response = new Response();
        $someData = [
            'name' => 'Ipsum lorem',
            'username' => 'ipsum_lorem',
            'absolute_resume_url' => $urlHelper->getAbsoluteUrl($asset),
            'relative_resume_path' => $urlHelper->getRelativePath($asset),
            'asset' => $asset,
        ];
        $response->setContent(\json_encode($someData));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
//        return JsonResponse::fromJsonString('{"name":"Ipsum lorem","username":"ipsum_lorem"}');
    }

    #[Route(name: "sweet_route", path: "/sweet")]
    public function mySweetRoute(Environment $twigService, Request $request): Response
    {
        $pathInfo = $request->getPathInfo();
        $getParamsBefore = $_REQUEST;
        // Create new request
        $simulatedRequest = Request::create('/json', 'POST', ['name' => 'Fabien']);
        $simulatedRequest->overrideGlobals();
        $getParamsAfter = $_REQUEST;
        // Duplicate an existing request
        $duplicatedRequest = $request->duplicate();
        // Initialize a bunch of parameters
        $request->initialize(
            query: ['name' => 'value']
        );

        return new Response($twigService->render('default/sweet.html.twig'));
    }

    /**
     * @Route(path="/response", name="response")
     *
     * @param Environment $environment
     * @param Request $request
     *
     * @return Response
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function responseExample(Environment $environment, Request $request): Response
    {
        $response = new Response(
            content: '',
            status: Response::HTTP_OK,
            headers: []
        );
        $response->setContent($environment->render('default/sweet.html.twig'));
        $response->setStatusCode(Response::HTTP_OK);
//        $response->setCharset('ISO-8859-1');
        $response->headers->set('Content-Type', 'text/plain');
//        $response = $response->prepare($request);
//        $response->headers->setCookie(Cookie::create('foo', 'bar'));
        $response->headers->clearCookie('foo');
        $response->headers->setCookie(Cookie::fromString('id=a3fWa; Expires=Fri, 21 Oct 2022 07:28:00 GMT; HttpOnly=true')->withSecure(true));

        return $response;
    }

    #[Route(name: "cache", path: "/cache")]
    public function caching(Request $request): Response
    {
        $response = new Response(content: '', status: Response::HTTP_OK, headers: []);
        $response->setPrivate();
        $response->expire();
        $response->setMaxAge(60); // The response is considered fresh during 60min
//        $maxAge = $response->getMaxAge();
//        $response->setTtl(3600);
        return $response;
    }

    #[Route(name: "download", path: "/download")]
    public function downloadPdf(ContainerBagInterface $containerBag): Response
    {
        $filename = $containerBag->get('app.files').'/Mon_CVpdf.pdf';
        $fileContent = \file_get_contents($filename);
        $response = new Response($fileContent);
        $disposition = HeaderUtils::makeDisposition(disposition: HeaderUtils::DISPOSITION_ATTACHMENT, filename: 'Cv_test.pdf');
        $response->headers->set('Content-Disposition', $disposition);

        $binaryResponse = new BinaryFileResponse($filename);

        return $binaryResponse;
    }
}