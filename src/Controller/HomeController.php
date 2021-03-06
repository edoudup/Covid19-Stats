<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function browse(CallApiService $callApiService): Response
    {
        //dd($callApiService->getFranceData());
        return $this->render('home/browse.html.twig', [
            'data' => $callApiService->getFranceData(),
        ]);
    }
}
 