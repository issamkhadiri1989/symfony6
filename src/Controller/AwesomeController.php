<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Routing\Annotation\Route;

class AwesomeController extends AbstractController
{
    #[Route(path: "/awesome", name: "awesome")]
    public function awesome(KernelInterface $kernel): Response
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $inputs = new ArrayInput([
            'my:awesome:command',
            /*
             * A key=>value array that holds arguments/options
             * "argument" => "value",
             * "--option" => "value"
             * */
        ]);

        $output = new BufferedOutput();
        // $output = new NullOutput() if no output needed

        $application->run($inputs, $output);
        $content = $output->fetch();

        return new Response($content);
    }
}